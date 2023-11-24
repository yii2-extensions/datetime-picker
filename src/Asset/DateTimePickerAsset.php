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
    /**
     * @inheritDoc
     */
    public $sourcePath = '@npm/eonasdan--tempus-dominus/dist';

    /**
     * @inheritDoc
     *
     * @phpstan-var array<array-key, mixed>
     */
    public $depends = [
        PopperAsset::class,
    ];

    public function init(): void
    {
        parent::init();

        $this->css = YII_ENV === 'prod' ? ['css/tempus-dominus.min.css'] : ['css/tempus-dominus.css'];
        $this->js = YII_ENV === 'prod'
            ? ['js/tempus-dominus.min.js', 'js/jQuery-provider.min.js'] : ['js/tempus-dominus.js', 'js/jQuery-provider.js'];

        $this->publishOptions['only'] = array_merge(
            $this->css,
            YII_ENV === 'prod' ? [] : ['css/bootstrap.js.map', 'js/bootstrap.js.map'],
            $this->js,
        );
    }
}
