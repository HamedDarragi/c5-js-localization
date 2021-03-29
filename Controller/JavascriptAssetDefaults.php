<?php

namespace Xanweb\C5\JsLocalization\Controller;

use Concrete\Core\Controller\Controller;
use Concrete\Core\Http\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Xanweb\C5\JsLocalization\Config\BeforeRenderDefaultAssetJS;
use Xanweb\C5\JsLocalization\Config\JavascriptAssetDefaults as JavascriptAssetDefaultConfigs;

class JavascriptAssetDefaults extends Controller
{
    /**
     * @var JavascriptAssetDefaultConfigs
     */
    private $jsAssetDefaults;

    public function on_start()
    {
        $config = new JavascriptAssetDefaultConfigs();
        $this->app['director']->dispatch(
            BeforeRenderDefaultAssetJS::NAME,
            $event = new BeforeRenderDefaultAssetJS($config)
        );

        $this->jsAssetDefaults = $event->getJavascriptAssetDefaults();
    }

    public function getJavascript(): Response
    {
        $content = 'window.xanweb=' . $this->jsAssetDefaults->toJson() . ';';

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
