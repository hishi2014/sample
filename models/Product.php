<?php
class Product extends Orm{
    protected $table_name='products';
    protected $properties=array("name","price","category_id");
}
?>