<?php

use PHPMailer\PHPMailer\PHPMailer;

function mailContact($objet,$emailTo,$titre,$message,$by,$mdp="gznhvunfpjlxyewd"){

    require_once('./Modules/Php-Mailer/src/PhpMailer.php');
    require_once('./Modules/Php-Mailer/src/Exception.php');
    require_once('./Modules/Php-Mailer/src/SMTP.php');

    $emailErr = "";

    if (!filter_var($emailTo, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 0;
    }
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Username = $by; 
    $mail->Password = $mdp; 
    $mail->SMTPDebug = 0;
    $mail->setFrom($by, $objet); 
    $mail->AddAddress($emailTo);
    $mail->IsHTML(true);
    $mail->Subject = $titre;
    $mail->Body = $message;
    $mail->CharSet = "UTF-8";

    if ($emailErr==0 || !$mail->Send()) { 
        $_SESSION['succes'] = "Veuillez saisir une adresse email valide !";  
    } else {
        $_SESSION['succes'] = "Le message a bien été envoyé !";
    }

    $mail->SmtpClose();

    unset($mail);
}

function mailFormContact($objet,$emailTo,$titre,$message)
{
    mailContact($objet,$emailTo,$titre,$message,"trokos.contact@gmail.com","gznhvunfpjlxyewd");
}


?>