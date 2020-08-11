<?php
// Include the qrlib file 
include 'phpqrcode/qrlib.php';
$QR = $_GET["QR"];
QRcode::png($QR);
?>