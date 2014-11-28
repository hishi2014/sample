
<?php
echo "$comment <br>";
echo "order id: $order_id <br>";
  ?>
<table style="text-align:right;">
<thead></thead>
<tr><td>名前</td><td>価格</td><td>個数</td><td>小計</td></tr>
<?php foreach ($items as $item): ?>
  <tr>
      <td><?php echo $item->name; ?></td>
      <td><?php echo $item->price; ?></td>
      <td><?php echo $item->amount; ?></td>
      <td><?php echo $item->price*$item->amount; ?></td>
</tr>
<?php endforeach; ?>
<tr><td></td><td></td><td>合計</td><td><?php echo $total_price;?></td></tr>
</table>

<a href ="/shop/index">ホーム</a>