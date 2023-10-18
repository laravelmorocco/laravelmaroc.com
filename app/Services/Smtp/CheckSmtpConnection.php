<?php

namespace App\Services\Smtp;

use Illuminate\Support\Facades\Http;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class CheckSmtpConnection
{
    public static function isConnected(): bool
    {

        /*if (!self::check(config('mail.mailers.smtp.host'))) {
            return false;
        }*/

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

    private static function check($domainUrl): bool
    {
        try {
            $response = Http::timeout(3)->get($domainUrl);

            return $response->successful();
        } catch (\Illuminate\Http\Client\ConnectionException $e) {

            return false;
        }
    }
}
