<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Tests;

use Yii2\Extensions\DateTimePicker\DateTimePicker;
use yii\base\InvalidConfigException;

final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testWithoutModelWithoutName(): void
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage("Either 'name', or 'model' and 'attribute' properties must be specified.");

        DateTimePicker::widget();
    }
}
