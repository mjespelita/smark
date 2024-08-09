<?php

namespace Smark\Smark;

/**
 * paymongoCreatePaymentLink($paymentDetails)
 */

use GuzzleHttp\Client;

class Payment
{
    public static function paymongoCreatePaymentLink($paymentDetails)
    {

        /**
         *  Example data structure:
         *  let data = {
         *       "data": {
         *           "attributes": {
         *               "amount": 10000,
         *               "description": "Sample Course",
         *               "remarks": "Your Paragraph text goes Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolore, alias, numquam enim ab voluptate id quam harum ducimus cupiditate similique quisquam et deserunt, recusandae. here"
         *           }
         *       }
         *   };
         *
         *   API Endpoint: https://api.mydomain.com/
         */

         $data = $paymentDetails; // Store the payment details in the variable $data
         $client = new Client(); // Create a new HTTP client instance
 
         // Check if 'amount' exists and is numeric, then convert it to an integer
         if (isset($data['attributes']['amount']) && is_numeric($data['attributes']['amount'])) {
             $data['attributes']['amount'] = (int) $data['attributes']['amount']; // Convert amount to integer
         }
 
         // Convert the data array to a JSON string with pretty print format
         $jsonString = json_encode(["data" => $data], JSON_PRETTY_PRINT);
 
         // Send a POST request to the Paymongo API to create a payment link
         $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
             'body' => $jsonString, // Attach the JSON string as the request body
             'headers' => [
                 'accept' => 'application/json', // Indicate that the response should be in JSON format
                 'authorization' => 'Basic c2tfbGl2ZV9EM2JMblZMVXlFQ01Wc0pHUWVrc2VGWjE6', // Authorization header with Base64 encoded credentials
                 'content-type' => 'application/json', // Indicate that the request body is in JSON format
             ],
         ]);
 
         return $response->getBody(); // Return the response body from the API request
     }
}
