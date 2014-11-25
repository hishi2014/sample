<?php
class User extends Orm{
    protected $password_salt='$2a$04$a7nvrf5hijidm6hsq3st4v';
    protected $table_name='users';
    protected $properties=array("name","hashed_password","password_salt");

  public function findUser($name,$password){
  $this->getDbh();
  $sql="SELECT * from users WHERE name = ?";
  $sth = $this->dbh->prepare($sql);
  $sth->execute(array($name,));
  $record = $sth->fetch();
  if(!empty($record)&&$record['hashed_password']!==crypt($password, $record['hashed_password'])){
    $record=null;
  }
  $this->dbh = null;
  return $record;
  }

  public function saveUser($name,$password){
    $hashed_password = crypt($password, $this->password_salt);
    $param=array($name,$hashed_password,$this->password_salt);
    $sql='insert into users (name,hashed_password,password_salt) values (?,?,?)';
    $this->getDbh();
    $sth = $this->dbh->prepare($sql);
    $flag=false;
    try{
    $this->dbh->beginTransaction();
    $flag=$sth->execute($param);
    $this->lastInsertId=$this->dbh->lastInsertId();
    $this->dbh->commit();
    }catch (Exception $e) {
    $this->dbh->rollBack();
    echo "エラーが発生しました。" . $e->getMessage();
    }
    if ($flag){
        print('正常に処理しました。<br>');
    }else{
        print('エラーが発生しました。<br>');
    }
    $dbh = null;
  }

}
?>