<?php
    include_once('./model/Slider.classes.php');
    $Slider = new Slider();
    if(isset($_GET['delete_slider']) && $_GET['delete_slider']) {
        $id_slider = $_GET['delete_slider'];
        $Slider->deleteSlider($id_slider);
    }
?>
<div class="btn-insert">
    <a href="?quanly=admin&action=insertSlider" class="btn">Thêm + </a>
</div>
<table>
    <thead>
        <tr>
            <td>ID Slider</td>
            <td>Ảnh</td>
            <td>Đường dẫn</td>
            <td>Title</td>
            <td>Subtitle</td>
            <td>Vị trí ưu tiên</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $sliderList = $Slider->getSliders();
            foreach($sliderList as $row_slider) {
        ?>
        <tr>
            <td><?php echo $row_slider['id_slider'] ?></td>
            <td><?php echo $row_slider['slider_img'] ?></td>
            <td><?php echo $row_slider['slider_link'] ?></td>
            <td><?php echo $row_slider['slider_title'] ?></td>
            <td><?php echo $row_slider['slider_subtitle'] ?></td>
            <td><?php echo $row_slider['order'] ?></td>

            <td>
                <a href="?quanly=admin&action=changeSlider&id_slider=<?php echo $row_slider['id_slider'] ?>" class="status pending">Sửa</a>
                <a href="?quanly=admin&action=manageSlider&delete_slider=<?php echo $row_slider['id_slider'] ?>" class="status return">Xóa</a>
            </td>
        </tr>

        <?php }?>
    </tbody>
</table>