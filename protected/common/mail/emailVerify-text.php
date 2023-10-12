<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Bonjour <?= $user->gender ?> <?= $user->lastname ?>,

Cliquez sur le lien ci-dessous pour vérifier votre email :

<?= $verifyLink ?>
