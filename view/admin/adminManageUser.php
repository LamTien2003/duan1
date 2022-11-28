<?php
    include_once('./model/user.classes.php');
    $User = new User();
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }else {
        $page = 1;
    }
    if(isset($_GET['delete_user']) && $_GET['delete_user']) {
        $id_user = $_GET['delete_user'];
        $User->deleteUser($id_user);
    }
?>
<div class="btn-insert">
    <a href="?quanly=admin&action=insertUser" class="btn">Thêm + </a>
</div>
<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" id="search-user" placeholder="Nhập tên hoặc ID User để tìm kiếm"/>
</div>
<table>
    <thead>
        <tr>
            <td>ID_USER</td>
            <td>Tên</td>
            <td>SĐT</td>
            <td>Địa chỉ</td>
            <td>Gmail</td>
            <td>Tài khoản</td>
            <td>Mật khẩu</td>
            <td>Role</td>
            <td>Điểm thưởng tích lũy</td>
            <td>Tùy chỉnh</td>
        </tr>
    </thead>

    <tbody id="result">
        <?php
            $userPerPage = 5;
            $countUsers = $User->getCountUsers();
            $countPage = ceil($countUsers / $userPerPage);
            $start = ($page -1) * $userPerPage;
            $userList = $User->getUsersLimit($start,$userPerPage);
            foreach($userList as $row_user) {
        ?>
        <tr>
            <td><?php echo $row_user['id_user'] ?></td>
            <td><?php echo $row_user['user_name'] ?></td>
            <td><?php echo $row_user['user_phone'] ?></td>
            <td><?php echo $row_user['user_address'] ?></td>
            <td><?php echo $row_user['user_email'] ?></td>
            <td><?php echo $row_user['accountName_user'] ?></td>
            <td><?php echo $row_user['user_password'] ?></td>
            <td><?php echo $row_user['user_role'] == '1' ? 'Admin' : 'User' ?></td>
            <td><?php echo $row_user['point_available'] ?></td>
            <td>
                <a href="?quanly=admin&action=changeUser&id_user=<?php echo $row_user['id_user'] ?>"
                    class="status pending">Sửa</a>
                <a href="?quanly=admin&action=manageUser&delete_user=<?php echo $row_user['id_user'] ?>"
                    class="status return">Xóa</a>
            </td>
        </tr>

        <?php }?>
    </tbody>
</table>
<div class="pagination">
    <?php
            $i = 1;
            while($i <= $countPage) {
    ?>
            <div class="item">
                <input
                    value="<?php echo $i ?>" 
                    onchange="fetchAjax('searchUser')"
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