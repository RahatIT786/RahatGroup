<?php

namespace App\Services;

use GuzzleHttp\Client;

class PaymentService
{
    protected $httpClient;
    private $login;
    private $password;
    private $product_id;
    private $encRequestKey;
    private $decResponseKey;
    private $api_url;
    private $is_production;


    public function __construct()
    {
        $this->httpClient = new Client();
        $this->is_production = true; //ON OFF SWITCH


        // Load appropriate configuration based on the environment
        if ($this->is_production) {
            $config = config('gateway.atom_prod');
        } else {
            $config = config('gateway.atom_sandbox');
        }

        $this->login = $config['login'];
        $this->password = $config['password'];
        $this->product_id = $config['product_id'];
        $this->encRequestKey = $config['encRequestKey'];
        $this->decResponseKey = $config['decResponseKey'];
        $this->api_url = $config['api_url'];

    }

    public function createPayData($amount, $user_email, $user_contact_number, $return_url, $request_id)
    {
        $merchTxnId = uniqId();
        $date = date('Y-m-d H:i:s');

        return [
            'login' => $this->login,
            'password' => $this->password,
            'amount' => $amount,
            'prod_id' => $this->product_id,
            'txnId' => $merchTxnId,
            'date' => $date,
            'encKey' => $this->encRequestKey,
            'decKey' => $this->decResponseKey,
            'payUrl' => $this->api_url,
            'email' => $user_email,
            'mobile' => $user_contact_number,
            'txnCurrency' => 'INR',
            'return_url' => $return_url,
            'udf1' => $request_id,
            'udf2' => '',
            'udf3' => '',
            'udf4' => '',
            'udf5' => ''
        ];

    }

    public function createTokenId($data)
    {
        $jsondata = '{
            "payInstrument": {
                "headDetails": {
                    "version": "OTSv1.1",
                    "api": "AUTH",
                    "platform": "FLASH"
                },
                "merchDetails": {
                    "merchId": "' . $data['login'] . '",
                    "userId": "",
                    "password": "' . $data['password'] . '",
                    "merchTxnId": "' . $data['txnId'] . '",
                    "merchTxnDate": "' . $data['date'] . '"
                },
                "payDetails": {
                    "amount": "' . $data['amount'] . '",
                    "product": "' . $data['prod_id'] . '",
                    "custAccNo": "213232323",
                    "txnCurrency": "' . $data['txnCurrency'] . '"
                },
                "custDetails": {
                    "custEmail": "' . $data['email'] . '",
                    "custMobile": "' . $data['mobile'] . '"
                },
                "extras": {
                    "udf1": "' . $data['udf1'] . '",
                    "udf2": "' . $data['udf2'] . '",
                    "udf3": "' . $data['udf3'] . '",
                    "udf4": "' . $data['udf4'] . '",
                    "udf5": "' . $data['udf5'] . '"
                }
            }
        }';

        $encData = $this->encrypt($jsondata, $data['encKey'], $data['encKey']);
        // dd( $encData);
        $response = $this->httpClient->post($data['payUrl'], [
            'form_params' => [
                'encData' => $encData,
                'merchId' => $data['login']
            ],
            'verify' => true,  // This is to ensure SSL verification
        ]);


        // dd('your response is ', $response);
        $atomTokenId = null;
        $responseBody = (string) $response->getBody();
        // dd($responseBody);
        $getresp = explode("&", $responseBody);
        // dd($getresp);
        $encresp = substr($getresp[1], strpos($getresp[1], "=") + 1);
        $decData = $this->decrypt($encresp, $data['decKey'], $data['decKey']);
        // dd( $decData );
        $res = json_decode($decData, true);
        // dd($res);
        if ($res && $res['responseDetails']['txnStatusCode'] == 'OTS0000') {
            $atomTokenId = $res['atomTokenId'];


        } else {
            echo "Error getting data";
        }

        return $atomTokenId;
    }

    public function encrypt($data, $salt, $key)
    {
        $method = "AES-256-CBC";
        $iv = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
        $chars = array_map("chr", $iv);
        $IVbytes = join($chars);
        $salt1 = mb_convert_encoding($salt, "UTF-8");
        $key1 = mb_convert_encoding($key, "UTF-8");
        $hash = openssl_pbkdf2($key1, $salt1, '256', '65536', 'sha512');
        $encrypted = openssl_encrypt($data, $method, $hash, OPENSSL_RAW_DATA, $IVbytes);
        return strtoupper(bin2hex($encrypted));
    }

    public function decrypt($data, $salt, $key)
    {
        $dataEncypted = hex2bin($data);
        $method = "AES-256-CBC";
        $iv = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
        $chars = array_map("chr", $iv);
        $IVbytes = join($chars);
        $salt1 = mb_convert_encoding($salt, "UTF-8");
        $key1 = mb_convert_encoding($key, "UTF-8");
        $hash = openssl_pbkdf2($key1, $salt1, '256', '65536', 'sha512');
        $decrypted = openssl_decrypt($dataEncypted, $method, $hash, OPENSSL_RAW_DATA, $IVbytes);
        return $decrypted;
    }

    public function parseResponse($data)
    {

        $decData = $this->decrypt($data, $this->decResponseKey, $this->decResponseKey);
        $jsonData = json_decode($decData, true);
        // dd($jsonData );

        if ($jsonData['payInstrument']['responseDetails']['statusCode'] == 'OTS0000') {
        // if ($jsonData['payInstrument']['responseDetails']['txnStatusCode'] == 'OTS0000') {
            return [
                'status' => 'success',
                'transaction_id' => $jsonData['payInstrument']['merchDetails']['merchTxnId'],
                'transaction_date' => $jsonData['payInstrument']['merchDetails']['merchTxnDate'],
                'amount' => $jsonData['payInstrument']['payDetails']['amount'],
                'surcharge_amount' => $jsonData['payInstrument']['payDetails']['surchargeAmount'],
                'total_amount' => $jsonData['payInstrument']['payDetails']['totalAmount'],
                'currency' => $jsonData['payInstrument']['payDetails']['txnCurrency'],
                'customer_account_number' => $jsonData['payInstrument']['payDetails']['custAccNo'],
                'client_code' => $jsonData['payInstrument']['payDetails']['clientCode'],
                'transaction_initiation_date' => $jsonData['payInstrument']['payDetails']['txnInitDate'],
                'transaction_completion_date' => $jsonData['payInstrument']['payDetails']['txnCompleteDate'],
                'bank_name' => $jsonData['payInstrument']['payModeSpecificData']['bankDetails']['otsBankName'],
                // 'card_type' => $jsonData['payInstrument']['payModeSpecificData']['bankDetails']['cardType'],
                // 'scheme' => $jsonData['payInstrument']['payModeSpecificData']['bankDetails']['scheme'],
                // 'status_code' => $jsonData['payInstrument']['responseDetails']['statusCode'],
                'response_message' => $jsonData['payInstrument']['responseDetails']['message'],
                'response_description' => $jsonData['payInstrument']['responseDetails']['description'],
                'customer_email' => $jsonData['payInstrument']['custDetails']['custEmail'],
                'customer_mobile' => $jsonData['payInstrument']['custDetails']['custMobile'],
                'request_id' => $jsonData['payInstrument']['extras']['udf1']
            ];
        } else {
            return [
                'status' => 'failed',
                'data' => $jsonData
            ];
        }
    }
}
