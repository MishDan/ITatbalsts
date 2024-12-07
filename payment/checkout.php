<?php
    require_once '../../../stripe-php-master/init.php';
    require_once 'config.php';
    $checkout_session = \Stripe\Checkout\Session::create(
        [
            "mode" => "payment", //payment or setup
            "success_url" => "https://kristovskis.lv/3pt2/miscuks/ITatbalstsMis1321/payment/success.php?session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "https://kristovskis.lv/3pt2/miscuks/ITatbalstsMis1321/",
            "locale" => "lv", //auto, lv, en, lt, ru
            "line_items" => [
                [   "quantity" => 1,
                    "price_data"=> [
                        "currency" => "eur",
                        "unit_amount" => 9999,
                        "product_data" => [
                            "name" => "PRO plāns (uz 1 gadu)",
                        ]
                    ]
                ],
            //     [   "quantity" => 1,
            //     "price_data"=> [
            //         "currency" => "eur",
            //         "unit_amount" => 9999,
            //         "product_data" => [
            //             "name" => "PRO plāns (uz 1 gadu)",
            //         ]
            //     ]
            // ],

            ]
        ]
    );
    header("Location: ".$checkout_session->url);
?>