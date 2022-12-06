<?php
include_once('./model/product.classes.php');
$Product = new Product();
?>
<div class="slider">
    <div class="slider-item">
        <img src="./assets/images/slider 1.webp" alt="" class="slider-image">
        <div class="text">
            <p class="subtitle">CHÀO MỪNG ĐẾN VỚI CHÚNG TÔI</p>
            <p class="title">NỘI THẤT <br> CAO CẤP</p>
            <p class="description">Nội thất FUHO là thương hiệu nội thất văn phòng chính hãng hàng đầu Việt Nam, chuyên sản xuất và cung ứng nội thất cho hàng ngàn công ty, văn phòng, cá nhân trên cả nước.
                Dựa trên ý tưởng cốt lõi: “Like a boss” FUHO cam kết giúp khách hàng chọn lựa được những sản phẩm có chất lượng vượt bậc với giá thành hợp lý nhất.
                Hãy trải nghiệm cảm giác “Như một ông chủ” thực thụ khi sử dụng sản phẩm và dịch vụ chính hãng của chúng tôi.</p>
            <a href="#" class="btn-shopping">MUA NGAY</a>
        </div>
    </div>
    <div class="slider-item">
        <img src="./assets/images/slider 2.webp" alt="" class="slider-image">
        <div class="text">
            <p class="subtitle">CHÀO MỪNG ĐẾN VỚI CHÚNG TÔI</p>
            <p class="title">NỘI THẤT <br> CAO CẤP</p>
            <p class="description">Nội thất FUHO là thương hiệu nội thất văn phòng chính hãng hàng đầu Việt Nam, chuyên sản xuất và cung ứng nội thất cho hàng ngàn công ty, văn phòng, cá nhân trên cả nước.
                Dựa trên ý tưởng cốt lõi: “Like a boss” FUHO cam kết giúp khách hàng chọn lựa được những sản phẩm có chất lượng vượt bậc với giá thành hợp lý nhất.
                Hãy trải nghiệm cảm giác “Như một ông chủ” thực thụ khi sử dụng sản phẩm và dịch vụ chính hãng của chúng tôi.</p>
            <a href="#" class="btn-shopping">MUA NGAY</a>
        </div>
    </div>
    <div class="slider-item">
        <img src="./assets/images/slider 1.webp" alt="" class="slider-image">
        <div class="text">
            <p class="subtitle">CHÀO MỪNG ĐẾN VỚI CHÚNG TÔI</p>
            <p class="title">NỘI THẤT CAO CẤP</p>
            <a href="#" class="btn-shopping">MUA NGAY</a>
        </div>
    </div>
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
    </div>
    <div class="featured-container">
        <div class="container">
            <h2 class="title">Featured Products</h2>
            <div class="product-list">
                <?php
                $productList = $Product->getFeaturedProducts(10);
                foreach ($productList as $item) {
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
    <div class="featured-container">
        <div class="container">
            <h2 class="title">BestSeller Products</h2>
            <div class="product-list">
                <?php
                $productList = $Product->getBestSellerProducts(10);
                foreach ($productList as $item) {
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