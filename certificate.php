<?php
$font = __DIR__.'/font.ttf'; 
header('Content-type: image/png'); 
$certificate = 'Сертификат';
$count = $_POST['count'];
$username = $_POST['username'];
$im = imagecreatefrompng('certificate/certificate.png');
$color1 = imagecolorallocate($im, 135, 161, 194);
$color2 = imagecolorallocate($im, 255, 128, 0);
imagettftext ($im, 50, 0, 200, 200, $color1, $font, $certificate);
imagettftext ($im, 40, 0, 100, 300, $color2, $font,  " получает $username");
imagettftext ($im, 30, 0, 50, 370, $color1, $font, " за правильный ответ на: $count вопроса");
imagepng($im);
imagedestroy($im);

