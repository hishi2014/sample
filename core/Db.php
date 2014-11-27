<?php
Class Db{

  private $dbh;

function __construct(){
try {
    $options = array();
    $this->dbh = new PDO('pgsql:host=107.20.159.155;port=5432;dbname=dahrcqpca41iek',"kyffrcjeajphaz", "Show");
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