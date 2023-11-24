<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Tests;

use PHPForge\Support\Assert;
use Yii;
use yii\di\Container;
use yii\i18n\PhpMessageSource;
use yii\web\Application;
use yii\web\View;

/**
 * This is the base class for all yii framework unit tests.
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
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
                    '@root' => dirname(__DIR__),
                    '@bower' => '@root/node_modules',
                    '@npm' => '@root/node_modules',
                ],
                'basePath' => dirname(__DIR__),
                'components' => [
                    'assetManager' => [
                        'appendTimestamp' => false,
                        'basePath' => __DIR__ . '/Support/runtime',
                        'baseUrl' => '/',
                    ],
                    'i18n' => [
                        'translations' => [
                            'yii2.extensions.datetime.picker' => [
                                'class' => PhpMessageSource::class,
                                'basePath' => dirname(__DIR__) . '/resource/message',
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
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
        Yii::$container = new Container();
        Assert::removeFilesFromDirectory(__DIR__ . '/Support/runtime');

        unset($this->view);
    }
}
