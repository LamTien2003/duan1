<?php
include_once('../model/db.classes.php');
include_once('../model/bill.classes.php');
include_once('../model/product.classes.php');
include_once('../model/category.classes.php');

if(isset($_POST['action']) && $_POST['action'] == 'fetchChart') {
    $Bill = new Bill();
    $Product = new Product();
    $Category = new Category();
    $dataBill = $Bill->getDataChart();
    $dataProduct = $Product->getBestSellerProducts(5);
    $dataCategory = $Category->getBestSellerCategory(5);
    $result = ["bill" => $dataBill, "product" => $dataProduct, "category" => $dataCategory];
    echo json_encode($result);
}
?>