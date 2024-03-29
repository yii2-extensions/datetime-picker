<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Tests;

use Yii2\Asset\{PopperAsset, PopperCdnAsset};
use Yii2\Extensions\DateTimePicker\{
    Asset\DateTimePickerAsset,
    Asset\DateTimePickerCdnAsset,
    Asset\JQueryProviderAsset,
    DateTimePicker,
    Tests\Support\TestSupport
};
use Yii;
use yii\web\AssetBundle;

final class AssetTest extends \PHPUnit\Framework\TestCase
{
    use TestSupport;

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

        JQueryProviderAsset::register($this->view);

        $this->assertCount(3, $this->view->assetBundles);

        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[DateTimePickerAsset::class]);
        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[PopperAsset::class]);
        $this->assertInstanceOf(AssetBundle::class, $this->view->assetBundles[JQueryProviderAsset::class]);
    }

    public function testDateTimePickerAssetRegister(): void
    {
        $result = $this->view->renderFile(
            __DIR__ . '/Support/main.php',
            [
                'widget' => DateTimePicker::widget(
                    [
                        'name' => 'tags',
                        'id' => 'tests-id',
                    ]
                ),
            ],
        );

        $directory = __DIR__ . '/Support/runtime/16b8de20';

        $this->assertFileDoesNotExist("$directory/css/tempus-dominus.min.css");
        $this->assertFileDoesNotExist("$directory/css/tempus-dominus.min.css.map");
        $this->assertFileDoesNotExist("$directory/js/tempus-dominus.min.js");
        $this->assertFileDoesNotExist("$directory/js/tempus-dominus.min.js.map");
        $this->assertFileDoesNotExist("$directory/jQuery-provider.min.js");
        $this->assertFileDoesNotExist("$directory/popper.min.js");

        $this->assertFileExists("$directory/css/tempus-dominus.css");
        $this->assertFileExists("$directory/css/tempus-dominus.css.map");
        $this->assertFileExists("$directory/js/tempus-dominus.js");
        $this->assertFileExists("$directory/js/tempus-dominus.js.map");
        $this->assertFileExists("$directory/jQuery-provider.js");
        $this->assertFileExists("$directory/popper.js");

        $this->assertStringContainsString('css/tempus-dominus.css', $result);
        $this->assertStringContainsString('js/tempus-dominus.js', $result);
        $this->assertStringContainsString('jQuery-provider.js', $result);
        $this->assertStringContainsString('popper.js', $result);
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
            [
                'widget' => DateTimePicker::widget(
                    [
                        'cdn' => true,
                        'id' => 'tests-id',
                        'name' => 'tags',
                    ]
                ),
            ],
        );

        $this->assertStringContainsString(
            <<<HTML
            <link href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.5/dist/css/tempus-dominus.min.css" rel="stylesheet" crossorigin="anonymous" integrity="sha256-CnrhpfYrXdEi7tt7MaXkXnjHOtTw2WUF/ZtHsRYTd9o=">
            HTML,
            $result,
        );
        $this->assertStringContainsString(
            <<<HTML
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"></script>
            HTML,
            $result,
        );
        $this->assertStringContainsString(
            <<<HTML
            <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.5/dist/js/jQuery-provider.min.js" rel="stylesheet" crossorigin="anonymous" integrity="sha256-NMrbeybKZu57CqLc5IecBME3FpiCIhcicPBoZCQ2gXc="></script>
            HTML,
            $result,
        );
        $this->assertStringContainsString(
            <<<HTML
            <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.5/dist/js/tempus-dominus.min.js" rel="stylesheet" crossorigin="anonymous" integrity="sha256-HhK4pzV6V5uvaAYnvGv7rdtJPnECOyPE5ht/eE6dvYw="></script>
            HTML,
            $result,
        );
        $this->assertStringContainsString('jquery.js', $result);
    }
}
