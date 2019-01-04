<?php
  class User {
    use Hydrator;

    protected $id;
    protected $firstName;
    protected $lastName;
    protected $username;

    public function __construct($id = '', $firstName = '', $lastName = '', $username = '') {
      $this->id = $id;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->username = $username;
    }

    public function getId() {
      return $this->id;
    }

    public function getFirstName() {
      return $this->firstName;
    }

    public function getLastName() {
      return $this->lastName;
    }

    public function getUsername() {
      return $this->username;
    }
  }
?>
