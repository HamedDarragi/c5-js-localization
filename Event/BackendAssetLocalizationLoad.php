<?php

namespace Xanweb\C5\JsLocalization\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Xanweb\C5\JsLocalization\AssetLocalizationCollection;

class BackendAssetLocalizationLoad extends Event
{
    /**
     * Event Name
     *
     * @var string
     */
    public const NAME = 'on_backend_asset_localization_load';

    private AssetLocalizationCollection $assetLocalization;

    public function __construct(AssetLocalizationCollection $assetLocalization)
    {
        $this->assetLocalization = $assetLocalization;
    }

    public function getAssetLocalization(): AssetLocalizationCollection
    {
        return $this->assetLocalization;
    }
}
