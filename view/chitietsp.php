<?php
    include_once('./model/product.classes.php');
    include_once('./model/detailProduct.classes.php');
    $Product = new Product();
    $DetailProduct = new DetailProduct();
    if($_GET['quanly'] == 'chitiet' && isset($_GET['id'])) {
        $id_product = $_GET['id'];
    }
    $product = $Product->getProductId($id_product);
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
<form action="#" method="POST" class="nav" name="myForm">
    <?php
        $i = 0;
        foreach($product as $item) {
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
                                name ="size" 
                                value="'<?php echo $detailItem['detail_size'] ?>'"
                                data-price="<?php echo $detailItem['detail_price'] ?>"
                                data-soluong="<?php echo $detailItem['inventory'] ?>"
                                onchange="setPrice()"
                                <?php echo $i == 0 ? "checked": '' ?>
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
                    <input type="number" min="1" class="btn" value="2">
                </div>
                <p class="remaining-product">62</p>
                <!-- <div style="width:20% ;"></div> -->
                <div class="product-box-btn">
                    <!-- <button type="submit" class="btn">APPLY COUPY</button> -->
                    <input type="submit" class="btn" name="" id="" value="Add to Cart">
                </div>
            </div>
            <input type="text" hidden name="id_product" value="<?php echo $item['id_product'] ?>">
            <input type="text" hidden name="img_product" value="<?php echo $item['img_product'] ?>">
            <input type="text" hidden name="price_product" value="<?php echo $item['gia_product'] ?>">
            <input type="text" hidden name="title_product" value="<?php echo $item['title_product'] ?>">
            <input type="text" hidden name="subtitle_product" value="<?php echo $item['subtitle_product']?>">
        </div>
    </div>
    <?php } ?>
</form>
<div class="nav">
    <!-- <div class="nav-box"> -->
        <div class="nav-child">
            <h4 class="title-coupon border-line mb-0">CUSTOMER REVIEW</h4>
            <div class="nav-box">
                <div class="nav-child"><img src="/assets/images/reviewer.webp" alt=""> </div>

                <div class="nav-box">
                    <div class="nav-child">
                        <h4>GERALD BARNES</h4> 
                        <span>27 Jun, 2021 at 2:30pm</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>

                    </div>
                    <!-- <div class="nav-child">GERALD BARNES</div> -->
                </div>
            </div>
            <div class="nav-box">
                <div class="nav-child"><img src="/assets/images/reviewer.webp" alt=""> </div>
                <div class="nav-box">
                    <div class="nav-child">
                        <h4>GERALD BARNES</h4> 
                        <span>27 Jun, 2021 at 2:30pm</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>

                    </div>
                    <!-- <div class="nav-child">GERALD BARNES</div> -->
                </div>
            </div>
        </div>
        <div class="nav-child pt-0 pb-0">
            <h4 class="title-coupon border-line mb-0">Leave your review</h4>
            <form action="#">
                <div class="nav-box pt-0 pb-0 mt-5">
                    <div class="nav-child w100 pt-0 pb-0">
                        <textarea class="custom-textarea" name="message" placeholder="Your review here..."></textarea>
                        <input type="submit" class="btn mt-5 mb-5 color-btn" name="" id="" value="Submit Review">
                    </div>
                </div>
            </form>
        </div>
       
    </div>

</div>

<script>
    function setPrice () {
        const price = document.querySelector('input[name="size"]:checked')
        const inputPrice = document.querySelector('input[name="price_product"]')
        const inputSoluong = document.querySelector('.remaining-product')
        const priceElement = document.querySelector(".product-price");
        let priceFormat = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price.getAttribute("data-price"))
        priceElement.innerHTML = priceFormat
        inputPrice.value = price.getAttribute("data-price")
        inputSoluong.innerHTML = `Số lượng còn lại: ${price.getAttribute("data-soluong")}`
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