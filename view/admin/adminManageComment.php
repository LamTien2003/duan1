<?php
    include_once('./model/comment.classes.php');
    $Comment = new Comment();
    if(isset($_GET['delete_comment']) && $_GET['delete_comment']) {
        $id_comment = $_GET['delete_comment'];
        $Comment->deleteComment($id_comment);
    }
    if(isset($_GET['accept_comment']) && $_GET['accept_comment']) {
        $id_comment = $_GET['accept_comment'];
        $Comment->acceptComment($id_comment);
    }
?>

<table>
    <thead>
        <tr>
            <td>ID Comment</td>
            <td>User</td>
            <td>ID Sản phẩm</td>
            <td>Comment</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $commentList = $Comment->getCommments();
            foreach($commentList as $row_comment) {
        ?>
        <tr>
            <td><?php echo $row_comment['id_comment'] ?></td>
            <td><?php echo $row_comment['id_user'] ?></td>
            <td><?php echo $row_comment['id_product'] ?></td>
            <td><?php echo $row_comment['comment_content'] ?></td>
            <td>
                <?php 
                    if($row_comment['accept'] == 0) {
                        echo '<a href="?quanly=admin&action=manageComment&accept_comment='.$row_comment['id_comment'].'" 
                        class="status pending">Phê duyệt</a>';
                    }
                ?>
                <a href="?quanly=admin&action=manageComment&delete_comment=<?php echo $row_comment['id_comment'] ?>"
                    class="status return">Xóa</a>
            </td>
        </tr>

        <?php }?>
    </tbody>
</table>