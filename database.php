<?php

//include the connection file
include_once("connection.php");

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
$query3 = "
CREATE TABLE cahierDeTexte (
    id_user INT(6),
    id_module INT(6),
    date_cours DATE NOT NULL,
    chapitre_etudie VARCHAR(255) NOT NULL,
    contenu_cours TEXT,
    PRIMARY KEY (id_user, id_module, date_cours),
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_module) REFERENCES module(id_module) ON DELETE CASCADE
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
CREATE TABLE groupe(
    id_module INT(6),
    id_filiere INT(6),
    nom_groupe VARCHAR(30) NOT NULL,
    PRIMARY key(id_module,id_filiere),
    FOREIGN KEY (id_module) REFERENCES module(id_module),
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
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


?>
