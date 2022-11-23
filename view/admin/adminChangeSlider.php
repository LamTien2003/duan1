<?php
  include_once('./model/slider.classes.php');
  $Slider = new Slider();
    if(isset($_GET['id_slider']) && $_GET['id_slider']) {
        $id_slider = $_GET['id_slider'];
    }
    if(isset($_POST["submit_changeSlider"]) && $_POST["submit_changeSlider"] ) {
        if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_FILES) && $_FILES)
        && (isset($_POST["subname"]) && $_POST["subname"]) && (isset($_POST["order"]) && $_POST["order"])
        && (isset($_POST["link"]) && $_POST["link"]) ) {
            $title = $_POST["fullname"];
            $image = $_FILES['image'];
            $subTitle  = $_POST["subname"];
            $order  = $_POST["order"];
            $link = $_POST['link'];
            // UPDATE VALUE
            $Slider->updateSlider($image,$link,$title,$subTitle,$order,$id_slider);
            
        }
    }
?>

<?php
    $Slider = $Slider->getSliderId($id_slider);
    foreach($Slider as $row_Slider) {
?>
<div class="form">
    <form action="" method="POST" class="form container" id="form-1" enctype="multipart/form-data">
        <h3 class="heading">Thông tin Sản phẩm</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Title Slider</label>
            <input id="fullname" name="fullname" type="text" placeholder="VD: Lâm Tiến" class="form-control"
                autocomplete="off" value = "<?php echo $row_Slider['slider_title'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="subname" class="form-label">SubTitle</label>
            <input id="subname" name="subname" type="text" placeholder="Subtitle của sản phẩm" class="form-control"
                autocomplete="off" value = "<?php echo $row_Slider['slider_subtitle'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="link" class="form-label">Đường dẫn</label>
            <input id="link" name="link" type="text" placeholder="Đường dẫn của sản phẩm" class="form-control"
                autocomplete="off" value = "<?php echo $row_Slider['slider_link'] ?>">
            <span class="form-message"></span>
        </div>


        <div class="form-group">
            <label for="image" class="form-label">Image:</label>
            <input id="image" name="image" type="file" placeholder="VD: 0931462697" class="form-control"
                autocomplete="off" value = "<?php echo $row_Slider['slider_img'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="order" class="form-label">Vị trí ưu tiên</label>
            <input id="order" name="order" type="text" placeholder="VD: ltt@gmail.com" class="form-control"
                autocomplete="off" value = "<?php echo $row_Slider['order'] ?>">
            <span class="form-message"></span>
        </div>

        <input class="form-submit" type="submit" value="Lưu" name="submit_changeSlider"></input>
    </form>
<?php } ?>
</div>
