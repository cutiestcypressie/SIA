<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        // Debug: Log initial call
        error_log("=== Starting API Request ===");
        error_log("Method: " . $method);
        error_log("Base URI: " . $this->baseUri);
        error_log("Request URL: " . $requestUrl);
        error_log("Form Params: " . json_encode($formParams));
        error_log("Initial Headers: " . json_encode($headers));

        $client = new Client([
            'base_uri' => $this->baseUri,
            'http_errors' => false  // Don't throw exceptions for 4xx/5xx
        ]);

        $options = [];
        
        // For PUT/POST/PATCH requests
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            // Try both form_params and json
            if (empty($headers['Content-Type']) || $headers['Content-Type'] === 'application/x-www-form-urlencoded') {
                $options['form_params'] = $formParams;
                $headers['Content-Type'] = 'application/x-www-form-urlencoded';
                error_log("Using form-urlencoded data");
            } else {
                $options['json'] = $formParams;
                error_log("Using JSON data");
            }
        }
        
        $options['headers'] = $headers;
        error_log("Final request options: " . json_encode($options));

        try {
            error_log("Sending request to: " . $this->baseUri . $requestUrl);
            $response = $client->request($method, $requestUrl, $options);
            
            error_log("Response Status: " . $response->getStatusCode());
            error_log("Response Headers: " . json_encode($response->getHeaders()));
            
            $contents = $response->getBody()->getContents();
            error_log("Raw Response Body: " . $contents);
            
            if ($response->getStatusCode() >= 400) {
                error_log("Error Response: " . $contents);
                return $contents;
            }
            
            // Try to decode JSON
            $decoded = json_decode($contents, true);
            if ($decoded !== null) {
                error_log("Successfully decoded JSON response: " . json_encode($decoded));
                return $decoded;
            } else {
                error_log("Failed to decode JSON. JSON error: " . json_last_error_msg());
                return $contents;
            }
        } catch (\Exception $e) {
            error_log("=== Error in API Request ===");
            error_log("Error message: " . $e->getMessage());
            error_log("Error trace: " . $e->getTraceAsString());
            error_log("=== End Error ===");
            return $e->getMessage();
        }
    }
}