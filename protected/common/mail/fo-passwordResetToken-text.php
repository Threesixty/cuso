<?php
use common\models\Cms;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetPasswordPage = Cms::getCmsByTemplate('resetPassword', null, true);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/content', 'url' => $resetPasswordPage->url, 'token' => $user->password_reset_token]);
?>
Bonjour <?= $user->gender ?> <?= $user->lastname ?>,

Cliquez sur le lien ci-dessous pour réinitialiser votre email :

<?= $resetLink ?>
