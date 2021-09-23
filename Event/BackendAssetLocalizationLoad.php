<?php

namespace Xanweb\C5\JsLocalization\Event;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Xanweb\C5\JsLocalization\AssetLocalizationCollection;

class BackendAssetLocalizationLoad extends EventDispatcher
{
    /**
     * Event Name
     *
     * @var string
     */
    public const NAME = 'on_backend_asset_localization_load';

    /**
     * @var AssetLocalizationCollection
     */
    private $assetLocalization;

    public function __construct(AssetLocalizationCollection $assetLocalization)
    {
        $this->assetLocalization = $assetLocalization;
    }

    public function getAssetLocalization(): AssetLocalizationCollection
    {
        return $this->assetLocalization;
    }
}
