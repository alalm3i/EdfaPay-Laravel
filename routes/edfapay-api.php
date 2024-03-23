<?php

use Illuminate\Support\Facades\Route;

Route::post('/edfapay/notification', function (Illuminate\Http\Request $requests) {
    (new \alalm3i\EdfaPay\EdfaPayNotifications($requests->getContent()));
});
