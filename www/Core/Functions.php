<?php

use PHPMailer\PHPMailer\PHPMailer;

function mailContact($objet,$emailTo,$titre,$message,$by,$mdp="gznhvunfpjlxyewd"){
    require_once('./Modules/Php-Mailer/src/PhpMailer.php');
    require_once('./Modules/Php-Mailer/src/Exception.php');
    require_once('./Modules/Php-Mailer/src/SMTP.php');

    // require_once('PHPMailer-master/src/Exception.php');
    // require_once('PHPMailer-master/src/PHPMailer.php');
    // require_once('PHPMailer-master/src/SMTP.php');
    $emailErr = "";

    //Vérification que l'adresse mail envoyer dans le form est valide
    if (!filter_var($emailTo, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 0;
    }
    //création d'un objet PHPmailer
    $mail = new PHPMailer();
    //on utilise un serveur mail SMTP pour envoyer le mail
    $mail->IsSMTP();
    //on designe l'adresse du serveur smtp
    $mail->Host = 'smtp.gmail.com';
    //le port du conexion du serveur smtp
    $mail->Port = 465;
    //le mode encryption 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    //On a pas de certificat SSL alors il faut que l'on desactive
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //l'authentification au serveur se fait pas smtp
    $mail->SMTPAuth = true;
    //on précise que le smtp dispose d'un ssl
    $mail->SMTPSecure = 'ssl';
    //tes identifiant gmail
    $mail->Username = $by; //votre gmail
    $mail->Password = $mdp; // mdp gmail
    $mail->SMTPDebug = 1;
    //la provenance du mail
    $mail->setFrom($by, $objet); // votre gmail
    //les destinataire du mail (note j'ai ajouter le deuxième destinataire)
    $mail->AddAddress($emailTo);
    //Le corps du mail est ecrit en HTML
    $mail->IsHTML(true);
    //Le sujet du mail 
    $mail->Subject = $titre;
    //le corps du mail 
    $mail->Body = $message;
    //l'encodage des char dans le mail
    $mail->CharSet = "UTF-8";
    // var_dump($emailErr);
    // var_dump($mail);
    // var_dump($by);
    // var_dump($mdp);
    //send doit retourner vrai normalement donc si cela retourne faux on affiche le message d'ereur
    if ($emailErr==0 || !$mail->Send()) { //Teste le return code de la fonction
        $_SESSION['succes'] = "Veuillez saisir une adresse email valide !"; //Affiche le message d'erreur 
    } else {
        $_SESSION['succes'] = "Le message a bien été envoyé !";
    }
    //on ferme le IsSMTP() du tout debut
    $mail->SmtpClose();
    //on detruit lobjet mail (c'est pas obligatoire)
    unset($mail);
}

function mailFormContact($objet,$emailTo,$titre,$message){
    mailContact($objet,$emailTo,$titre,$message,"trokos.contact@gmail.com","gznhvunfpjlxyewd");
}

// function mailNoreplyGeneral($objet,$emailTo,$titre,$message){
//     mailContact($objet,$emailTo,$titre,$message,"no-reply@deffko.com","CFFaL.k;1!rP");
// }

?>