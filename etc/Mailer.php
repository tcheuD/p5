<?php

namespace Core;


class Mailer
{
    public function sendMail(Mail $mail)
    {
        mail($mail->getTo(),$mail->getSubject(),$mail->getMessage(), $mail->getHeaders());
    }
}
