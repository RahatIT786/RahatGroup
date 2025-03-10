<?php 
// App/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use App\Services\AtomPaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    //this written by abusin 
    protected $paymentService;

    public function __construct(AtomPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // Payment request handler (step 1)
    public function requestPayment(Request $request)
    {
        $amount = $request->amount;
        $user_email = $request->user_email;
        $user_contact_number = $request->user_contact_number;
        $return_url = route('payment.response');  // URL where response will be sent
        $request_id = uniqid(); // Unique request ID

        // Step 1: Create payment data
        $paymentData = $this->paymentService->createPayData($amount, $user_email, $user_contact_number, $return_url, $request_id);
        
        // Step 2: Generate Atom Token ID
        try {
            $atomTokenId = $this->paymentService->createTokenId($paymentData);
            return redirect()->to("https://secure.atomtech.in/payment/$atomTokenId"); // Redirect to Atom's payment page
        } catch (\Exception $e) {
            return back()->with('error', 'Error generating payment token.');
        }
    }

    // Payment response handler (step 2)
    public function paymentResponse(Request $request)
    {
        // Get the raw response from Atom
        $rawResponse = file_get_contents("php://input");

        // Check if there is no response
        if (empty($rawResponse)) {
            return response()->json(['message' => 'No response received from Atom.']);
        }

        // Parse the response
        $parsedResponse = $this->paymentService->parseResponse($rawResponse);
        
        // Handle the parsed response
        if ($parsedResponse['status'] == 'success') {
            return response()->json(['message' => 'Payment Successful', 'data' => $parsedResponse]);
        } else {
            return response()->json(['message' => 'Payment Failed', 'data' => $parsedResponse]);
        }
    }
}
