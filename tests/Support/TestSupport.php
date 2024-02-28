<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Tests\Support;

use PHPForge\Support\Assert;
use Yii;
use yii\{di\Container, i18n\PhpMessageSource, web\Application, web\View};

trait TestSupport
{
    protected View $view;

    /**
     * Clean up after test.
     * By default the application created with [[mockApplication]] will be destroyed.
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->destroyApplication();
    }

    protected function mockApplication(): void
    {
        new Application(
            [
                'id' => 'testapp',
                'aliases' => [
                    '@root' => dirname(__DIR__, 2),
                    '@bower' => '@vendor/bower-asset',
                    '@npm' => '@vendor/npm-asset',
                ],
                'basePath' => dirname(__DIR__, 2),
                'components' => [
                    'assetManager' => [
                        'appendTimestamp' => false,
                        'basePath' => __DIR__ . '/runtime',
                        'baseUrl' => '/',
                        'forceCopy' => true,
                    ],
                    'i18n' => [
                        'translations' => [
                            'yii2.extensions.datetime.picker' => [
                                'class' => PhpMessageSource::class,
                                'basePath' => dirname(__DIR__, 2) . '/resource/message',
                            ],
                        ],
                    ],
                    'request' => [
                        'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
                        'scriptFile' => __DIR__ . '/index.php',
                        'scriptUrl' => '/index.php',
                    ],
                ],
            ],
        );

        Yii::$app->assetManager->hashCallback = static function (string $path) {
            return '16b8de20';
        };
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
        Yii::$container = new Container();
        Assert::removeFilesFromDirectory(__DIR__ . '/runtime');

        unset($this->view);
    }
}
