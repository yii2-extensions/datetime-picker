<?php

declare(strict_types=1);

use yii\i18n\PhpMessageSource;

return [
    'components' => [
        'i18n' => [
            'translations' => [
                'yii2.extensions.datetime.picker' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@yii2-extension-datetime-picker/resource/message',
                ],
            ],
        ],
    ],
];
