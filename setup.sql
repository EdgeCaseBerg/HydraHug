CREATE DATABASE hydra;

CREATE USER 'thanatos'@'localhost' IDENTIFIED BY 'gottisttott';
GRANT ALL ON hydra.* TO 'thanatos'@'localhost';
FLUSH PRIVILEGES;

USE hydra;

CREATE TABLE users (
    id INT(12) NOT NULL auto_increment PRIMARY KEY,
    twitter_name VARCHAR(256) NOT NULL,
    twitter_id INT(12) NOT NULL,
    oauth_token VARCHAR(256) NOT NULL, 
    oauth_secret VARCHAR(256),
    INDEX(`twitter_id`),
    INDEX(`id`)
) ENGINE InnoDB;

CREATE TABLE lists (
	id INT(12) NOT NULL auto_increment PRIMARY KEY,
	owner_id INT(12) NOT NULL,
	to_follow INT(12) NOT NULL
) ENGINE InnoDB;

CREATE TABLE jobs (
	id int(12) NOT NULL auto_increment PRIMARY KEY,
	owner_id INT(12) NOT NULL,
	follower_id INT(12) NOT NULL,
	job_id VARCHAR(512) NOT NULL,
	message VARCHAR(512),
	status VARCHAR(32) DEFAULT "CREATED",
	INDEX(`owner_id`)
) ENGINE InnoDB;