
<html>
<h1>Product</h1>
<table>
<tbody>
<?php foreach ($products as $item): ?>
  <tr>
        <td><?php echo $item["name"]; ?></td>
      <td><?php echo $item["price"]; ?></td>
      <td><?php echo $item["category_id"]; ?></td>
      <td><?php echo "<a href='show?id=$item[0]'>show</a>"; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<a href='/product/new'>create</a>
</html>