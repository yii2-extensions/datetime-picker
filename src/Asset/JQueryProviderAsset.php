<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Asset;

use yii\web\AssetBundle;

/**
 * Eonasdan DateTimePicker JQuery provider asset bundle.
 */
final class JQueryProviderAsset extends AssetBundle
{
    public $sourcePath = '@npm/eonasdan--tempus-dominus/dist/js';

    /**
     * @phpstan-var array<array-key, mixed>
     */
    public $depends = [DateTimePickerAsset::class];

    public function __construct()
    {
        parent::__construct();

        $environment = defined('YII_ENV') ? YII_ENV : 'prod';
        $jsFiles = $environment === 'prod' ? 'jQuery-provider.min.js' : 'jQuery-provider.js';

        $this->js = [$jsFiles];
        $this->publishOptions['only'] = [$jsFiles];
    }
}
