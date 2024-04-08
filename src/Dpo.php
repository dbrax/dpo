<?php

namespace Epmnzava\Dpo;

class Dpo
{

    protected $amount;
    protected $currency;
    protected $reference;
    protected $service_type;
    protected $service_description;
    public function __construct($reference, $amount, $currency, $service_type, $service_description)
    {

        $this->amount = $amount;
        $this->currency = $currency;
        $this->reference = $reference;
        $this->service_type = $service_type;
        $this->service_description = $service_description;
    }

    public function createToken()
    {
        $xmlData = "<?xml version=\"1.0\" encoding=\"utf-8\"?><API3G><CompanyToken>" . config("dpo.company_token") . "</CompanyToken><Request>createToken</Request><Transaction><PaymentAmount>" . $this->amount . "</PaymentAmount><PaymentCurrency>" . $this->currency . "</PaymentCurrency><CompanyRef>" . $this->reference . "</CompanyRef><RedirectURL>" . config("dpo.redirect_url") . "</RedirectURL><BackURL>" . config("dpo.back_url") . " </BackURL><CompanyRefUnique>0</CompanyRefUnique><PTL>5</PTL></Transaction><Services><Service><ServiceType>" . $this->service_type . "</ServiceType><ServiceDescription>" . $this->service_description . "</ServiceDescription><ServiceDate>" . now()->format("Y/m/d H:i") . "</ServiceDate></Service></Services></API3G>";


        $ch = curl_init();

        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }
        curl_setopt($ch, CURLOPT_URL, config("dpo.endpoint"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }
    public function online_checkout()
    {

        $token_response = json_decode(json_encode(simplexml_load_string($this->createToken())), true);

        $token = $token_response["TransToken"];
        return config("dpo.payment_url") . "" . $token;
    }

    public function verify_token()
    {
    }
}
