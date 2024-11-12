<?php

require 'app/smtp/PHPMailerAutoload.php';


function sendEmail($name, $email, $subject, $message)
{
    $html = "<table>
                <tr><td>Name</td><td>$name</td></tr>
                <tr><td>Email</td><td>$email</td></tr>
                <tr><td>Subject</td><td>$subject</td></tr>
                <tr><td>Message</td><td>$message</td></tr>
             </table>";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = "nithinawate@gmail.com";
    $mail->Password = "eamy egry fkwk uhyb";
    $mail->setFrom("nithinawate@gmail.com");
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "New Contact Us Message";
    $mail->Body = $html;

    try {
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}

