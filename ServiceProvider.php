<?php

namespace Xanweb\C5\JsLocalization;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Support\Facade\Route;
use Xanweb\C5\JsLocalization\Controller\JavascriptAssetDefaults;
use Xanweb\Common\Service\Provider as FoundationProvider;

class ServiceProvider extends FoundationProvider
{
    protected function _register(): void
    {
        $router = Route::getFacadeRoot();
        $router->get('/xw/js/defaults.js', JavascriptAssetDefaults::class . '::getJavascript');

        $this->registerAssets();
    }

    private function registerAssets(): void
    {
        $al = AssetList::getInstance();
        $al->register('javascript-localized', 'xw/defaults', '/xw/js/defaults.js');
    }
}
