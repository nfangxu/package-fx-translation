<?php

namespace Fx\Translation\Services;

use Fx\Translation\Contacts\Translate;
use GuzzleHttp\Client;

class BingTranslate implements Translate
{
    protected $client;

    protected $url;

    protected $from;

    protected $to;

    protected $text;

    protected $result;

    public function __construct()
    {
        $this->url = config("fx-translation.provider.bing.url", "https://cn.bing.com/ttranslatev3");

        $this->client = new Client;
    }

    public function trans(string $title, string $toLang = 'en', string $fromLang = 'auto'): string
    {
        $this->from = $fromLang === "auto" ? "auto-detect" : $fromLang;
        $this->to = $toLang;
        $this->text = $title;

        $response = $this->client->post($this->url, [
            "form_params" => $this->getParams()
        ]);

        $this->result = (string)$response->getBody();

        return $this->resultToString();
    }

    public function getResult()
    {
        return json_decode($this->result, true);
    }

    protected function getParams()
    {
        $fromKey = $this->from === "auto-detect" ? "fromLang" : "from";

        return [
            'text' => $this->text,
            'to' => $this->to,
            $fromKey => $this->from,
        ];
    }

    protected function resultToString()
    {
        $data = $this->getResult();

        return $data[0]['translations'][0]['text'] ?? $this->text;
    }
}
