<html>
<?php
?>
<form action="/auth/signup" method="post">
  <input type="text" name="name">
  <input type="password" name="password">
  <input type="hidden" name="_token" value="<?php echo $_token; ?>">
  <input type="submit">
</form>
</html>