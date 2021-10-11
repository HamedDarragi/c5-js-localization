<?php

namespace Xanweb\C5\JsLocalization\Controller\Backend;

use Concrete\Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Xanweb\C5\JsLocalization\AssetLocalizationCollection;
use Xanweb\C5\JsLocalization\Event\BackendAssetLocalizationLoad;
use Xanweb\C5\JsLocalization\Traits\AssetLocalizationControllerTrait;

class AssetLocalization extends Controller
{
    use AssetLocalizationControllerTrait;

    public function dispatchEvent(AssetLocalizationCollection $assetLocalization): AssetLocalizationCollection
    {
        $this->app['director']->dispatch(
            BackendAssetLocalizationLoad::NAME,
            $event = new BackendAssetLocalizationLoad($assetLocalization)
        );

        return $event->getAssetLocalization();
    }

    public function getJavascript(): Response
    {
        $content = 'window.xw_backend=' . $this->assetLocalization->toJson() . ';';

        return $this->createJavascriptResponse($content);
    }
}
