<?php
  spl_autoload_register(function($className) {
    require_once(__DIR__ . "/$className.php");
  });

  $db = new DatabaseManager('127.0.0.1', 8889, 'pause_projet', 'root', 'root');

  // $user = $db->createUser('Evan', 'Nourikyan', 'grospd', 'secret');

  $user = $db->findUser('grospd', 'secret');
  var_dump($user);
