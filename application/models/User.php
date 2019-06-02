<?php


class User extends CI_Model
{


  public function __construct($db)
  {
    $this->load->database();
  }


  public function createUser($name, $email, $password)
  {
    # Hash password - Use default algo which is bcrypt, will provide salt 
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user (name, email, password) VALUES(?,?,?)";
    $stmt = $this->conn->prepare($query);
    if ($stmt->execute([$name, $email, $hash])) {
      echo 'successfully added user';
    } else {
      echo 'failed adding user';
    }
    return $stmt;
  }

  # NOT DONE YET =================

  public function getUser($email, $password)
  {
    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$email]);
    echo "User: $stmt->fetch()";
    return $stmt;
  }
}
