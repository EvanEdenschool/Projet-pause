<?php
  class DatabaseManager {
    private $pdo;

    public function __construct($host, $port, $dbName, $user, $pass) {
      $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /*
     * Cherche un utilisateur qui correspond au couple $user et $pass
     * @return null if user not found and instance of corresponding #User if found.
     */
    public function findUser($user, $pass) {
      $stmt = $this->pdo->prepare("SELECT `id`, `first_name`, `last_name`, `username`, `password` FROM `users` WHERE `username` = '$user' LIMIT 1");

      $stmt->execute();

      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($data) === 0) {
        return null;
      }

      if (!password_verify($pass, $data[0]['password'])) {
        return null;
      }

      return new User(
        $data[0]['id'],
        $data[0]['first_name'],
        $data[0]['last_name'],
        $data[0]['username']
      );
    }

    /*
     * Créer un nouvel utilisateur en fonction des arguments passés à la fonction.
     */
    public function createUser($firstName, $lastName, $username, $password) {
      $stmt = $this->pdo->prepare('INSERT INTO `users`(`first_name`, `last_name`, `username`, `password`) VALUES(:first_name, :last_name, :username, :password)');
      $stmt->bindValue(':first_name', $firstName);
      $stmt->bindValue(':last_name', $lastName);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));

      $stmt->execute();

      return new User(
        $this->pdo->lastInsertId(),
        $firstName,
        $lastName,
        $username
      );
    }
  }
