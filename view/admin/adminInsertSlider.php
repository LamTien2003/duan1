<?php
  include_once('./model/slider.classes.php');
  $Slider = new Slider();

    if(isset($_POST["submit_insertSlider"]) && $_POST["submit_insertSlider"]) {
        if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_FILES) && $_FILES)
        && (isset($_POST["subname"]) && $_POST["subname"]) && (isset($_POST["order"]) && $_POST["order"])
        && (isset($_POST["link"]) && $_POST["link"]) ) {
            $title = $_POST["fullname"];
            $image = $_FILES['image'];
            $subTitle  = $_POST["subname"];
            $order  = $_POST["order"];
            $link = $_POST['link'];
            // UPDATE VALUE
            $Slider->insertSlider($image,$link,$title,$subTitle,$order);
            
        }
    }
?>

<div class="form">
    <form action="" method="POST" class="form container" id="form-1" enctype="multipart/form-data">
        <h3 class="heading">Thông tin Slider</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Title Slider</label>
            <input id="fullname" name="fullname" type="text" placeholder="Title của Slider" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="subname" class="form-label">SubTitle</label>
            <input id="subname" name="subname" type="text" placeholder="Subtitle của Slider" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="link" class="form-label">Đường dẫn</label>
            <input id="link" name="link" type="text" placeholder="Đường dẫn của Slider" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>


        <div class="form-group">
            <label for="image" class="form-label">Image:</label>
            <input id="image" name="image" type="file" placeholder="./assets/image/..." class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="order" class="form-label">Vị trí ưu tiên</label>
            <input id="order" name="order" type="text" placeholder="1,2,.." class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <input class="form-submit" type="submit" value="Lưu" name="submit_insertSlider"></input>
    </form>

</div>
