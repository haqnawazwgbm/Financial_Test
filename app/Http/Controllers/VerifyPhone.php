<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Phone;
use App\Response;

use Illuminate\Http\Request;

class VerifyPhone extends Controller
{
    public function store(Request $request) {

    	// Validate input fields
    	$validatedData = $this->validate($request, [
	        'phone_number' => 'required|min:5',
	        'random_code' => 'required|numeric',
	        'text' => 'required'
	    ]);
	

    	// Store values into database
    	$phone = new Phone;
        $phone->phone_number = $request->phone_number;
        $phone->random_code = $request->random_code;
        $phone->text = $request->text;
        $phone->save();

    	$reqParamArray = array();
    	$reqParamArray['phone_number'] = $request->input('phone_number');
    	$reqParamArray['random_code'] = $request->input('random_code');;
    	$reqParamArray['text'] = $request->input('text');;
    	
    	$params["phone"] = $reqParamArray;
    	$params["reference"] = "173753$phone->id";
    	$params["country"] = "GB";
    	$params["email"] = "johndoe@example.com";
    	$params["callback_url"] = "http://localhost:8000";
    	$params["verification_mode"] = "any";

    	$data = json_encode($params);

    	// Set header and authentication.
    	$client = new Client([
		    'headers' => ['Content-Type' => 'application/json'],
		    'auth' => ['rQztGlVEp9XsqHxmUWRKhsHX6DpgDMxEZRvR8e7SWRHjKFaxGO1545835069', '$2y$10$F1ZAbn0Q/43/8l6SFF6WWek3c/GQ1jGt1/YBhCdLWmAcY6GlXAOT6']
		]);


		$response = $client->post('https://shuftipro.com/api/', 
		        ['body' => $data]
		);
		$response = json_decode($response->getBody());

		// Store api response into database
		$response_tbl = new Response;
        $response_tbl->reference = $response->reference;
        $response_tbl->event = $response->event;
        $response_tbl->verification_url = $response->verification_url;
        $response_tbl->email = $response->email;
        $response_tbl->country = $response->country;
        $response_tbl->save();

		$url = $response->verification_url;

		return view('phone_response', ['verification_url' => $url]);

    	
    }
}
