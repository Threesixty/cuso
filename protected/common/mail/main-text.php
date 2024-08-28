<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>

<?= $title ?>

<?php
if (!empty($message)) {
    foreach ($message as $paragraph) { ?>
		<?= preg_replace('#<br\s*/?>#i', "\n", $paragraph) ?>\n\n
    <?php }
} ?>
