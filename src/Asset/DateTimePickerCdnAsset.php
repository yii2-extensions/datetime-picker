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
     * @phpstan-var array<array-key, mixed>
     */
    public $depends = [
        PopperCdnAsset::class,
    ];

    public function init(): void
    {
        parent::init();

        $this->css = ['https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.2/build/css/tempusdominus-bootstrap-4.min.css'];
        $this->cssOptions = [
            'crossorigin' => 'anonymous',
            'rel' => 'stylesheet',
        ];
        $this->js = [
            [
                'https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.2/build/js/tempusdominus-bootstrap-4.min.js',
                'crossorigin' => 'anonymous',
            ],
        ];
    }
}
