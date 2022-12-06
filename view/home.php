<?php
    include_once('./model/product.classes.php');
    $Product = new Product();
?>
    <div class="slider">
        <div class="slider-item">
            <img src="./assets/images/slider 1.webp" alt="" class="slider-image">
            <div class="text">
                <p class="subtitle">WELCOME TO OUR</p>
                <p class="title">ELEGENT <br> FURNITURE</p>
                <p class="description">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there hidden in the middle of text.</p>
                <a href="#" class="btn-shopping">SHOP NOW</a>
            </div>
        </div>
        <div class="slider-item">
            <img src="./assets/images/slider 2.webp" alt="" class="slider-image">
            <div class="text">
                <p class="subtitle">WELCOME TO OUR</p>
                <p class="title">ELEGENT <br> FURNITURE</p>
                <p class="description">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there hidden in the middle of text.</p>
                <a href="#" class="btn-shopping">SHOP NOW</a>
            </div>
        </div>
        <div class="slider-item">
            <img src="./assets/images/slider 1.webp" alt="" class="slider-image">
            <div class="text">
                <p class="subtitle">WELCOME TO OUR</p>
                <p class="title">ELEGENT <br> FURNITURE</p>
                <a href="#" class="btn-shopping">SHOP NOW</a>
            </div>
        </div>
    </div>
    <div class="main" >
        <div class="category-container">
            <div class="container">
                <div class="category">
                    <div class="category-item left">
                        <img src="./assets/images/category 1.webp" alt="">
                        <div class="context">
                            <div class="info">
                                <p class="product-name">Product name</p>
                                <p class="subname">FURNITURE</p>
                            </div>
                            <a href="#" class="btn-shopping">Buy Now</a>
                        </div>
                    </div>
                    <div class="category-item right">
                        <img src="./assets/images/category 2.webp" alt="">
                        <div class="context">
                            <div class="info">
                                <p class="product-name">Product name</p>
                                <p class="subname">FURNITURE</p>
                            </div>
                            <a href="#" class="btn-shopping">Buy Now</a>
                        </div>
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
                            <p class="product-price"><?php echo number_format($item['detail_price'], 0, '', '.')?> đ</p>
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
                            <p class="product-price"><?php echo number_format($item['detail_price'], 0, '', '.')?> đ</p>
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
