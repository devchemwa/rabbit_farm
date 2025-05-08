<?php
include '../rabbit_farm/includes/config.php';
$mysqli = new mysqli($server,$user,$pass,$db_name);
if ($mysqli->connect_error) {   
    printf("Connection error: %s", $mysqli->connect_errno); 
}

function calc_gestation_period($mysqli){
    $sql = "
    DELIMITER $$
    CREATE TRIGGER IF NOT EXISTS calc_gestation_period
    BEFORE INSERT ON breeding_records
    FOR EACH ROW
    BEGIN
        -- Rabbit gestation period is typically 28-35 days (average 31 days)
        -- Calculate expected kindling date as breeding date + 31 days
        UPDATE breeding_records 
        SET expected_kindling_date = DATE_ADD(NEW.breeding_date, INTERVAL 31 DAY)
        WHERE id = NEW.id;
    END$$
    DELIMITER ;";
    mysqli_query( $mysqli, $sql);
    }

function assign_user_roles($user_role,$mysqli){
    $sql = "
DELIMITER $$
CREATE TRIGGER assign_user_role
BEFORE INSERT ON users
FOR EACH ROW 
BEGIN
SET NEW.role = '$user_role';
END$$
DELIMITER ;";
$mysqli->query( $sql );
}

function health_checkup($mysqli){
    $sql = "
DELIMITER $$
CREATE TRIGGER check_health
AFTER INSERT ON health_records
FOR EACH ROW
BEGIN
    UPDATE health_records
    SET next_checkup = NEW.record_date + INTERVAL 6 MONTH
    WHERE rabbit_id = NEW.rabbit_id;  
END$$
DELIMITER ;";
$mysqli->query($sql);
}

function transaction_type($type,$mysqli){
    $sql = "
DELIMITER $$
CREATE TRIGGER get_transaction_type
BEFORE INSERT ON financial_transactions
FOR EACH ROW
BEGIN
SET NEW.type = '$type';
END $$
DELIMITER ;";
$mysqli->query($sql);
}

?>