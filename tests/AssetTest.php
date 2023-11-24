<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Tests;

use Yii2\Asset\PopperAsset;
use Yii2\Asset\PopperCdnAsset;
use Yii2\Extensions\DateTimePicker\Asset\DateTimePickerAsset;
use Yii2\Extensions\DateTimePicker\Asset\DateTimePickerCdnAsset;
use Yii2\Extensions\DateTimePicker\DateTimePicker;
use Yii;
use yii\web\AssetBundle;

final class AssetTest extends TestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->mockApplication();

        DateTimePicker::$counter = 0;

        $this->view = Yii::$app->getView();
    }

    public function testDateTimePickerAssetSimpleDependency(): void
    {
        $this->assertEmpty($this->view->assetBundles);

        DateTimePickerAsset::register($this->view);

        $this->assertCount(2, $this->view->assetBundles);

        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[DateTimePickerAsset::class]);
        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[PopperAsset::class]);
    }

    public function testDateTimePickerAssetRegister(): void
    {
        $this->assertEmpty($this->view->assetBundles);

        DateTimePickerAsset::register($this->view);

        $this->assertCount(2, $this->view->assetBundles);

        $result = $this->view->renderFile(
            __DIR__ . '/Support/main.php',
            ['widget' => DateTimePicker::widget(['name' => 'tags', 'id' => 'tests-id'])],
        );

        $this->assertStringContainsString('css/tempus-dominus.css', $result);
        $this->assertStringContainsString('js/tempus-dominus.js', $result);
        $this->assertStringContainsString('js/jQuery-provider.js', $result);
        $this->assertStringContainsString('jquery.js', $result);
    }

    public function testDateTimePickerCdnAssetSimpleDependency(): void
    {
        $this->assertEmpty($this->view->assetBundles);

        DateTimePickerCdnAsset::register($this->view);

        $this->assertCount(2, $this->view->assetBundles);

        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[DateTimePickerCdnAsset::class]);
        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[PopperCdnAsset::class]);
    }

    public function testDateTimePickerCdnAssetRegister(): void
    {
        $this->assertEmpty($this->view->assetBundles);

        DateTimePickerCdnAsset::register($this->view);

        $this->assertCount(2, $this->view->assetBundles);

        $result = $this->view->renderFile(
            __DIR__ . '/Support/main.php',
            ['widget' => DateTimePicker::widget(['cdn' => true, 'id' => 'tests-id', 'name' => 'tags'])],
        );

        $this->assertStringContainsString(
            <<<HTML
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"></script>
            HTML,
            $result,
        );
        $this->assertStringContainsString(
            <<<HTML
            <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.19/dist/js/tempus-dominus.min.js" rel="stylesheet" crossorigin="anonymous"></script>
            HTML,
            $result,
        );
        $this->assertStringContainsString('jquery.js', $result);
    }
}
