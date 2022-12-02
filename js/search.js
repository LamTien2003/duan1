
$(document).ready(() => {
    $('#search-product').keyup(()=> {    
        fetchAjax('searchProduct')
    })
    $('#search-user').keyup(()=> {    
        fetchAjax('searchUser')
    })
    $('#search-category').keyup(()=> {    
        fetchAjax('searchCategory')
    })
    $('#search-bill').keyup(()=> {    
        fetchAjax('searchBill')
    })
    // $('#search-product-homepage').keyup(()=> {    
    //     fetchAjax('searchProductHomepage')
    // })
})

function fetchAjax(searchType) {
    const limit = 5;
    const page = $('input[name="nav"]:checked').val() || 1;
    const input = $('input[name="search"]').val();
    
    $.ajax({
        url:"ajax/search.php",
        method: "POST",
        data: {
            [searchType]: input,
            page:page,
            limit: limit,
        },
        success: function (data) {
            const newData = JSON.parse(data);
            const list = newData.data;
            const pagination = newData.pagination;
            let html;
            if(list.length) {
                switch(searchType) {
                    case 'searchProduct': {
                        html+= renderProduct(list)
                        break;
                    }
                    case 'searchUser': {
                        html+= renderUser(list)
                        break;
                    }
                    case 'searchCategory': {
                        html+= renderCategory(list)
                        break;
                    }
                    case 'searchBill': {
                        html+= renderBill(list)
                        break;
                    }
                }
            }else {
                html = '<tr><td>Không tìm thấy kết quả phù hợp</td></tr>'
            }
            

            let htmlPagination = "";
            for(let i = 0; i < pagination; i++) {
                htmlPagination+= `<div class="item">
                <input
                    value="${i + 1}" 
                    onchange="fetchAjax('${searchType}')"
                    type="radio" 
                    name="nav" 
                    id="input-${i + 1}" 
                    class="input-page" ${page == i +1 && "checked"}
                />
                <label for="input-${i + 1}" class="button button-${i + 1}"> ${i + 1}</label>
            </div>`
            }
           
            $('#result').html(html);
            $('.pagination').html(htmlPagination);
        },
    })
}
function fetchAjaxHomePage() {
    const limit = 6;
    const page = $('input[name="nav"]:checked').val() || 1;
    const search = $('input[name="search"]').val();
    const range = $('input[name="range"]').val();
    let category = ['1']
    let size = ['1']
    $("input:checkbox[name='category']:checked").each(function(){
        category.push($(this).val());
    });
    $("input:checkbox[name='size']:checked").each(function(){
        size.push($(this).val());
    });

    const value = {
        search,
        page,
        limit,
        range,
        'category': category,
        'size': size,
    }
    $.ajax({
        url:"ajax/search.php",
        method: "POST",
        data: {
            searchHomePage: value,
        },
        success: function (data) {
            const newData = JSON.parse(data);
            const list = newData.data;
            const pagination = newData.pagination;
            let html ='';
            if(list.length) {
                html += renderProductHomePage(list)
            }else {
                html += `<h4>Không có sản phẩm phù hợp </h4>`
            }
            let htmlPagination = "";
            for(let i = 0; i < pagination; i++) {
                htmlPagination+= `<div class="item">
                <input
                    value="${i + 1}" 
                    onchange="fetchAjaxHomePage()"
                    type="radio" 
                    name="nav" 
                    id="input-${i + 1}" 
                    class="input-page" ${page == i +1 && "checked"}
                />
                <label for="input-${i + 1}" class="button button-${i + 1}"> ${i + 1}</label>
            </div>`
            }
            $('#result').html(html);
            $('.pagination').html(htmlPagination)
            console.log(newData)
        },
    })
}

