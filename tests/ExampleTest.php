<?php

use Illuminate\Support\Facades\Http;

it('can generate payment url', function () {
    Http::fake([
        'https://api.edfapay.com/payment/initiate' => Http::response(['redirect_url' => 'https://pay.edfapay.com/merchant/checkout/a001/xxxx'], 200),
    ]);

    $response = \alalm3i\EdfaPay\Facades\EdfaPay::paymentURL([
        'order_id' => 'a001',
        'order_amount' => '10',
        'order_description' => 'description',
        'payer_first_name' => 'customer',
        'payer_last_name' => 'name',
        'payer_email' => 'nab@eee.com',
        'payer_mobile' => '966565555555',
        'payer_ip_address' => '176.44.76.222',
    ])->generate();

    expect($response)->toBeUrl();

});
