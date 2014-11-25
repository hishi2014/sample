
<html>
<table>
<tbody>
<thead><h2>カート</h2></thead>
<tr><td>名前</td><td>価格</td><td>個数</td><td>小計</td></tr>
<?php
$total_price=0;
if(!empty($items)){
 foreach ($items as $item): ?>
  <tr>
        <td><?php echo $item->name; ?></td>
      <td><?php echo $item->price; ?></td>
      <td><?php echo $item->amount; ?></td>
      <td><?php echo $a=$item->price*$item->amount; ?></td>
</tr>
<?php $total_price+=$a?>
<?php endforeach;} ?>
<tr><td></td><td></td><td>合計</td><td><?php echo $total_price;?></td></tr>
</tbody>
</table>
<a href='/shop/order'>注文</a><br>
<a href ="/shop/index">ホーム</a>
</html>
