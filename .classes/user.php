<?php

require_once '.dat/config.php';
require_once '.dat/funcs.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author utilizador
 */
class user {
  //put your code here
  private $_id;
  private $_login;
  private $_passwd;
  private $_name;
  private $_notes;
  
  function __construct($id,$login,$passwd,$name,$notes) {
    $this->setId($id);
    $this->setLogin($login);
    $this->setPassword($passwd);
    $this->setName($name);
    $this->setNotes($notes);
  }
  
  function setId($id) {
    $this->_id = htmlentities($id);
  }
  
  function setLogin($login) {
    $this->_login = htmlentities($login);
  }
  
  function setPassword($passwd) {
    $this->_passwd = md5($passwd);
  }
  
  function setName($name) {
    $this->_name = htmlentities($name);
  }
  
  function setNotes($notes) {
    $this->_notes = htmlentities($notes);
  }
  
  function getId() {
    return $this->_id;
  }
  
  function getLogin() {
    return $this->_login;
  }
  
  function getPassword() {
      return $this->_passwd;
  }
  
  function getName() {
    return $this->_name;
  }
  
  function getNotes() {
    return $this->_notes;
  }
  
  function exists() {
    $conta = 0;
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $query = $pdo->prepare("SELECT * FROM users WHERE login=? AND id<>?");
    $query->execute([$this->getLogin(),$this->getId()]);
    if ($row = $query->fetch()) {
        $conta=1;
    }
    $pdo=null;
    $query=null;
    return $conta;
  }
  
  function update() {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    $query = "";
    if ($this->exists()>0) {
      $query = "UPDATE uset SET name='".$this->getName()."',notes='".$this->getNotes()."' WHERE id=".$this->getId();
      $affected_rows = $pdo->exec($query);
      
    }
    else {
      $query = "INSERT INTO users (login,passwd,name,notes) VALUES ('".$this->getLogin()."','".$this->getPassword()."','".$this->getName()."','".$this->getNotes()."')";
      $affected_rows = $pdo->exec($query);
      $insertId = $pdo->lastInsertId();
      $this->setId($insertId);
      
    }
    $pdo=null;
    $query=null;    
    return $affected_rows;
  }
  
  function getByID($id) {
    show_message($id);
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);    
    $query = $pdo->prepare("SELECT * FROM users WHERE id=?");
    $query->execute([$id]);
    if ($row = $query->fetch()) {
      $this->setId($row["id"]);
      $this->setLogin($row["login"]);
      $this->setPassword($row["passwd"]);
      $this->setName($row["name"]);
      $this->setNotes($row["notes"]);
    }
    else {
      $this->clear();
    }
    $pdo=null;
    $query=null;
  }
  
  function clear() {
    $this->setId(0);
    $this->setLogin("");
    $this->setPassword("");
    $this->setName("");
    $this->setNotes("");
  }
}

