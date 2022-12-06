<?php
    include_once('./model/cart.classes.php');
    include_once('./model/detailProduct.classes.php');
    include_once('./model/user.classes.php');
    $Cart = new Cart();
    $DetailProduct = new DetailProduct();
    $User = new User();
    $id_user = Session::getValueSession("user");

    if(isset($_GET['delete_product']) ) {
        $delete_index = $_GET['delete_product'];
        $Cart->deteleProductFromCart($delete_index,$id_user);   
    }
    if(isset($_POST['submit_pay'])) {
        $amount = $id_detailProduct = $title = $img = $size = $price = array();
        $pointUsed = 0;
        $amount = $_POST['amount'];
        $id_detailProduct = $_POST['id_detailProduct'];
        $title = $_POST['title'];
        $img = $_POST['img'];
        $size = $_POST['size'];
        $price = $_POST['price'];

        $name = $_POST['username'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        if(isset($_POST['pointUsed'])) {
            $pointUsed = $_POST['pointUsed'];
        }
        $totalMoney = $_POST['total-money'];
        $totalPay = $_POST['total-bill'];
        $Cart->payCart($amount,$id_detailProduct,$title,$img,$size,$price,$name,$phone,$address,$pointUsed,$totalMoney,$totalPay,$id_user);
    }
?>
<div class="heading-banner overlay-bg">
    <div class="container">
        <div class="heading-banner-title">
            <h2>Giỏ hàng</h2>
        </div>
        <!-- <div class="accessPlace pb-15">
            <ul>
                <li><a href="#">Home</a></li>
                <li>/</li>
                <li>Shopping Cart</li>
            </ul>
        </div> -->
    </div>
</div>
<form action="" method="POST">
    <div class="nav">
        <div class="nav-child">
            <div >
                <div class="cart-table">
                    <div class="table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-infor">Sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;
                                    $list = $Cart->getCartOfUser($id_user);
                                    foreach($list as $key => $item) {
                                        $detailProduct = $DetailProduct->getDetailProductById($item['id']);
                                        foreach($detailProduct as $row_detail) {
                                            $total += ($row_detail['detail_price'] * $item['amount']);
                                ?>
                                    <tr class="product-item">
                                        <td class="product-infor  text-left">

                                            <div class="product-title-box">
                                                <div class="product-img">
                                                    <a href="#"><img src="<?php echo $item['img'] ?>" alt=""></a>
                                                </div>
                                                <div class="product-detail">
                                                    <h4 class="post-title"><a class="text-light-black" href="#"><?php echo $item['title'] ?></a></h4>
                                                    <p class="mb-0"><?php echo $item['subtitle'] ?></p>
                                                    <p class="mb-0">Kích cỡ:<?php echo $row_detail['detail_size'] ?></p>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="product-price">
                                            <?php echo number_format($row_detail['detail_price'], 0, '', '.') ?> đ
                                        </td>
                                        <td class="product-quantity">
                                            <input type="number"
                                                min="0"
                                                max="<?php echo $row_detail['inventory'] ?>" 
                                                value="<?php echo $item['amount'] ?>" 
                                                name="amount[]"
                                                onchange="changeTotalPrice()"
                                            >
                                        </td>
                                        <td class="product-subtotal">
                                            <?php echo number_format($row_detail['detail_price'] * $item['amount'], 0, '', '.')?> đ 
                                        </td>
                                        <td class="product-remove">
                                            <a href="?quanly=giohang&delete_product=<?php echo $key ?>">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <input type="text" hidden name="id_detailProduct[]" value="<?php echo $item['id'] ?>">
                                            <input type="text" hidden name="title[]" value="<?php echo $item['title'] ?>">
                                            <input type="text" hidden name="img[]" value="<?php echo $item['img'] ?>">
                                            <input type="text" hidden name="size[]" value="<?php echo $row_detail['detail_size'] ?>">
                                            <input type="text" hidden name="price[]" value="<?php echo $row_detail['detail_price'] ?>">
                                        </td>
                                    </tr>
                                    
                                    
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="nav">
        <div class="nav-box">
            <div class="nav-child" style="width: 48.5%; padding-right: 2.5%;">
                <h4 class="title-coupon border-line">Thông tin đặt hàng</h4>
                <p class="text-titile">Nhập đầy đủ các thông tin cá nhân của bạn</p>
                
                <div class="form-group">
                    <label for="username" class="form-label">Tên người nhận</label>
                    <input type="text" name="username" placeholder="Nhập tên người nhận" class="coupon form-control">
                    <div class="form-message"></div>
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Số điện thoại người nhận</label>
                    <input type="text" name="phone" placeholder="Nhập số điện thoại" class="coupon form-control">
                    <div class="form-message"></div>
                </div>
                <div class="form-group">
                    <label for="address" class="form-label">Địa chỉ giao hàng</label>
                    <input type="text" name="address" placeholder="Nhập địa chỉ giao hàng" class="coupon form-control">
                    <div class="form-message"></div>
                </div>
            </div>
            <div class="nav-mid"></div>
            <div class="nav-child payment">
        
                    <h4 class="title-coupon border-line">Thông tin hóa đơn</h4>
                    <table class="table-spc">
                        <tbody>
                            <tr>
                                <td class="text-left " >Tổng giá các sản phẩm</td>
                                <td class="text-end sub-total"><?php echo number_format($total, 0, '', '.') ?> đ</td>
                            </tr>
                            <tr>
                                <td class="text-left">Phí vận chuyển</td>
                                <td class="text-end">30.000 đ</td>
                            </tr>
                            <tr>
                                <td class="text-left">Giảm từ điểm thưởng</td>
                                <td class="text-end discount">0 đ</td>
                            </tr>
                            <tr>
                                <td class="text-left" style="font-weight: bold;">Tổng tiền</td>
                                <td class="text-end total" style="font-weight: bold;">
                                <?php echo number_format($total + 30000, 0, '', '.') ?> đ
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                    <div class="submit-pay">
                        <div class="coupon-mode">
                            <?php
                                $user = $User->getUserId($id_user);
                                foreach($user as $row_user) {
                            ?>
                                <p>Bạn đang có <strong><?php echo $row_user['point_available'] ?></strong> điểm thưởng, bạn muốn sử dụng?</p>
                                <div class="coupon-button">
                                    <input 
                                        type="checkbox" 
                                        class="checkbox-coupon" 
                                        id="checkbox-coupon"
                                        name="pointUsed"
                                        data-discount ="<?php echo $row_user['point_available'] ?>"
                                        value="0"
                                        onchange="changeTotalPrice()"
                                    >
                                    <label for="checkbox-coupon" class="label-checkbox-coupon">
                                        <div class='ball'></div>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <input type="text" 
                            hidden 
                            name="total-bill" 
                            value="<?php echo $total + 30000 ?>"
                            >
                        </input>
                        <input type="text" 
                            hidden 
                            name="total-money" 
                            value="<?php echo $total + 30000?>">
                        </input>
                        <input type="submit" class="btn color-btn" name="submit_pay" value="Thanh toán"></input>
                    </div>
        
            </div>
        </div>
    </div>
</form>

<script>
const changeTotalPrice = () => {
    const listProducts = document.querySelectorAll('.product-item') 
    const totalElement = document.querySelector('.total')
    const subTotalElement = document.querySelector('.sub-total')
    const discountElement = document.querySelector('.discount')
    const coupon = document.querySelector('.checkbox-coupon')
    const totalBillInput = document.querySelector('input[name="total-bill"]') 
    const totalMoneyInput = document.querySelector('input[name="total-money"]') 
    let discount = 0;
    if(coupon.checked) {
        coupon.value = coupon.getAttribute("data-discount")
        discount = Number(coupon.value)
    }else {
        coupon.value = 0;
    }
    let total = 0
    listProducts.forEach((product) => {
        const subTotalProduct = product.querySelector('.product-subtotal')
        const price = product.querySelector('input[name="price[]"]')
        const count = product.querySelector('input[name="amount[]"]')
        const subTotal = price.value * count.value
        const formatSubTotal = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(subTotal)
        subTotalProduct.innerHTML = formatSubTotal
        total += subTotal
    })
    const newTotal = (total - discount + 30000) > 0 ? (total - discount + 30000) : 0;
    const totalFormat = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(newTotal)
    const subTotalFormat = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(total)
    const discountFormat = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(discount)
    totalMoneyInput.value = total;
    totalBillInput.value = newTotal;
    totalElement.innerHTML = `${totalFormat}`
    subTotalElement.innerHTML = `${subTotalFormat}`
    discountElement.innerHTML = `${discountFormat}`
}
</script>
