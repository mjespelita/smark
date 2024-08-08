<?php

namespace Smark\Smark;

use GuzzleHttp\Client;

class Payment
{
    public static function paymongoCreatePaymentLink($paymentDetails)
    {

        /**
         *  let data = {
         *       "data":{
         *           "attributes": {
         *               "amount":10000,
         *               "description":"Sample Course",
         *               "remarks":"Your Paragraph text goes Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolore, alias, numquam enim ab voluptate id quam harum ducimus cupiditate similique quisquam et deserunt, recusandae. here"
         *           }
         *       }
         *   };
         *
         *   Api Link: https://api.mydomain.com/
         */

        $data = $paymentDetails;
        $client = new Client();

        // Check if 'amount' is numeric and convert to integer if it is
        if (isset($data['attributes']['amount']) && is_numeric($data['attributes']['amount'])) {
            $data['attributes']['amount'] = (int) $data['attributes']['amount'];
        }

        // Convert the data structure to a JSON string
        $jsonString = json_encode(["data" => $data], JSON_PRETTY_PRINT);

        $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
            'body' => $jsonString,
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Basic c2tfbGl2ZV9EM2JMblZMVXlFQ01Wc0pHUWVrc2VGWjE6',
                'content-type' => 'application/json',
            ],
        ]);

        return $response->getBody();
    }
}
