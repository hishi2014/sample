<html>

<?php
?>
<head>
<title>  こんにちはサンプル </title>
<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
    <script>
    $(document).ready(function()
    {
        $('#send').click(function()
        {
            var data = {request : $('#request').val()};
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
    <h1>jQuery & Ajax & PHP Example</h1>
    <form method="post">
        <p><textarea id="request" cols="20" rows="4"></textarea></p>
        <p><input id="send" value="送信" type="submit" /></p>
    </form>
    <div id="unko"></div>
</body>
</html>
</html>