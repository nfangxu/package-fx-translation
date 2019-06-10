<?php

namespace Fx\Translation\Contacts;


interface Translate
{
    public function trans(string $title, string $toLang = "en", string $fromLang = "auto"): string;
}