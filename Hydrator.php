<?php
  trait Hydrator {
    public function hydrate(array $data = array()) {
      foreach ($data as $key => $value) {
        $method = 'set' . ucfirst($key);

        if (is_callable([$this, $method])) {
          $this->$method($value);
        }
      }
    }
  }
