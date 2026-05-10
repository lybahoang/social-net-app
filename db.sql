-- Create the database
CREATE DATABASE IF NOT EXISTS socialnet;
USE socialnet;

-- Create the account table
CREATE TABLE IF NOT EXISTS account (
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50) NOT NULL UNIQUE,
	fullname VARCHAR(100) NOT NULL,
    	password VARCHAR(255) NOT NULL,
	description TEXT NULL
);

-- Create friendship table
CREATE TABLE IF NOT EXISTS friendship (
    account_id_1 INT NOT NULL,
    account_id_2 INT NOT NULL,
    status ENUM('pending', 'friend') NOT NULL,

    PRIMARY KEY (account_id_1, account_id_2),

    FOREIGN KEY (account_id_1) REFERENCES account(id)
        ON DELETE CASCADE,

    FOREIGN KEY (account_id_2) REFERENCES account(id)
        ON DELETE CASCADE
);