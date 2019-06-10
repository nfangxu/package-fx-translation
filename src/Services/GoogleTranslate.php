<?php

namespace Fx\Translation\Services;

use Fx\Translation\Contacts\Translate;
use Stichoza\GoogleTranslate\GoogleTranslate as Google;

class GoogleTranslate implements Translate
{
    protected $client;

    public function __construct()
    {
        $client = new Google;

        if ($url = config('fx-translation.providers.google.url')) {
            $client->setUrl($url);
        }

        $this->client = $client;
    }

    public function trans(string $title, string $toLang = 'en', string $fromLang = 'auto'): string
    {
        if ($fromLang !== 'auto') {
            $this->client->setSource($fromLang);
        }

        return $this->client
            ->setTarget($toLang)
            ->translate($title);
    }
}
