<?php
Class Db{

  private $dbh;

function __construct(){
try {
    $options = array();
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $this->dbh = new PDO($dsn, $url['user'], $url['pass']);
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