<?php
class Order extends Orm{
    protected $table_name='orders';
    protected $properties=array("user_id","total_price");
}
?>