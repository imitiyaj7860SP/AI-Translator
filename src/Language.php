<?php

class Language {
    private $languages;
    
    public function __construct() {
        $this->languages = [
            'en' => 'English',
            'es' => 'Spanish',
            'fr' => 'French',
            'de' => 'German',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'ko' => 'Korean',
            'pt' => 'Portuguese',
            'ru' => 'Russian',
            'zh' => 'Chinese'
        ];
    }
    
    public function getAll() {
        return $this->languages;
    }
    
    public function getName($code) {
        return isset($this->languages[$code]) ? $this->languages[$code] : $code;
    }
}