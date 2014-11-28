<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
  if($authenticated){
      echo "<a href='/auth/logout'>logout</a><br>";
    }else{
      echo "<a href='/auth/login'>login</a><br>";
    }
  echo "<h1>Shop</h1><br>";

echo $_content;
?>
</body>
</html>