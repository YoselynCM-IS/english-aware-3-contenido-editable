<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$ea3_regGP = $_POST["ea3_regGP"];
$ea3_regCA = $_POST["ea3_regCA"];
$ea3_regND = $_POST["ea3_regND"];
$ea3_regCD = $_POST["ea3_regCD"];
$ea3_regNA = $_POST["ea3_regNA"];
/*
echo $imagen;
echo "<br>";
echo $ea3_regGP;
echo "<br>";
echo $ea3_regCA;
echo "<br>";
echo $ea3_regND;
echo "<br>";
echo $ea3_regCD;
echo "<br>";
echo $ea3_regNA;
echo "<br>";
//die("fin");
**/
$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>English Aware 3</b><br><b>Student name: </b>'.$ea3_regNA.'<br><b>Group: </b> '.$ea3_regGP.'<br><b>Teacher: </b>'.$ea3_regND;

$para = $ea3_regCD;
$para2 = $ea3_regCA;
$asunto = 'English Aware 3: Activity';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Activity.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail
$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = 'xAp3Rm9=xO+a'; //contraseña

 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Sent correctly");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("Not sent, try again");
        </script>';
}
?>