<?php

declare(strict_types=1);

/**
 * @var \yii\web\View $this
 * @var string $widget
 */
?>
<?php $this->beginPage();?>
    <?php $this->head();?>
    <?php $this->beginBody();?>
        <?= $widget ?>
    <?php $this->endBody();?>
<?php $this->endPage();
