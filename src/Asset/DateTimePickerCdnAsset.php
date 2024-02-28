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

        $this->css = ['https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.5/dist/css/tempus-dominus.min.css'];
        $this->cssOptions = [
            'crossorigin' => 'anonymous',
            'integrity' => 'sha256-CnrhpfYrXdEi7tt7MaXkXnjHOtTw2WUF/ZtHsRYTd9o=',
            'rel' => 'stylesheet',
        ];
        $this->js = [
            [
                'https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.5/dist/js/tempus-dominus.min.js',
                'crossorigin' => 'anonymous',
                'integrity' => 'sha256-HhK4pzV6V5uvaAYnvGv7rdtJPnECOyPE5ht/eE6dvYw=',
                'rel' => 'stylesheet',
            ],
            [
                'https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.5/dist/js/jQuery-provider.min.js',
                'crossorigin' => 'anonymous',
                'integrity' => 'sha256-NMrbeybKZu57CqLc5IecBME3FpiCIhcicPBoZCQ2gXc=',
                'rel' => 'stylesheet',
            ],
        ];
    }
}
