<?php

class Logger
{
  private $caller;

  public function __construct(string $caller)
  {
    $this->caller = $caller;
  }

  public function info(string $message)
  {
    try {
      $date = date("Y-m-d");
      $time = date("h:i:sa");
      $datetime = date("Y-m-d h:i:sa");
      $file = fopen("../log/log-".$date.".txt", "w");

      $writeable = "[$this->caller - $datetime] - $message";
      fwrite($file, $writeable);
    } catch (Exception $e) {
      echo "An error has occured!" . $e;
    }
  }
}