<?
// App/Services/AtomPaymentService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class AtomPaymentService
{
    protected $merchantId;
    protected $accessKey;
    protected $paymentUrl;
    protected $decResponseKey;

    public function __construct()
    {
        $this->merchantId = env('ATOM_MERCHANT_ID');
        $this->accessKey = env('ATOM_ACCESS_KEY');
        $this->paymentUrl = env('ATOM_PAYMENT_URL');
        $this->decResponseKey = env('ATOM_DEC_RESPONSE_KEY'); // Decryption key
    }

    public function createPayData($amount, $user_email, $user_contact_number, $return_url, $request_id)
    {
        // Payment data that will be sent to Atom
        return [
            'amount' => $amount,
            'email' => $user_email,
            'contact' => $user_contact_number,
            'return_url' => $return_url,
            'request_id' => $request_id,
            'merchant_id' => $this->merchantId,
            'access_key' => $this->accessKey,
        ];
    }

    public function createTokenId($data)
    {
        // Send request to Atom's API to generate Token ID
        $response = Http::post($this->paymentUrl, $data);
        $tokenData = $response->json();

        if (isset($tokenData['atomTokenId'])) {
            return $tokenData['atomTokenId'];
        }

        throw new \Exception('Error generating Atom Token');
    }

    public function parseResponse($data)
    {
        // Decrypt and parse the response
        $decData = $this->decrypt($data, $this->decResponseKey, $this->decResponseKey);
        $jsonData = json_decode($decData, true);
        
        if ($jsonData['payInstrument']['responseDetails']['txnStatusCode'] == 'OTS0000') {
            return [
                'status' => 'success',
                'transaction_id' => $jsonData['payInstrument']['merchDetails']['merchTxnId'],
                'transaction_date' => $jsonData['payInstrument']['merchDetails']['merchTxnDate'],
                'amount' => $jsonData['payInstrument']['payDetails']['amount'],
                'currency' => $jsonData['payInstrument']['payDetails']['txnCurrency'],
                'response_message' => $jsonData['payInstrument']['responseDetails']['message'],
            ];
        } else {
            return [
                'status' => 'failed',
                'data' => $jsonData
            ];
        }
    }

    private function decrypt($data, $key, $iv)
    {
        // Decryption logic (depending on Atom's encryption method)
          // Decrypt the data using AES-256-CBC
    $decryptedData = openssl_decrypt(
        base64_decode($data), // The data should be base64-encoded
        'AES-256-CBC',         // Encryption algorithm (AES-256-CBC is commonly used)
        $key,                  // The decryption key
        0,                     // Options: 0 means no additional options
        base64_decode($iv)     // Initialization vector (iv), base64 decoded if required
    );
    
    // Check if decryption was successful
    if ($decryptedData === false) {
        throw new \Exception('Decryption failed');
    }
    
    return $decryptedData;
    }
}
