<?php
Class Orm{
  protected $table_name;
  protected $properties;
  protected $values;
  protected $dbh;
  protected $lastInsertId;

  function __construct($argument=array()){
    $this->values=$argument;
  }

  function __destruct(){
    $this->dbh=null;
  }

  public function setValues($args){
    $this->values=$args;
  }

  public function save(){
  $this->getDbh();
  $question_marks=array();
  for($i=count($this->properties);$i>0;$i--){
    $question_marks[]="?";
  }
  $place_holders=implode(',',$question_marks);
  $keys=implode(',',$this->properties);
  $sql="insert into $this->table_name ($keys) values ($place_holders)";
    $sth = $this->dbh->prepare($sql);
    $flag=false;
    $class_name=get_class($this);
    $class_name=lcfirst($class_name);
    $for_lastInsertId=$class_name."s_id_seq";
    try{
    $this->dbh->beginTransaction();
    $flag=$sth->execute($this->values);
    //$this->lastInsertId=$this->dbh->lastInsertId();
    $this->lastInsertId=$this->dbh->lastInsertId($for_lastInsertId);
    $this->dbh->commit();
    }catch (Exception $e) {
    $this->dbh->rollBack();
    echo "エラーが発生しました。" . $e->getMessage();
    }
    if (!$flag){
        print('エラーが発生しました。<br>');
    }
    $dbh = null;
  }

  public function edit($param1,$param2){
  $this->getDbh();
  $columns=array();
  foreach($param1 as $column){
    $columns[]=$column."=?";
  }
  $columns=implode(',',$columns);
  $sql="update $this->table_name set $columns where id = ?";
    $sth = $this->dbh->prepare($sql);
    $flag=$sth->execute($param2);
    if (!$flag){
        print('エラーが発生しました。<br>');
    }
    $dbh = null;
    $flag=null;
  }

public function delete($param1){
  $this->getDbh();
  $sql="delete from $this->table_name where id = ?";
    $sth = $this->dbh->prepare($sql);
    $flag=$sth->execute(array($param1, ));
    if (!$flag){
        print('エラーが発生しました。<br>');
    }
    $dbh = null;
  }

  public function findAll(){
  $this->getDbh();
  $sql="SELECT * from $this->table_name";
    $records=$this->dbh->query($sql);
    $dbh = null;
    return $records;
  }

  public function findOne($param1){
  $this->getDbh();
  $sql="SELECT * from $this->table_name WHERE id = ?";
  $sth = $this->dbh->prepare($sql);
  $sth->execute(array($param1,));
  $records = $sth->fetch();
    $this->dbh = null;
  return $records;
  }

  public function findBy($param1,$param2){
  $this->getDbh();
  $sql="SELECT * from $this->table_name WHERE $param1 = ?";
  $sth = $this->dbh->prepare($sql);
  $sth->execute(array($param2,));
  $records = $sth->fetchAll();
    $this->dbh = null;
  return $records;
  }

  public function getLastInsertId(){
    return $this->lastInsertId;
  }

  protected function getDbh(){
try {
    $db = new Db();
    $this->dbh=$db->getDbh();
  }catch (PDOException $e) {
    print "error: " . $e->getMessage() . "<br/>";
    die();
    }
  }
}
?>