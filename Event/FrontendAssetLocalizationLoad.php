<?php

namespace Xanweb\C5\JsLocalization\Event;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Xanweb\C5\JsLocalization\AssetLocalizationCollection;

class FrontendAssetLocalizationLoad extends EventDispatcher
{
    /**
     * Event Name
     *
     * @var string
     */
    public const NAME = 'on_frontend_asset_localization_load';

    /**
     * @var AssetLocalizationCollection
     */
    private $assetLocalization;

    public function __construct(AssetLocalizationCollection $assetLocalization)
    {
        $this->assetLocalization = $assetLocalization;
    }

    /**
     * @return AssetLocalizationCollection
     */
    public function getAssetLocalization(): AssetLocalizationCollection
    {
        return $this->assetLocalization;
    }
}
