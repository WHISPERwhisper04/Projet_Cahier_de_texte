<?php

//include the connection file
include("connection.php");

//create an instance of Connection class
$connection =new Connection();

//call the createDatabase methods to create database "chap4Db"
$connection->createDatabase('cahierDeTexte');

$query1 = "
CREATE TABLE user (
    id_user INT(6) AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(15),
    password VARCHAR(255) NOT NULL,
    role ENUM('administrateur', 'professeur') NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";
$query2="
CREATE TABLE module (
    id_module INT(6) AUTO_INCREMENT PRIMARY KEY,
    nom_module VARCHAR(50) NOT NULL,
    description VARCHAR(100)
)
 ";
$query3="
CREATE TABLE User_Module (
    id_user INT(6) ,
    id_module INT(6) ,
    PRIMARY KEY (id_user, id_module),
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_module) REFERENCES module(id_module)

)
";
$query4="
CREATE TABLE filiere (
    id_filiere INT(6) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description VARCHAR(100)
)
";
$query5="
CREATE TABLE module_filiere(
    id_module INT(6),
    id_filiere INT(6),
    PRIMARY key(id_module,id_filiere),
    FOREIGN KEY (id_module) REFERENCES module(id_module),
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
)
";
$query6="
CREATE TABLE groupe (
    id_groupe INT AUTO_INCREMENT PRIMARY KEY,
    nom_groupe VARCHAR(30) NOT NULL,
    id_filiere INT(6),
    FOREIGN KEY(id_filiere) REFERENCES filiere(id_filiere)
    
)
";
$query7="
CREATE TABLE entree (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_groupe INT NOT NULL,
    date_cours DATE NOT NULL,
    contenu VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_groupe) REFERENCES groupe(id_groupe)
)
";

//call the selectDatabase method to select the chap4Db
$connection->selectDatabase('cahierDeTexte');
//call the createTable method to create table with the $query
$connection->createTable($query1);
$connection->createTable($query2);
$connection->createTable($query3);
$connection->createTable($query4);
$connection->createTable($query5);
$connection->createTable($query6);
$connection->createTable($query7);

?>
