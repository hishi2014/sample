
<html>
<head>
<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
    <script>
    $(function()
    {
    $(".amount").bind('keyup mouseup', function () {
    $(this).parent().next().html($(this).val()*$(this).parent().prev().html());
    $("#total_price").html(0);
    $(".subtotal").each(function(){
          var total_price=parseInt($("#total_price").html());
          total_price=total_price+parseInt($(this).html());
          $("#total_price").html(total_price);
        });
            var data = {amount : $(this).val(),product_id:$(this).prev().html()};
            $.ajax({
                type: "POST",
                url: "/shop/edit",
                data: data,
                success: function(data, dataType)
                {
                    $("#unko").html(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error : ' + errorThrown);
                }
            });
            return false;
  });
  });
    </script>
</head>
<body>
<table style="text-align:right;">
<tbody>
<thead><h2>カート</h2></thead>
<tr><td>名前</td><td>価格</td><td>個数</td><td>小計</td><td></td></tr>
<?php
$total_price=0;
if(!empty($items)){
 foreach ($items as $item): ?>

  <tr>
        <td><?php echo $item->name; ?></td>
      <td ><?php echo $item->price; ?></td>
      <td><span style="display:none"><?php echo $item->product_id; ?></span><input class="amount" type="number" value="<?php echo $item->amount; ?>" min="1" max="100"></td>
      <td class="subtotal"><?php echo $a=$item->price*$item->amount; ?></td>
      <td><a href="/shop/delete?product_id=<?php echo $item->product_id; ?>">削除</a></td>
</tr>
<?php $total_price+=$a?>
<?php endforeach;} ?>
<tr><td></td><td></td><td>合計</td><td id="total_price"><?php echo $total_price;?></td><td></td></tr>
</tbody>
</table>
<a href='/shop/order'>レジに進む</a><br>
<a href ="/shop/index">ホーム</a>
</body>
</html>
