<?php

class Registeruser {
  private $username;
  private $email;
  private $id;
  private $phonenumber;
  private $raw_password;
  private $encrypted_password;
  private $confirm_password;
  private $gender;
  private $terms_agreed;
  private $storage = "users.json";
  private $stored_users;
  public $error;
  public $success;

  public function __construct($username, $email, $id, $phonenumber, $password,$confirm_password, $gender,$terms_agreed) {
    $this->username = trim($username);
    $this->email = trim($email);
    $this->id = trim($id);
    $this->phonenumber = trim($phonenumber);
    $this->raw_password = trim($password);
    $this->encrypted_password = password_hash($password, PASSWORD_DEFAULT);
    $this->confirm_password = trim($confirm_password);
    $this->gender = trim($gender);
    $this->gender = filter_var($this->gender, FILTER_SANITIZE_STRING);
    $this->terms_agreed = $terms_agreed;
        
    if ($this->checkfieldvalues() && $this->checkPasswordsMatch() && $this->checkTermsAgreed() && $this->checkUniqueFields()) {
      $this->insertUser();
    }
  }

  private function checkfieldvalues() {
    if (empty($this->username) || empty($this->email) || empty($this->id) || empty($this->phonenumber) || empty($this->raw_password) || empty($this->confirm_password)) {
      $this->error = "Please fill all the fields";
      return false;
    }
    return true;
  }

  private function checkPasswordsMatch() {
    if($this->raw_password !== $this->confirm_password){
        $this->error = "Passwords do not match";
        return false;
    }
    return true;
  }

  private function checkTermsAgreed() {
    if(empty($this->terms_agreed)){
        $this->error = "Please agree to the terms and conditions";
        return false;
    }
    return true;
  }

  private function checkUniqueFields() {
    $this->stored_users = json_decode(file_get_contents($this->storage), true);

    foreach ($this->stored_users as $user) {
      if ($this->username === $user["username"]) {
        $this->error = "Username already taken, please choose a different one";
        return false;
      }

      if ($this->email === $user["email"]) {
        $this->error = "Email already taken, please choose a different one";
        return false;
      }

      if ($this->id === $user["id"]) {
        $this->error = "ID already taken";
        return false;
      }

      if ($this->phonenumber === $user["phonenumber"]) {
        $this->error = "Phone number already taken, please choose a different one";
        return false;
      }
    }
    
    return true;
  }

  private function insertUser() {
    $new_user = [
      "username" => $this->username,
      "email" => $this->email,
      "id" => $this->id,
      "phonenumber" => $this->phonenumber,
      "password" => $this->raw_password,
      "encrypted_password" => $this->encrypted_password,
    ];

    array_push($this->stored_users, $new_user);

    if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
      $this->success = "User added successfully";
      $this->error = "";
    } else {
      $this->error = "Error adding user";
    }
  }
}