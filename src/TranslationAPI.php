<?php

class TranslationAPI {
    private $apiKey;
    private $endpoint;

    public function __construct($apiKey, $endpoint) {
        $this->apiKey = $apiKey;
        $this->endpoint = $endpoint;
    }

    public function translate($text, $fromLanguage, $toLanguage) {
        // Using MyMemory Translation API (free)
        $endpoint = "https://api.mymemory.translated.net/get";
        
        // Build the query string for the GET request
        $queryParams = [
            'q' => $text,
            'langpair' => "$fromLanguage|$toLanguage"
        ];
        
        // Add email for increased daily limit (optional)
        // if (!empty($this->apiKey)) {
        //     $queryParams['key'] = $this->apiKey;
        // }
        
        $url = $endpoint . '?' . http_build_query($queryParams);
        
        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For testing only
        
        // Execute cURL session
        $response = curl_exec($ch);
        $error = curl_error($ch);
        
        // Close cURL session
        curl_close($ch);
        
        if ($error) {
            return "Translation Error: " . $error;
        }
        
        // Process the response
        $result = json_decode($response, true);
        
        if (isset($result['responseData']['translatedText'])) {
            return htmlspecialchars_decode($result['responseData']['translatedText']);
        } elseif (isset($result['responseStatus']) && $result['responseStatus'] != 200) {
            return "API Error: Status " . $result['responseStatus'];
        } else {
            return "Unknown Error: " . print_r($result, true);
        }
    }
}