function renderProduct (list) {
    let html = list.map((item) => {
        return `<tr>
                    <td> ${item.id_product} </td>
                    <td style="width: 10%;">
                        <img src=" ${item.img_product} " width="100%" height="120" style="object-fit:cover;">
                    </td>
                    <td> ${item.title_product} </td>
                    <td> ${item.hot_product} </td>
                    <td> ${item.id_category} </td>
                    <td>
                        <a href="?quanly=admin&action=detailProduct&id_sanpham=${item.id_product} " class="status delivered">Xem chi tiết</a>
                        <a href="?quanly=admin&action=changeProduct&id_sanpham=${item.id_product} " class="status pending">Sửa</a>
                        <a href="?quanly=admin&action=manageProduct&delete_sanpham=${item.id_product} " class="status return">Xóa</a>
                    </td>
                </tr>`
    }).join('')
    
    return html;
}
function renderUser (list) {
    return list.map((item) => {
        return `<tr>
                    <td>${item.id_user}</td>
                    <td>${item.user_name}</td>
                    <td>${item.user_phone}</td>
                    <td>${item.user_address}</td>
                    <td>${item.user_email}</td>
                    <td>${item.accountName_user}</td>
                    <td>${item.user_password}</td>
                    <td>${item.user_role}</td>
                    <td>${item.point_available}</td>
                    <td>
                        <a href="?quanly=admin&action=changeUser&id_user=${item.id_user}"
                            class="status pending">Sửa</a>
                        <a href="?quanly=admin&action=manageUser&delete_user=${item.id_user}"
                            class="status return">Xóa</a>
                    </td>
                </tr>`
    }).join('')
}
function renderCategory (list) {
    return list.map((item) => {
        return `<tr>
                    <td>${item.id_category}</td>
                    <td style="width: 10%;">
                        <img src="${item.img_category}" width="100%" height="120" style="object-fit:cover;">
                    </td>
                    <td>${item.name_category}</td>
                    <td>${item.order} </td>
                    <td>${item.parent_id} </td>
                    <td>
                        <a href="?quanly=admin&action=changeCategory&id_danhmuc=${item.id_category}" class="status pending">Sửa</a>
                        <a href="?quanly=admin&action=manageCategory&delete_danhmuc=${item.id_category}" class="status return">Xóa</a>
                    </td>
                </tr>`
    }).join('')
}
function renderBill (list) {
    return list.map((item) => {
        let status;
        let link = '';
        if(item.status == 0) {
            status = "Chờ xác nhận";
            link = `<a href='?quanly=admin&action=manageCart&updateStatus=${item.id_bill}'class='status inProgress'>Duyệt</a>`
        }else if(item.status == 1) {
            status = "Đang giao";
        }else {
            status = "Đã giao";
        }
        return `<tr>
                    <td>${item.id_bill}</td>
                    <td>${item.id_user}</td>
                    <td>${item.delivery_address}</td>
                    <td>${item.receiver_phone}</td>
                    <td>${item.receiver_name}</td>
                    <td>${item.payment_method}</td>
                    <td>${item.point_used}</td>
                    <td>${item.total_pay}</td>
                    <td>${status}</td>
                    <td>
                        <a href="?quanly=admin&action=detailCart&id_giohang=${item.id_bill}" class="status delivered">Xem chi tiết</a>
                        ${link ? link: ''} 
                        <a href="?quanly=admin&action=changeCart&id_giohang=${item.id_bill}" class="status pending">Sửa</a>
                        <a href="?quanly=admin&action=manageCart&delete_giohang=${item.id_bill}" class="status return">Xóa</a>
                    </td>
                </tr>`
    }).join('')
}

function renderProductHomePage(list) {
    return list.map(item => {
       return `<a href="index.php?quanly=chitiet&id=${item.id_product}" class="product-item">
            <img src="${item.img_product}" alt="">
            <div class="product-info">
                <p class="product-name">${item.title_product}</p>
                <p class="product-price">${nf.format(item.detail_price)} đ</p>
                <button class="btn-addtocart">
                    Mua Ngay
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </div>
        </a>`
    }).join('')
}