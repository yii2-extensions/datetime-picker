<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Asset;

use Yii2\Asset\PopperCdnAsset;
use yii\web\AssetBundle;

/**
 * Eonasdan DateTimePicker asset bundle for CDN.
 */
final class DateTimePickerCdnAsset extends AssetBundle
{
    /**
     * @inheritDoc
     *
     * @phpstan-var array<array-key, mixed>
     */
    public $depends = [
        PopperCdnAsset::class,
    ];

    public function init(): void
    {
        parent::init();

        $this->css = ['https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.19/dist/css/tempus-dominus.min.css'];
        $this->cssOptions = [
            'crossorigin' => 'anonymous',
            'rel' => 'stylesheet',
        ];
        $this->js = ['https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.19/dist/js/tempus-dominus.min.js'];
        $this->jsOptions = [
            'crossorigin' => 'anonymous',
            'rel' => 'stylesheet',
        ];
    }
}
