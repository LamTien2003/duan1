<?php
include_once('../model/db.classes.php');
include_once('../model/product.classes.php');
include_once('../model/user.classes.php');
include_once('../model/category.classes.php');
include_once('../model/bill.classes.php');

if(isset($_POST['searchProduct']) && isset($_POST['page']) && isset($_POST['limit'])) {
    $Product = new Product();
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $value = $_POST['searchProduct'];
    $resultQuery = $Product->searchProduct($value,$page,$limit);
    $countTotalProduct = $resultQuery['countTotalProduct'];
    $data = $resultQuery['data'];
    $countPagination = ceil($countTotalProduct / $limit);

    $result = ["pagination" => $countPagination,
    "data" => $data];
    echo json_encode($result);

}
if(isset($_POST['searchUser']) && isset($_POST['page']) && isset($_POST['limit'])) {
    $User = new User();
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $value = $_POST['searchUser'];
    $resultQuery = $User->searchUser($value,$page,$limit);
    $countTotalUser = $resultQuery['countTotalUser'];
    $data = $resultQuery['data'];
    $countPagination = ceil($countTotalUser / $limit);

    $result = ["pagination" => $countPagination,
    "data" => $data];
    echo json_encode($result);
}
if(isset($_POST['searchCategory']) && isset($_POST['page']) && isset($_POST['limit'])) {
    $Category = new Category();
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $value = $_POST['searchCategory'];
    $resultQuery = $Category->searchCategory($value,$page,$limit);
    $countTotalCategory = $resultQuery['countTotalCategory'];
    $data = $resultQuery['data'];
    $countPagination = ceil($countTotalCategory / $limit);

    $result = ["pagination" => $countPagination,
    "data" => $data];
    echo json_encode($result);
}
if(isset($_POST['searchBill']) && isset($_POST['page']) && isset($_POST['limit'])) {
    $Bill = new Bill();
    $page = $_POST['page'];
    $limit = $_POST['limit'];
    $value = $_POST['searchBill'];
    $resultQuery = $Bill->searchBill($value,$page,$limit);
    $countTotalBill = $resultQuery['countTotalBill'];
    $data = $resultQuery['data'];
    $countPagination = ceil($countTotalBill / $limit);

    $result = ["pagination" => $countPagination,
    "data" => $data];
    echo json_encode($result);
}
?>