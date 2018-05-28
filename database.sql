-- Create Schema
create schema db739039241;
-- Create employee_info table
create table employee_info(
  id INT NOT NULL UNIQUE,
  name_first VARCHAR(30) NOT NULL,
  name_mid VARCHAR(30) DEFAULT NULL,
  name_last VARCHAR(30) NOT NULL,
  address VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  city VARCHAR(30) NOT NULL,
  zip SMALLINT NOT NULL DEFAULT 0,
  designation VARCHAR(30) NOT NULL,
  gender ENUM("Male","Female","Other"),
  entry_epoch DATETIME NOT NULL
)DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB;

-- create employee arrival table
CREATE TABLE employee_arrival(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  arrival DATETIME NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES employee_info(id)
)DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB;

-- Create departure table
CREATE TABLE employee_departure(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  departure DATETIME NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES employee_info(id)
)DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB;

-- Create photo upload table
CREATE TABLE photo_upload(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  present_name VARCHAR(200) NOT NULL UNIQUE,
  base_name VARCHAR(200) NOT NULL,
  user_id INT NOT NULL,
  upload_epoch DATETIME NOT NULL,
  FOREIGN KEY (user_id) REFERENCES employee_info(id)
)DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB;

-- Admin table
CREATE TABLE admin (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  admin_user VARCHAR(255) NOT NULL UNIQUE ,
  admin_pass VARCHAR (255) NOT NULL,
  entry_date DATETIME NOT NULL
)DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB;

-- Employee user name and password table
CREATE TABLE login_info(
  user_name VARCHAR(255) PRIMARY KEY,
  user_password VARCHAR(255) NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES employee_info(id)
) DEFAULT CHARACTER SET UTF8 ENGINE=InnoDB;
-- Create email table
CREATE TABLE email (
    id INT NOT NULL AUTO_INCREMENT,
    active_email VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
    ) DEFAULT CHARACTER SET UTF8 ENGINE= InnoDB;
-- Insert the test admin
INSERT INTO admin SET
 admin_user = "deep",
 admin_pass = '$2y$10$KPrQmNIN7.COuzGkONqpbuKxJeiSdQYeA6AOG./3UAl4MG0nAmlDe',
 entry_date = now();

-- set time in the database
INSERT INTO employee_arrival SET arrival = now(), user_id = 4;

-- Select latest entered time by ID
select arrival FROM employee_arrival WHERE user_id = 1 AND id =(SELECT MAX(id) FROM employee_arrival WHERE user_id = 1);

-- Delete
DELETE FROM login_info;
DELETE FROM employee_arrival;
DELETE FROM employee_info;


-- inser into photo
INSERT INTO photo_upload (present_name, base_name, upload_epoch, user_id)
                  VALUES ("deepghd","rahman",now(),"145");

