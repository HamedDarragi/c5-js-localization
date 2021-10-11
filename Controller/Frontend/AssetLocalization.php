<?php

namespace Xanweb\C5\JsLocalization\Controller\Frontend;

use Concrete\Core\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Xanweb\C5\JsLocalization\AssetLocalizationCollection;
use Xanweb\C5\JsLocalization\Event\FrontendAssetLocalizationLoad;
use Xanweb\C5\JsLocalization\Traits\AssetLocalizationControllerTrait;

class AssetLocalization extends Controller
{
    use AssetLocalizationControllerTrait;

    public function dispatchEvent(AssetLocalizationCollection $assetLocalization): AssetLocalizationCollection
    {
        $this->app['director']->dispatch(
            FrontendAssetLocalizationLoad::NAME,
            $event = new FrontendAssetLocalizationLoad($assetLocalization)
        );

        return $event->getAssetLocalization();
    }

    public function getJavascript(): Response
    {
        $content = 'window.xw_frontend=' . $this->assetLocalization->toJson() . ';';

        return $this->createJavascriptResponse($content);
    }
}
