<?php
include_once('./model/product.classes.php');
include_once('./model/slider.classes.php');
$Product = new Product();
$Slider = new Slider();
?>
<div class="slider">
    <?php
        $sliderList = $Slider->getSliders();
        foreach($sliderList as $row_slider) {
    ?>
    <div class="slider-item">
        <img src="<?php echo $row_slider['slider_img'] ?>" alt="" class="slider-image">
        <div class="text">
            <p class="subtitle"><?php echo $row_slider['slider_subtitle'] ?></p>
            <p class="title"><?php echo $row_slider['slider_title'] ?></p>
            <p class="description"><?php echo $row_slider['description'] ?></p>
            <a href="<?php echo $row_slider['slider_link'] ?>" class="btn-shopping">MUA NGAY</a>
        </div>
    </div>
    <?php }?>
</div>
<div class="main">
    <div class="category-container">
        <div class="container">
            <div class="category">
                <div class="category-item left">
                    <img src="./assets/images/category 1.webp" alt="">
                    <div class="context">
                        <div class="info">
                            <p class="product-name">Bàn trang trí</p>
                            <p class="subname">Nội thất</p>
                        </div>
                        <a href="#" class="btn-shopping">Mua Ngay</a>
                    </div>
                </div>
                <div class="category-item right">
                    <img src="./assets/images/category 2.webp" alt="">
                    <div class="context">
                        <div class="info">
                            <p class="product-name">Ghế tựa cao cấp</p>
                            <p class="subname">Nội thất</p>
                        </div>
                        <a href="#" class="btn-shopping">Mua Ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="featured-container">
            <div class="container">
                <h2 class="title">Sản phẩm nổi bật</h2>
                <div class="product-list">
                    <?php
                        $productList = $Product->getFeaturedProducts(10);
                        foreach($productList as $item) {                       
                    ?>
                        <a href="index.php?quanly=chitiet&id=<?php echo $item['id_product'] ?>" class="product-item">
                        <img src="<?php echo $item['img_product'] ?>" alt="">
                        <div class="product-info">
                            <p class="product-name"><?php echo $item['title_product'] ?></p>
                            <p class="product-price"><?php echo number_format($item['detail_price'], 0, '', '.') ?> đ</p>
                            <button class="btn-addtocart">
                                Mua Ngay
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="featured-container">
            <div class="container">
                <h2 class="title">Sản phẩm bán chạy</h2>
                <div class="product-list">
                    <?php
                        $productList = $Product->getBestSellerProducts(10);
                        foreach($productList as $item) {                       
                    ?>
                        <a href="index.php?quanly=chitiet&id=<?php echo $item['id_product'] ?>" class="product-item">
                        <img src="<?php echo $item['img_product'] ?>" alt="">
                        <div class="product-info">
                            <p class="product-name"><?php echo $item['title_product'] ?></p>
                            <p class="product-price"><?php echo number_format($item['detail_price'], 0, '', '.') ?> đ</p>
                            <button class="btn-addtocart">
                                Mua Ngay
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="brand-container">
        <div class="container">
            <div class="brand-list">
                <div class="brand">
                    <a href="#" class="brand-link">
                        <img src="./assets/images/brand 1.webp" alt="">
                    </a>
                </div>
                <div class="brand">
                    <a href="#" class="brand-link">
                        <img src="./assets/images/brand 2.webp" alt="">
                    </a>
                </div>
                <div class="brand">
                    <a href="#" class="brand-link">
                        <img src="./assets/images/brand 3.webp" alt="">
                    </a>
                </div>
                <div class="brand">
                    <a href="#" class="brand-link">
                        <img src="./assets/images/brand 4.webp" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>