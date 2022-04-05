<?php

namespace App\Http\Livewire\Payment;

use App\Models\User;
use App\Services\PagSeguro\Credentials;
use App\Services\PagSeguro\Subscription\SubscriptionService;
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

        $url =  Credentials::getCredentials("/sessions");
        $response = Http::post($url);
        $response = simplexml_load_string($response->body());

        $this->sessionId = (string) $response->id;
    }
    public function processSubscription(array $data): void
    {
        $data['plan_reference'] = 'DC0FF3D42121A69FF44E2FBD5B8009BE';
        $makeSubscription = (new SubscriptionService($data))->makeSubscription($data);

        $user = User::find(1);
        $user->plan()->create([
            'plan_id' =>'1',
            'status' =>$makeSubscription['status'],
            'date_subscription'=>(\DateTime::createFromFormat(DATE_ATOM,$makeSubscription['date'])->format('Y-m-d H:i:s')),
            'reference_transaction' =>$makeSubscription['code']
        ]);

        session()->flash('message','Plano Aderido com sucesso');
    }
    public function render()
    {
        return view('livewire.payment.credit-card')->layout('layouts.front');
    }
}
