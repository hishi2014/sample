<?php
if(isset($_SESSION['flash'])){
  echo $_SESSION['flash']."<br>";
  $_SESSION["flash"]=null;}
?>