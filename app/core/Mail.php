
<?php

require '../smtp/PHPMailerAutoload.php';

class Mail
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
        $this->mail->SMTPSecure = "tls";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "your_email@gmail.com";
        $this->mail->Password = "your_password";
        $this->mail->setFrom("your_email@gmail.com", "Your Name");
        $this->mail->isHTML(true);
        $this->mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            ]
        ];
    }

    public function sendEmail($recipientEmail, $subject, $body)
    {
        $this->mail->addAddress($recipientEmail);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        try {
            return $this->mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
