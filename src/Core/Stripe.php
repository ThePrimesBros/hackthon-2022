<?php

namespace App\Core;
\Stripe\Stripe::setApiKey('sk_test_51IFzQuDbXH72IO01bZTEq8SKwzNiS4xEBcIIw8VNmaluFoeG9zlwBHSgOYHTczXY4hnsQJQm2BBCrlCgJxQfBHUp00yBdsnmgW');


class Stripe {

    public function create($raport){

        header('Content-Type: application/json');
        $YOUR_DOMAIN = 'http://localhost';


        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => 'raport32145474',
                    ],
                    'unit_amount' => $raport->getPrice()*100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }



}