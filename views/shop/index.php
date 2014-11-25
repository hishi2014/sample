<html>
<table>
<thead><h2>products</h2></thead>
<tbody>
<tr><td>名前</td><td>価格(円)</td><td></td></tr>
<?php foreach ($products as $item): ?>
  <tr>
        <td><?php echo $item["name"]; ?></td>
      <td><?php echo $item["price"]; ?></td>
      <td><?php echo "<a href='show/?id=$item[0]'>個別表示</a>"; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</html>