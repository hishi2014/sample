<?php
Class Db{

  private $dbh;

function __construct(){
try {
    $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    $this->dbh = new PDO(,$options);
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