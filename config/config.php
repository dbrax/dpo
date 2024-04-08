<?php


return [

    "endpoint" => env("DPO_ENDPOINT", "https://secure.3gdirectpay.com/API/v6/"),

    "payment_url" => env("DPO_PAYMENT_URL", "https://secure.3gdirectpay.com/payv3.php?ID="),

    "company_token" => env("DPO_COMPANY_TOKEN"),

    "redirect_url" => env("DPO_REDIRECT_URL"),

    "back_url" => env("DPO_BACK_URL"),
];
