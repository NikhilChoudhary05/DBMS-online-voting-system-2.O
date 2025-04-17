CREATE DATABASE IF NOT EXISTS VotingSystem; USE VotingSystem;

DROP TABLE IF EXISTS Votes; DROP TABLE IF EXISTS Voters;

CREATE TABLE Voters ( voter_id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), gender ENUM('Male', 'Female', 'Other') );

CREATE TABLE Votes ( vote_id INT AUTO_INCREMENT PRIMARY KEY, voter_id INT, vote_choice VARCHAR(100), FOREIGN KEY (voter_id) REFERENCES Voters(voter_id) );

INSERT INTO Voters (name, gender) VALUES ('Nikhil', 'Male'), ('Riya', 'Female'), ('Aman', 'Male');