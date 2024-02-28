<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Asset;

use Yii2\Asset\PopperAsset;
use yii\web\AssetBundle;

/**
 * Eonasdan DateTimePicker asset bundle.
 */
final class DateTimePickerAsset extends AssetBundle
{
    public $sourcePath = '@npm/eonasdan--tempus-dominus/dist';

    /**
     * @phpstan-var array<array-key, mixed>
     */
    public $depends = [
        PopperAsset::class,
        JQueryProviderAsset::class,
    ];

    public function __construct()
    {
        parent::__construct();

        $environment = defined('YII_ENV') ? YII_ENV : 'prod';
        $cssFiles = $environment === 'prod' ? 'css/tempus-dominus.min.css' : 'css/tempus-dominus.css';
        $jsFiles = $environment === 'prod' ? 'js/tempus-dominus.min.js' : 'js/tempus-dominus.js';

        $this->css = [$cssFiles];
        $this->js = [$jsFiles];
        $this->publishOptions['only'] = [$cssFiles, "$cssFiles.map", $jsFiles, "$jsFiles.map"];
    }
}
