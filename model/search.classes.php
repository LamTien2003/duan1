<?php
include_once('../model/category.classes.php');
class Search extends DB {
    public function searchProductHomePage($search,$range,$category,$size,$page,$limit) {
        $start = ($page -1) * $limit;
        $sql = "Select * from product INNER JOIN detailproduct ON product.id_product = detailproduct.id_product GROUP BY product.id_product HAVING title_product LIKE '%$search%' AND detail_price <= '$range'";
        if(count($category) > 1) {
            $Category = new Category();
            $arrayChild = $Category->getArrayChildCategory($category);
            $stringCategory = implode(",",array_merge($category,$arrayChild));
            $sql .= "AND id_category IN($stringCategory) ";
        }else {
            $sql .="";
        }
        if(count($size) > 1) {
            $stringSize = implode(",",$size);
            $sql .= " AND detail_size IN($stringSize)";
        }else {
            $sql .="";
        }
        $sqlResult =  $sql."LIMIT $start,$limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $countTotalProduct = $stmt->rowCount();
        $stmt = $this->connect()->prepare($sqlResult);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return ["countTotalProduct" => $countTotalProduct, "data" => $result];
        // return $arrayChild;
    }
}

?>