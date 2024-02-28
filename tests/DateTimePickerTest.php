<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker\Tests;

use PHPForge\{Html\Textual\I, Support\Assert};
use Yii2\Extensions\DateTimePicker\{DateTimePicker, Tests\Support\DateTimePickerModel};
use Yii;

final class DateTimePickerTest extends TestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->mockApplication();

        DateTimePicker::$counter = 0;

        $this->view = Yii::$app->getView();
    }

    public function testContainerClass(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'containerClass' => 'input-group test-class',
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group test-class" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testFloatingLabel(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'floatingLabel' => true,
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-floating input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            <label class="form-label">Date</label>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testFormat(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'format' => 'dd/MM/yyyy HH:mm:ss',
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"dd\/MM\/yyyy HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testFormatMonth(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'formatMonth' => 'short',
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"short","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testFormatYear(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'formatYear' => '2-digit',
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"2-digit"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testIcon(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'icon' => I::widget()->class('fa fa-calendar'),
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"><i class="fa fa-calendar"></i></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testId(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'id' => 'datetimepicker2',
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker2" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker2">
            <span class="input-group-text" data-td-target="#datetimepicker2" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker2").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testLabelClass(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'name' => 'datetime-picker',
                'labelClass' => 'test-class',
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <label class="test-class">Date</label>
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="w0" name="datetime-picker" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testLabelContent(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'name' => 'datetime-picker',
                'labelContent' => 'DateTime',
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <label class="form-label">DateTime</label>
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="w0" name="datetime-picker" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testName(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'name' => 'datetime-picker',
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <label class="form-label">Date</label>
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="w0" name="datetime-picker" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testSpanClass(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'model' => new DateTimePickerModel(),
                'spanClass' => 'input-group-text test-class',
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text test-class" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testStarOfTheWeek(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'model' => new DateTimePickerModel(),
                'startOfTheWeek' => 0,
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":0}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }

    public function testRender(): void
    {
        $dateTimePicker = DateTimePicker::widget(
            [
                'attribute' => 'date',
                'model' => new DateTimePickerModel(),
            ],
        );

        $render = $this->view->renderFile(__DIR__ . '/Support/main.php', [
            'widget' => $dateTimePicker,
        ]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group" id="datetimepicker1" data-td-target-input="nearest" data-td-target-toggle="nearest">
            <input id="datetimepickermodel-date" name="DateTimePickerModel[date]" type="text" data-td-target="#datetimepicker1">
            <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker"></span>
            </div>
            HTML,
            $dateTimePicker,
        );

        $this->assertStringContainsString(
            <<<JS
            <script>jQuery(function ($) {
                const htmlElement = document.querySelector('html');
                let theme = htmlElement.getAttribute('data-bs-theme');

                const config = JSON.parse('{"localization":{"today":"Go to today","clear":"Clear selection","close":"Close picker","selectMonth":"Select month","previousMonth":"Previous month","nextMonth":"Next month","selectYear":"Select year","previousYear":"Previous year","nextYear":"Next year","selectDecade":"Select decade","previousDecade":"Previous decade","nextDecade":"Next decade","previousCentury":"Previous century","nextCentury":"Next century","pickHour":"Pick hour","incrementHour":"Increment hour","decrementHour":"Decrement hour","pickMinute":"Pick minute","incrementMinute":"Increment minute","decrementMinute":"Decrement minute","pickSecond":"Pick second","incrementSecond":"Increment second","decrementSecond":"Decrement second","toggleMeridiem":"Toggle meridiem","selectTime":"Select time","selectDate":"Select date","dayViewHeaderFormat":{"month":"long","year":"numeric"},"format":"yyyy-MM-dd HH:mm:ss","locale":"en-US","startOfTheWeek":1}}');

                if (config.display && config.display.theme) {
                    theme = config.display.theme;
                } else if (!theme) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    theme = prefersDark ? 'dark' : 'light';
                }

                if (theme === 'dark' || theme === 'auto') {
                    config.display = {
                        theme: 'dark',
                    };
                }

                if (theme === 'light') {
                    config.display = {
                        theme: 'light',
                    };
                }

                $("#datetimepicker1").tempusDominus(config);
            });</script>
            JS,
            $render,
        );
    }
}
