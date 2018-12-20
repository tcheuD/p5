<?php

namespace Core;


class MailFactory
{
    public static function resetPassword($user, $pass)
    {
        $mail = new Mail();
        $mail->setFrom();
        $mail->setTo($user);
        $mail->setSubject('Reinitialisation de votre de votre mot de passe');
        $mail->setMessage('https://p5.damienchedan.fr/login/reset-password/'.$pass);

        return $mail;
    }

    public static function registrationMail($user)
    {
        $mail = new Mail();
        $mail->setFrom();
        $mail->setTo($user);
        $mail->setSubject('Confirmation d\'inscription');
        $mail->setMessage('Votre inscription sur le site p5.damienchedan.fr a bien été effectué');

        return $mail;
    }

    public static function contact($email, $name, $message)
    {
        $mail = new Mail();
        $mail->setFrom($email);
        $mail->setTo('tcheutcheud@gmail.com');
        $mail->setSubject('contact' . $name);
        $mail->setMessage($message);

        return $mail;
    }

}
