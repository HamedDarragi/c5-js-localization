<?php

namespace Xanweb\C5\JsLocalization;

use Concrete\Core\Asset\AssetList;
use Concrete\Core\Localization\Localization;
use Concrete\Core\Support\Facade\Route;
use Illuminate\Support\Str;
use Xanweb\C5\JsLocalization\Controller\Backend\AssetLocalization as BackendAssetLocalization;
use Xanweb\C5\JsLocalization\Controller\Frontend\AssetLocalization as FrontendAssetLocalization;
use Xanweb\C5\JsLocalization\Controller\JavascriptAssetDefaults;
use Xanweb\Common\Routing\Middleware\LocalizedMiddleware;
use Xanweb\Common\Service\Provider as FoundationProvider;

class ServiceProvider extends FoundationProvider
{
    protected function _register(): void
    {
        $router = Route::getFacadeRoot();
        $router->get('/xw/defaults/js', JavascriptAssetDefaults::class . '::getJavascript');
        $router->get('/xw/backend/js', BackendAssetLocalization::class . '::getJavascript');

        $router
            ->get('/xw/{_locale}/frontend/js', FrontendAssetLocalization::class . '::getJavascript')
            ->addMiddleware(LocalizedMiddleware::class);

        $this->registerAssets();
    }

    private function registerAssets(): void
    {
        $_locale = Str::lower(str_replace('_', '-', Localization::activeLocale()));

        $al = AssetList::getInstance();
        $al->register('javascript-localized', 'xw/defaults', '/xw/defaults/js');
        $al->register('javascript-localized', 'xw/backend', '/xw/backend/js');
        $al->register('javascript-localized', 'xw/frontend', "/xw/{$_locale}/frontend/js");
    }
}
