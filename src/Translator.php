<?php

class Translator {
    private $api;
    private $languages;

    public function __construct() {
        // Using MyMemory Translation API - free and no API key required for basic usage
        $apiKey = "";  // Optional: You can add your email as key for higher limits
        $endpoint = "https://api.mymemory.translated.net/get";
        
        $this->api = new TranslationAPI($apiKey, $endpoint);
        $this->languages = new Language();
    }

    public function translate($text, $fromLanguage, $toLanguage) {
        return $this->api->translate($text, $fromLanguage, $toLanguage);
    }
    
    public function getAvailableLanguages() {
        return $this->languages->getAll();
    }
}