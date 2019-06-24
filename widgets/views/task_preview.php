<?php
use yii\helpers\Url;

/** @var $model \app\models\tables\Tasks */
?>

<div class="task-container">
    <?php if ($linked): ?>
    <a class="task-preview-link" href="<?= Url::to(['task/one', 'id' => $model->id]) ?>">
        <? endif; ?>
        <div class="task-preview">
            <div class="task-preview-header"><?= $model->name ?></div>
            <div class="task-preview-content"><?= $model->description ?></div>
            <div class="task-preview-user"><?= $model->responsible->login ?></div>
        </div>
        <?php if ($linked): ?>
    </a>
<? endif; ?>
</div>