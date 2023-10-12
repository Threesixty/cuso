<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Bonjour <?= $user->gender ?> <?= $user->lastname ?>,

Cliquez sur le lien ci-dessous pour réinitialiser votre email :

<?= $resetLink ?>
