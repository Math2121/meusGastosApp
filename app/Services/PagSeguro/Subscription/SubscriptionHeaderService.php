<?php

namespace App\Services\PagSeguro\Subscription;

use App\Services\PagSeguro\Credentials;

use Illuminate\Support\Facades\Http;

class SubscriptionHeaderService
{
    public function getSubscriptionByCode(string $subscriptionCode)
    {
        $url = Credentials::getCredentials("/pre-approvals/" . $subscriptionCode);

        return $this->subscripitonReader($url);
    }
    public function getSubscriptionByNotificationCode(string $notificationCode)
    {
        $url = Credentials::getCredentials('/pre-approvals/notifications/' . $notificationCode);

        return $this->subscripitonReader($url);
    }

    private function subscripitonReader($url)
    {
        $response = Http::withHeaders(
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
            ]
        )->get($url);

        return $response->json();
    }
}
