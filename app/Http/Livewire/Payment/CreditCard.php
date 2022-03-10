<?php

namespace App\Http\Livewire\Payment;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreditCard extends Component
{
    public string $sessionId;
    protected $listeners = [
        'paymentData' => 'processSubscription'
    ];
    public function mount(): void
    {
        $email = config('pagseguro.email');
        $token = config('pagseguro.token');
        $url =  "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email={$email}&token={$token}";
        $response = Http::post($url);
        $response = simplexml_load_string($response->body());

        $this->sessionId = $response->id;
    }
    public function processSubscription($data)
    {
        dd($data);
    }
    public function render()
    {
        return view('livewire.payment.credit-card')->layout('layouts.front');
    }
}
