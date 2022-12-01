<?php
  include_once('./model/product.classes.php');
  include_once('./model/detailProduct.classes.php');
  $Product = new Product();
  $DetailProduct = new DetailProduct();

  if(isset($_GET['page'])) {
    $page = $_GET['page'];
  }else {
      $page = 1;
  }

  if($_GET['quanly'] == 'cuahang') {
    if(isset($_GET['id_category'])) {
        $id_category = $_GET['id_category'];
    }else {
        $id_category = 0;
    }
}
?>

<div class="banner">
  <h3 class="title">SHOP</h3>
</div>
<div class="container-shop">
  <form action="#" method="post" class="container-shop-left">
    <form class="container-item">
      <div class="container-search">
          <input type="text" name="search" id="search-product-homepage" placeholder="Search here..."
          onchange="fetchAjaxHomePage()" />
          <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
      </div>
    <div class="container-item">
      <div class="container-categories">
        <div class="title-shop-left">CATEGORIES</div>

        <ul class="categories">
          <li class="categorie">
            <input type="checkbox" name="category" class="categoryCheckbox" value="15" onchange="fetchAjaxHomePage()">
            <label for="category" class="link-categorie">Bàn</label>
          </li>
          <li class="categorie">
            <input type="checkbox" name="category" class="categoryCheckbox" value="19" onchange="fetchAjaxHomePage()">
            <label for="category" class="link-categorie">Ghế</label>
          </li>
          <li class="categorie">
            <input type="checkbox" name="category" class="categoryCheckbox" value="22" onchange="fetchAjaxHomePage()">
            <label for="category" class="link-categorie">Tủ</label>
          </li>
          <li class="categorie">
            <input type="checkbox" name="category" class="categoryCheckbox" value="27" onchange="fetchAjaxHomePage()">
            <label for="category" class="link-categorie">Đồ trang trí</label>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="container-item">
      <div class="container-filter">
        <div class="title-shop-left">PRICE</div>
        <div class="price-amount">
          <h5>You ranger: </h5>
          <div class="section-item fillter">
                <input class="range" type="range" name ="range" min="0" max="10000000" value="1000000000" step="10000"
                    onmousemove="rangevalue1.value=nf.format(value)"
                    onchange="fetchAjaxHomePage()" />
                <div class="price-fillter">
                    <output id="rangevalue">0</output>
                    <output id="rangevalue1">0</output>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="container-item">
      <div class="container-size">
        <div class="title-shop-left">SIZE</div>
        <div class="checkbox">
          <div class="item-checkbox">
            <input type="checkbox" id="size" name ="size" value="'160x40'" 
            onchange="fetchAjaxHomePage()">
            <label for="size">160x40</label>
          </div>
          <div class="item-checkbox">
            <input type="checkbox" id="size2" name ="size" value="'120x40'" 
            onchange="fetchAjaxHomePage()" >
            <label for="size2">120x40</label>
          </div>
          <div class="item-checkbox">
            <input type="checkbox" id="size3" name ="size" value="'180x50'" 
            onchange="fetchAjaxHomePage()" >
            <label for="size3">180x50</label>
          </div>
                  
        </div>
        
      </div>
    </div>

    <div class="container-item">
      <div class="container-best-brand">
        <img src="assets/images/best-brand.webp" alt="" class="img-best-brand">
        
      </div>
    </div>
  </form>
  <div class="container-shop-right">
    <div class="top-shop">
      <div class="option-top-shop">
        <button class="btn-op-top-shop">
          <i class="fa-solid fa-list"></i>
        </button>
        <button class="btn-op-top-shop">
          <i class="fa-solid fa-list"></i>
        </button>

        <!-- <div class="down-menu">
        <div class="shop-size">
            <div class="title-menu">

            </div>

            <div class="info-size">
                <ul>
                    <li>S</li>
                    <li>M</li>
                    <li>L</li>
                    <li>XL</li>
                </ul>
            </div>
        </div>
      </div> -->
      </div>

      <div class="text-end">Showing 01-09 of 17 Results</div>
    </div>

    <div class="product-list-shop" id="result">
      <?php
          $productPerPage = 6;
          $countProducts = $Product->getCountProductsByCategory($id_category);
          $countPage = ceil($countProducts / $productPerPage);
          $start = ($page -1) * $productPerPage;
          $productList = $Product->getProductsByCategory($id_category,$productPerPage);
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
    <div class="pagination">
    <?php
            $i = 1;
            while($i <= $countPage) {
    ?>
            <div class="item">
                <input
                    value="<?php echo $i ?>" 
                    onchange="fetchAjaxHomePage()"
                    type="radio" 
                    name="nav" 
                    id="input-<?php echo $i ?>" 
                    class="input-page" <?php echo $i == $page ? 'checked': '' ?>
                />
                <label for="input-<?php echo $i ?>" class="button button-<?php echo $i ?>"> <?php echo $i ?></label>
            </div>
    <?php  
            $i++;
        }
    ?>
</div>
    <!-- <div class="pagination-shop">
      <ul>
        <li>
          <a href="" class="link-product-shop"
            ><i class="fa-solid fa-arrow-left"></i
          ></a>
        </li>
        <li>
          <a href="" class="link-product-shop">01</a>
        </li>

        <li>
          <a href="" class="link-product-shop">02</a>
        </li>

        <li>
          <a href="" class="link-product-shop">03</a>
        </li>

        <li>
          <a href="" class="link-product-shop">04</a>
        </li>

        <li>
          <a href="" class="link-product-shop">05</a>
        </li>
        <li>
          <a href="" class="link-product-shop"
            ><i class="fa-solid fa-arrow-right"></i
          ></a>
        </li>
      </ul>
    </div> -->
  </div>
</div>



