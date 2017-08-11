<?php

// class connect
class connect
{
  private $connection;
  // function sets connection to database
  function setconnection()
  {
    $this->connection=mysqli_connect('localhost',__user__,__passwd__,__schema__) or die("Failed to connect to server");
    //outputting the returned object
    //  print_r($this->connection) ;
  }
  // function return connection instance of database
  function getconnection()
  {
    return $this->connection;
  }
  // function terminates the connection to database
  function terminate()
  {
    //terminate the connection
    mysqli_close($this->connection);
  }
}
?>
