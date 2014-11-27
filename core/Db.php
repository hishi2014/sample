<?php
Class Db{

  private $dbh;

function __construct(){
try {
    $options = array();
    $this->dbh = new PDO();
    } catch (PDOException $e) {
    print "error!: " . $e->getMessage() . "<br/>";
    die();
        }
      }

      public function getDbh(){
        return $this->dbh;
      }

      function __destruct(){
        $this->dbh=null;
      }

}
?>