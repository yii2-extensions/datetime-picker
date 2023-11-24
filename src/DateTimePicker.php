<?php

declare(strict_types=1);

namespace Yii2\Extensions\DateTimePicker;

use PHPForge\Html\Div;
use PHPForge\Html\Helper\CssClass;
use PHPForge\Html\Input;
use PHPForge\Html\Label;
use PHPForge\Html\Span;
use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;

final class DateTimePicker extends InputWidget
{
    public bool $cdn = false;
    /**
     * @phpstan-var array<string, mixed>
     */
    public array $config = [];
    public string $containerClass = 'input-group';
    public bool $floatingLabel = false;
    public string $formatMonth = 'long';
    public string $formatYear = 'numeric';
    public string $icon = '';
    public string $id = 'datetimepicker1';
    public string $labelClass = 'form-label';
    public string $labelContent = 'Date';
    public string $spanClass = 'input-group-text';
    public int $startOfTheWeek = 1;
    public string $template = "{label}\n{input}\n{span}";

    public function init(): void
    {
        parent::init();

        $translation = [
            'localization' => [
                'today' => Yii::t('yii2.extensions.datetime.picker', 'Go to today'),
                'clear' => Yii::t('yii2.extensions.datetime.picker', 'Clear selection'),
                'close' => Yii::t('yii2.extensions.datetime.picker', 'Close picker'),
                'selectMonth' => Yii::t('yii2.extensions.datetime.picker', 'Select month'),
                'previousMonth' => Yii::t('yii2.extensions.datetime.picker', 'Previous month'),
                'nextMonth' => Yii::t('yii2.extensions.datetime.picker', 'Next month'),
                'selectYear' => Yii::t('yii2.extensions.datetime.picker', 'Select year'),
                'previousYear' => Yii::t('yii2.extensions.datetime.picker', 'Previous year'),
                'nextYear' => Yii::t('yii2.extensions.datetime.picker', 'Next year'),
                'selectDecade' => Yii::t('yii2.extensions.datetime.picker', 'Select decade'),
                'previousDecade' => Yii::t('yii2.extensions.datetime.picker', 'Previous decade'),
                'nextDecade' => Yii::t('yii2.extensions.datetime.picker', 'Next decade'),
                'previousCentury' => Yii::t('yii2.extensions.datetime.picker', 'Previous century'),
                'nextCentury' => Yii::t('yii2.extensions.datetime.picker', 'Next century'),
                'pickHour' => Yii::t('yii2.extensions.datetime.picker', 'Pick hour'),
                'incrementHour' => Yii::t('yii2.extensions.datetime.picker', 'Increment hour'),
                'decrementHour' => Yii::t('yii2.extensions.datetime.picker', 'Decrement hour'),
                'pickMinute' => Yii::t('yii2.extensions.datetime.picker', 'Pick minute'),
                'incrementMinute' => Yii::t('yii2.extensions.datetime.picker', 'Increment minute'),
                'decrementMinute' => Yii::t('yii2.extensions.datetime.picker', 'Decrement minute'),
                'pickSecond' => Yii::t('yii2.extensions.datetime.picker', 'Pick second'),
                'incrementSecond' => Yii::t('yii2.extensions.datetime.picker', 'Increment second'),
                'decrementSecond' => Yii::t('yii2.extensions.datetime.picker', 'Decrement second'),
                'toggleMeridiem' => Yii::t('yii2.extensions.datetime.picker', 'Toggle meridiem'),
                'selectTime' => Yii::t('yii2.extensions.datetime.picker', 'Select time'),
                'selectDate' => Yii::t('yii2.extensions.datetime.picker', 'Select date'),
                'dayViewHeaderFormat' => [
                    'month' => $this->formatMonth,
                    'year' => $this->formatYear,
                ],
                'locale' => Yii::$app->language,
                'startOfTheWeek' => $this->startOfTheWeek,
            ],
        ];

        $this->config = array_merge($this->config, $translation);
    }

    /**
     * @inheritdoc
     */
    public function run(): string
    {
        $this->registerClientScript();

        return $this->renderDateTimePicker();
    }

    private function getScript(): string
    {
        $config = json_encode($this->config);

        return <<<JS
            $("#$this->id").tempusDominus({$config});
        JS;
    }

    private function renderDateTimePicker(): string
    {
        $containerOptions = [];
        $label = '';
        $template = $this->floatingLabel ? "{input}\n{span}\n{label}" : "{input}\n{span}";

        CssClass::add($containerOptions, $this->floatingLabel ? 'form-floating' : '');
        CssClass::add($containerOptions, $this->containerClass);

        $label = Label::widget()
            ->class($this->labelClass)
            ->content(Yii::t('yii2.extensions.datetime.picker', $this->labelContent));
        $span = Span::widget()
            ->dataAttributes(['td-target' => "#$this->id", 'td-toggle' => 'datetimepicker'])
            ->class($this->spanClass)
            ->content($this->icon);
        $input = Input::widget()
            ->attributes($this->options)
            ->dataAttributes(['td-target' => "#$this->id"])
            ->type('text');

        $input = match ($this->hasModel()) {
            true => $input
                ->id(Html::getInputId($this->model, $this->attribute))
                ->name(Html::getInputName($this->model, $this->attribute))
                ->value($this->model->{$this->attribute}),
            default => $input->id($this->id)->name($this->name)->value($this->value),
        };

        $content = strtr(
            $template,
            [
                '{label}' => $label,
                '{input}' => $input,
                '{span}' => $span,
            ],
        );

        $div = Div::widget()
            ->attributes($containerOptions)
            ->content($content)
            ->dataAttributes(['td-target-input' => 'nearest', 'td-target-toggle' => 'nearest'])
            ->id($this->id)
            ->render();

        return match ($this->floatingLabel) {
            true => $div,
            default => $this->hasModel() ? $div : $label . PHP_EOL . $div,
        };
    }

    private function registerClientScript(): void
    {
        $view = $this->getView();

        match ($this->cdn) {
            true => Asset\DateTimePickerCdnAsset::register($view),
            default => Asset\DateTimePickerAsset::register($view),
        };

        $view->registerJs($this->getScript());
    }
}
