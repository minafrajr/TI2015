<?php
/**
 * Class Email
 * @package Data
 */


namespace Data;


class Email
{
    /**
     * Código retirado do link do próprio PhpMailer
     *
     * @link https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail.phps
     *
     * @param string $paraEmail Pra quem vai o e-mail
     * @param string $paraNome Nome da pessoa
     * @param string $assunto o Assunto do e-mail
     * @param string $mensagem A mensagem
     *
     * @return bool
     * @throws \Exception
     * @throws \phpmailerException
     */
    public function enviar($paraEmail, $paraNome, $assunto, $mensagem)
    {
        //Create a new PHPMailer instance
        $mail = new \PHPMailer();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        $mail->isHTML();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "ti2015.pucminas@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "ti2015puc";
        //Set who the message is to be sent from
        $mail->setFrom('ti2015.pucminas@gmail.com', 'AlertSistem');
        //Set who the message is to be sent to
        $mail->addAddress($paraEmail, $paraNome);
        //Set the subject line
        $mail->Subject = $assunto;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->Body = $mensagem;
        //send the message, check for errors
        if (!$mail->send()) {
            throw new \Exception('Erro ao enviar e-mail: ' . $mail->ErrorInfo);
        }

        return true;
    }
}