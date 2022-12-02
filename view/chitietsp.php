<?php
    include_once('./model/product.classes.php');
    include_once('./model/detailProduct.classes.php');
    include_once('./model/cart.classes.php');
    include_once('./model/comment.classes.php');
    include_once('./model/user.classes.php');
    $Product = new Product();
    $DetailProduct = new DetailProduct();
    $Cart = new Cart();
    $Comment = new Comment();
    $User = new User();

    if($_GET['quanly'] == 'chitiet' && isset($_GET['id'])) {
        $id_product = $_GET['id'];
    }
    
    if(isset($_POST['themgiohang'])) {
        if(isset($_POST['id_detailProduct']) && isset($_POST['amount']) ) {
            $id_detailProduct = $_POST['id_detailProduct'];
            $amount = $_POST['amount'];
            $img_product = $_POST['img_product'];
            $title_product = $_POST['title_product'];
            $subtitle_product = $_POST['subtitle_product'];
            $Cart->addToCart($id_detailProduct,$amount,$img_product,$title_product,$subtitle_product);
        }
    }
    
    if(isset($_POST['submit_comment'])) {
        if(isset($_POST['message']) && $_POST['message']) {
            $id_user_comment = Session::getValueSession('user');
            $message = $_POST['message'];
            $Comment->insertComment($message,$id_product,$id_user_comment);
        }
    }
?>

<div class="heading-banner overlay-bg">
    <div class="container">
        <div class="heading-banner-title">
            <h2>Single Product</h2>
        </div>
        <!-- <div class="accessPlace pb-15">
            <ul>
                <li><a href="#">Home</a></li>
                <li>/</li>
                <li>Single Product</li>
            </ul>
        </div> -->
    </div>
</div>
<form action="<?php echo Session::getValueSession('user') ? '' : 'index.php?quanly=login' ?>" method="POST" class="nav" name="myForm">
    <?php
        $i = 0;
        $product = $Product->getProductId($id_product);
        foreach($product as $item) {
            $max = 0;
    ?>
    <div class="detailInforProduct">
        <div class="slider-for">
            <div class="product1"> <img src="<?php echo $item['img_product'] ?>" alt="product1"></div>
        </div>
        <div class="box">
            <h3><?php echo $item['title_product'] ?></h3>
            <p class="product-price">$ 56.20</p>
            <p class="procduct__des"><?php echo $item['des_product'] ?></p>
            <div class="product-color">
                <p class="label-checkbox">Chọn kích cỡ sản phẩm</p>
                <div class="checkbox">
                    <?php
                        $detailProduct = $DetailProduct->getDetailProductsByProduct($id_product) ;
                        foreach($detailProduct as $detailItem)  {                      
                    ?>
                        <div class="item-checkbox">
                            <input 
                                type="radio" 
                                id="<?php echo "size$i" ?>" 
                                name ="id_detailProduct" 
                                value="'<?php echo $detailItem['id_detailProduct'] ?>'"
                                data-price="<?php echo $detailItem['detail_price'] ?>"
                                data-soluong="<?php echo $detailItem['inventory'] ?>"
                                onchange="setPrice()"
                                <?php echo $i == 0 ? "checked": '' ?>
                                <?php echo $detailItem['inventory'] <= 0 ? "disabled": '' ?>
                            >
                            <label for="<?php echo "size$i" ?>"><?php echo $detailItem['detail_size'] ?></label>
                        </div> 
                    <?php 
                        $i++; 
                        }
                    ?>             
                </div>
            </div>
            <div class="product-btn">
                <div class="product-box-btn">
                    <input type="number" 
                        name="amount" 
                        min="1"
                        class="btn" 
                        value="1">
                </div>
                <p class="remaining-product">62</p>
                <!-- <div style="width:20% ;"></div> -->
                <div class="product-box-btn">
                    <!-- <button type="submit" class="btn">APPLY COUPY</button> -->
                    <input type="submit" class="btn" name="themgiohang" id="" value="Add to Cart">
                </div>
            </div>
            <input type="text" hidden name="img_product" value="<?php echo $item['img_product'] ?>">
            <input type="text" hidden name="title_product" value="<?php echo $item['title_product'] ?>">
            <input type="text" hidden name="subtitle_product" value="<?php echo $item['subTitle_product']?>">
        </div>
    </div>
    <?php } ?>
</form>


<div class="nav">
    <!-- <div class="nav-box"> -->
        <div class="nav-child">
            <h4 class="title-coupon border-line mb-0">CUSTOMER REVIEW</h4>
            <?php 
                $listComment = $Comment->getCommmentsOfProduct($id_product);
                foreach($listComment as $row_comment) {
                    $id_user = $row_comment['id_user'];
                    $user = $User->getUserId($id_user);
                    foreach($user as $row_user) {
            ?>
            <div class="nav-box">
                <div class="nav-child"><img src="<?php echo $row_user['avatar'] ?>" alt=""> </div>

                <div class="nav-box">
                    <div class="nav-child">
                        <h4><?php echo $row_user['user_name'] ?></h4> 
                        <span>27 Jun, 2021 at 2:30pm</span>
                        <p><?php echo $row_comment['comment_content'] ?></p>

                    </div>
                    <!-- <div class="nav-child">GERALD BARNES</div> -->
                </div>
            </div>
            <?php } } ?>
        </div>
        <div class="nav-child pt-0 pb-0">
            <h4 class="title-coupon border-line mb-0">Leave your review</h4>
            <form action="" method="POST">
                <div class="nav-box pt-0 pb-0 mt-5">
                    <div class="nav-child w100 pt-0 pb-0">
                        <textarea class="custom-textarea" name="message" placeholder="Your review here..."></textarea>
                        <input type="submit" class="btn mt-5 mb-5 color-btn" name="submit_comment" id="" value="Submit Review">
                    </div>
                </div>
            </form>
        </div>
       
    </div>

</div>

<script>
    function setPrice () {
        const price = document.querySelector('input[name="id_detailProduct"]:checked')
        const inputSoluong = document.querySelector('.remaining-product')
        const priceElement = document.querySelector(".product-price")
        const countElement = document.querySelector('input[type="number"]')
        let priceFormat = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price.getAttribute("data-price"))
        priceElement.innerHTML = priceFormat
        inputSoluong.innerHTML = `Số lượng còn lại: ${price.getAttribute("data-soluong")}`
        countElement.setAttribute("max", price.getAttribute("data-soluong"))

    }
    setPrice();
    const form = document.querySelector('form[name="myForm"]')
    form.addEventListener('submit', (e) => {
        if(!getCookie('user')) {
            e.preventDefault()
            window.location.href = 'index.php?quanly=login'
        }
    })
</script>