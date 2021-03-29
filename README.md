# Concrete5 Javascript Localization
[![Latest Version on Packagist](https://img.shields.io/packagist/v/xanweb/c5-js-localization.svg?style=flat-square)](https://packagist.org/packages/xanweb/c5-js-localization)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

Pass translations and any other information from php to javascript

## Installation

Include library to your composer.json
```bash
composer require xanweb/c5-js-localization
```

## Usage

1- Register `\Xanweb\C5\JsLocalization\ServiceProvider` on package start or include it in `/application/config/app.php`

2- Add listener to `BeforeRenderDefaultAssetJS::NAME` on your package start or under `/application/bootstrap/app.php`:
```php
use Xanweb\C5\JsLocalization\Config\BeforeRenderDefaultAssetJS;

$this->app['director']->addListener(BeforeRenderDefaultAssetJS::NAME, function (BeforeRenderDefaultAssetJS $event) {
    $event->getJavascriptAssetDefaults()->mergeWith([
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

3- Include the required asset to your view:
```php
$view->requireAsset('javascript-localized', 'xw/defaults');
```
4- You can now use your data within javascript file:
```javascript
alert(xanweb.i18n.confirm);

// Init Editor Example:
xanweb.editor.initRichTextEditor($('#myTextareaField'));
```