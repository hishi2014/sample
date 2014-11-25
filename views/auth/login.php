<html>
<?php
if(isset($_SESSION['user'])){
  echo $_SESSION['user']['name'];
}
if(isset($_SESSION['flash'])){
  echo $_SESSION['flash']."<br>";
  $_SESSION["flash"]=null;}
?>
<form action="/auth/login" method="post">
  <input type="text" name="name">
  <input type="password" name="password">
  <input type="hidden" name="_token" value="<?php echo $_token; ?>">
  <input type="submit">
</form>
<a href='/auth/signup'>signup</a>
</html>