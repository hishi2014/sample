<html>
<table>
<thead><h2>注文詳細</h2></thead>
<td>名前</td><td>価格</td><td>個数</td><td>小計</td>
<?php
$total_price=0;
 foreach ($items as $item): ?>
  <tr>
        <td><?php echo $item->name; ?></td>
      <td><?php echo $item->price; ?></td>
      <td><?php echo $item->amount; ?></td>
      <td><?php echo $a=$item->price*$item->amount; ?></td>
</tr>
<?php $total_price+=$a?>
<?php endforeach; ?>
<tr><td></td><td></td><td>合計</td><td><?php echo $total_price;?></td></tr>
</tbody>
</table>
<form action="/shop/purchase" method="post">
  <input type="hidden" name="total_price" value='<?php echo $total_price;?>'>
  <input type="submit" value="購入">
</form>
</html>