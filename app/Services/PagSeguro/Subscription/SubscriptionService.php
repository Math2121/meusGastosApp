<?php


namespace App\Services\PagSeguro\Subscription;

use Illuminate\Support\Facades\Http;

class SubscriptionService
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function makeSubscription()
    {
        $email = config('pagseguro.email');
        $token = config('pagseguro.token');

        $url = "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals?email={$email}&token={$token}";

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
        ])
            ->post($url, [
                'plan' => $this->data['plan_reference'],
                'sender' => [
                    'name' => 'Teste Usuário Sender',
                    'email' => 'teste@sandbox.pagseguro.com.br',
                    'hash' => $this->data['senderHash'],
                    'phone' => [
                        'areaCode' => '98',
                        'number'   => '984283432'
                    ],
                    'address' => [
                        'street' => 'Rua Teste',
                        'number' => '29',
                        'complement' => '',
                        'district' => 'São Bernado',
                        'city' => 'São Luis',
                        'state' => 'MA',
                        'country' => 'BRA',
                        'postalCode' => '65056000'
                    ],
                    'documents' => [
                        [
                            'type' => 'CPF',
                            'value' => '49659822154'
                        ]
                    ]
                ],
                'paymentMethod' => [
                    'type' => 'CREDITCARD',
                    'creditCard' => [
                        'token' => $this->data['token'],
                        'holder' => [
                            'name' => 'Customer Credit Name',
                            'birthDate' => '30/10/1990',
                            'documents' => [
                                [
                                    'type' => 'CPF',
                                    'value' => '49659822154'
                                ]
                            ],
                            'billingAddress' => [
                                'street' => 'Rua Teste',
                                'number' => '29',
                                'complement' => '',
                                'district' => 'São Bernado',
                                'city' => 'São Luis',
                                'state' => 'MA',
                                'country' => 'BRA',
                                'postalCode' => '65056000'
                            ],
                            'phone' => [
                                'areaCode' => '98',
                                'number'   => '984283432'
                            ]
                        ]

                    ]
                ]
            ]);

        $response = (new SubscriptionHeaderService())->getSubscriptionByCode($response->json()['code']) ;

        return $response;
    }
}
