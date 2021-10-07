# ConcreteCMS Javascript Localization
[![Latest Version on Packagist](https://img.shields.io/packagist/v/xanweb/c5-js-localization.svg?style=flat-square)](https://packagist.org/packages/xanweb/c5-js-localization)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Pass translations and any other information from php to javascript

## Installation

Include library to your composer.json
```bash
composer require xanweb/c5-js-localization
```

## Usage

Register `\Xanweb\C5\JsLocalization\ServiceProvider` on package start or include it in `/application/config/app.php`

### For Backend:
1- Add listener to `BackendAssetLocalizationLoad::NAME` on your package start or under `/application/bootstrap/app.php`:
```php
use Xanweb\C5\JsLocalization\Event\BackendAssetLocalizationLoad;

$this->app['director']->addListener(BackendAssetLocalizationLoad::NAME, function (BackendAssetLocalizationLoad $event) {
    $event->getAssetLocalization()->mergeWith([
        'i18n' => [
            'confirm' => t('Are you sure?'),
            'maxItemsExceeded' => t('Max items exceeded, you cannot add any more items.'),
            'pageNotFound' => t('Page not found'),
            'colorPicker' => [
                'cancelText' => t('Cancel'),
                'chooseText' => t('Choose'),
                'togglePaletteMoreText' => t('more'),
                'togglePaletteLessText' => t('less'),
                'noColorSelectedText' => t('No Color Selected'),
                'clearText' => t('Clear Color Selection'),
            ]
        ],
        'editor' => [
            'initRichTextEditor' => $this->app['editor']->getEditorInitJSFunction(),
        ],
    ]);
});
```

2- Include the required asset to your view:
```php
$view->requireAsset('javascript-localized', 'xw/backend');
```
3- You can now use your data within javascript file:
```javascript
alert(xw_backend.i18n.confirm);

// Init Editor Example:
xw_backend.editor.initRichTextEditor($('#myTextareaField'));
```

### For Frontend:
1- Add listener to `FrontendAssetLocalizationLoad::NAME` on your package start or under `/application/bootstrap/app.php`:
```php
use Xanweb\C5\JsLocalization\Event\FrontendAssetLocalizationLoad;

$this->app['director']->addListener(FrontendAssetLocalizationLoad::NAME, function (FrontendAssetLocalizationLoad $event) {
    $event->getAssetLocalization()->mergeWith([
        'i18n' => [
            'message' => t('Are you sure?'),
        ],
        'methods' => [
            'showMessage' => 'function(){ alert("Website: ' . Core::make('site')->getSite()->getSiteName() . '"); }',
        ],
    ]);
});
```

2- Include the required asset to your view:
```php
$view->requireAsset('javascript-localized', 'xw/frontend');
```
3- You can now use your data within javascript file:
```javascript
alert(xw_frontend.i18n.message);

// Execute function:
xw_frontend.methods.showMessage();
```
