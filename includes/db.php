 <?php 
 /*-- Database: rabbit_farm  */
//connect to db
require_once 'config.php';
$conn = mysqli_connect($server,$user,$pass,$db_name);
if(!$conn){
    echo "Connection error: " . mysqli_connect_error();
}else{
create_rabbits_table($conn);
create_breeding_records_table($conn);
create_health_records_table($conn);
create_financial_transactions_table($conn);
create_users_table($conn);
}
function create_rabbits_table($conn){
/*-- Rabbits table */
$sql = "CREATE TABLE IF NOT EXISTS rabbits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    ear_tag VARCHAR(20) UNIQUE,
    gender ENUM('male', 'female'),
    breed VARCHAR(50),
    date_of_birth DATE,
    mother_id INT,
    father_id INT,
    status ENUM('active', 'sold', 'deceased', 'retired'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (mother_id) REFERENCES rabbits(id),
    FOREIGN KEY (father_id) REFERENCES rabbits(id)
)";
mysqli_query($conn, $sql);
}
function create_breeding_records_table($conn){
/*-- Breeding records */
$sql = 'CREATE TABLE IF NOT EXISTS breeding_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buck_id INT,
    doe_id INT,
    breeding_date DATE,
    expected_kindling_date DATE,
    actual_kindling_date DATE,
    litter_size INT,
    notes TEXT,
    FOREIGN KEY (buck_id) REFERENCES rabbits(id),
    FOREIGN KEY (doe_id) REFERENCES rabbits(id)
)';
mysqli_query($conn, $sql);
}
function create_health_records_table($conn){
/*-- Health records */
$sql = "CREATE TABLE IF NOT EXISTS health_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rabbit_id INT,
    record_date DATE,
    health_status ENUM('excellent', 'good', 'fair', 'poor', 'critical'),
    weight DECIMAL(5,2),
    notes TEXT,
    treatment TEXT,
    next_checkup DATE,
    FOREIGN KEY (rabbit_id) REFERENCES rabbits(id)
)";
mysqli_query($conn, $sql);
}
function create_financial_transactions_table($conn){
/*-- Financial transactions*/
$sql = "CREATE TABLE IF NOT EXISTS financial_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_date DATE,
    type ENUM('income', 'expense'),
    category VARCHAR(50),
    amount DECIMAL(10,2),
    description TEXT,
    related_rabbit_id INT,
    FOREIGN KEY (related_rabbit_id) REFERENCES rabbits(id)
)";
mysqli_query($conn, $sql);
}
function create_users_table($conn){
/*-- Users table for authentication */
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    full_name VARCHAR(100),
    role ENUM('admin', 'manager', 'worker'),
    last_login DATETIME
)";
mysqli_query($conn, $sql);
}