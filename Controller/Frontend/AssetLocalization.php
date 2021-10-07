<?php

namespace Xanweb\C5\JsLocalization\Controller\Frontend;

use Concrete\Core\Controller\Controller;
use Concrete\Core\Http\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Xanweb\C5\JsLocalization\Event\FrontendAssetLocalizationLoad;
use Xanweb\C5\JsLocalization\AssetLocalizationCollection;

class AssetLocalization extends Controller
{
    private AssetLocalizationCollection $assetLocalization;

    public function on_start()
    {
        $config = new AssetLocalizationCollection();
        $this->app['director']->dispatch(
            FrontendAssetLocalizationLoad::NAME,
            $event = new FrontendAssetLocalizationLoad($config)
        );

        $this->assetLocalization = $event->getAssetLocalization();
    }

    public function getJavascript(): Response
    {
        $content = 'window.xw_frontend=' . $this->assetLocalization->toJson() . ';';

        return $this->createJavascriptResponse($content);
    }

    private function createJavascriptResponse(string $content): Response
    {
        $rf = $this->app->make(ResponseFactoryInterface::class);

        return $rf->create(
            $content,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/javascript; charset=' . APP_CHARSET,
                'Content-Length' => strlen($content),
            ]
        );
    }
}
