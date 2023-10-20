<?php

namespace App\Services\Smtp;

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class CheckSmtpConnection
{
    public static function isConnected(): bool
    {

        try {
            $transport = new EsmtpTransport(config('mail.mailers.smtp.host'), config('mail.mailers.smtp.port'), config('mail.mailers.smtp.encryption'));
            $transport->setUsername(config('mail.mailers.smtp.username'));
            $transport->setPassword(config('mail.mailers.smtp.password'));
            $transport->start();

            return true;
        } catch (\Exception $e) {
            //return info($e->getMessage(), ['error_smtp']);
            return false;
        }
    }
}
