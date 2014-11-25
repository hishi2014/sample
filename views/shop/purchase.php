<html>
<?php
echo "order id: $order_id <br>";
  ?>
<table>
<thead></thead>
<tr><td>名前</td><td>価格</td><td>個数</td><td>小計</td></tr>
<?php foreach ($items as $item): ?>
  <tr>
        <td><?php echo $item->name; ?></td>
      <td><?php echo $item->price; ?></td>
      <td><?php echo $item->amount; ?></td>
      <td><?php echo $a=$item->price*$item->amount; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php
echo "合計: $total_price <br>";
?>
<a href ="/shop/index">ホーム</a>
</html>