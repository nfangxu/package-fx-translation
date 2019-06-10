## fx/translation

### Installation

- use composer 

```bash
composer require fx/translation
```

### Usage

- Publish config file

```bash
php artisan vendor:publish --provider="Fx\\Translation\\Providers\\FxTranslationServiceProvider"
```

- anywhere, eg:

```php
// routes/web.php
use Fx\Translation\Contacts\Translate;

Route::get('/', function (Translate $translate) {
    dd($translate->trans("You look so good", "zh"));
});
```
