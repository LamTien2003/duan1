<?php
include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/OAuth.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($id_user,$gmail,$fullName) {
    $mail = new PHPMailer(true);
    $message = '<html>
    <body style="text-align: center;">
            <div class="header_banner" style="background: url(https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-banner-pic/b61ed4ead2296f2695da4d16d4369a9a.png) center center/ cover no-repeat;height: 230px;"></div>
            <div class="header_title" style="padding: 32px 0;background-color: #990000;">
                <h2 style="color: #FFEE63;margin: 0;">Hi '.$fullName.'</h3>
                <h4 style="color: #D4D925;margin: 0;">Bạn có một đơn hàng vừa thanh toán</h4>
            </div>
            <div class="order" style="margin: 20px 0;border-radius: 10px;background-color: white;font-size:18px;">
                <div class="user" style="
            padding: 10px 0;
            width: 80%;
            margin: auto;
            border-bottom: 2px solid #ccc;">
                    <div class="user-info" style="color: #ee4d2d;font-weight: bold;">
                        <p class="address">Địa chỉ: 724/9 Nguyễn Duy</p>
                        <p class="phone">Số điện thoại: 0931314613</p>
                    </div>
                    <p class="status" style="color: #26aa99;font-weight: 600;">Đang giao</p>
                </div>

                <table style="width: 100%;margin: 24px 0 0 0;padding: 10px;background-color: #e7e5e5;border-collapse: collapse;">
                    <tbody style="text-align: center;">
                        
    ';
    // loop cart session
    $total = 0;
    $array = $_SESSION['cart'];
    foreach($array as $item) {
        if($item['user'] == $id_user) {
            foreach($item['product'] as $childItem) {
                $total += $childItem['price'];
                $message .= '
            <tr style="width: 100%;border-bottom: solid 2px #bbb;">
                <td style="width: 40%;">
                    <img
                    src="https://product.hstatic.net/200000195489/product/green_wave_tee_den_truo71c_54625c33666345c0af4d5d5c44636dbb_master.jpg" 
                    alt="" style="max-width: 150px;">
                </td>
                <td style="width: 60%;">
                    <h4 class="product-details_title" style="font-size: 20px;color: black;">'.$childItem['title'].'</h4>
                    <div class="product-details-divide">
                        <p class="product-details_subtitle" style="color: #807c7c;font-size: 14px;">Phân loại hàng: '.$childItem['size'].'</p>
                        <p class="product-details_count" style="color: #807c7c;font-size: 14px;">Số lượng: '.$childItem['soluong'].'</p>
                    </div>
                    <div class="price" style="color: #807c7c;font-size: 14px;">
                        Giá: '.number_format($childItem['price'], 0, '', ',').' đ
                    </div>
                </td>
            </tr>';
            }
        }
    }
    
    $message .= '
    </tbody>
    </table>
    <div class="total" style="padding: 16px 0;background-color: #f2ecdc;">
<p style="color: #ee4d2d;
font-weight: bold;
font-size: 24px;">Tổng tiền:  '.number_format($total, 0, '', ',').'đ</p>
</div>
</div>
</div>
</body>

</html>'; 
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'abctien2003@gmail.com';                 // SMTP username
        $mail->Password = 'opqqnnnczndqwnpl';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
     
        //Recipients
        $mail->setFrom('abctien2003@gmail.com', 'LTShoes');
        $mail->addAddress($gmail, $fullName);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
     
        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Bạn có một đơn hàng mới từ LTShoes';
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}


function sendRequestCode($userName,$gmail,$randomCode) {
    $mail = new PHPMailer(true);
    $message = '
    <html>
        <body style="text-align: center;">
            <h4 style="color: #1a1a17;margin: 0;font-size: 28px;">Mã xác nhận của bạn là :</h4>
            <h2 style="color: #d03c3c;margin: 0;font-size: 38px;">'.$randomCode.'</h3>
        </body>
    </html>                        
    ';
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = false;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'abctien2003@gmail.com';                 // SMTP username
        $mail->Password = 'opqqnnnczndqwnpl';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
     
        //Recipients
        $mail->setFrom('abctien2003@gmail.com', 'Fuho');
        $mail->addAddress($gmail, $userName);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
     
        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Bạn có một mã xác nhận từ Fuho';
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     
        $mail->send();
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}