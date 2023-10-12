<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>

	<tr>
		<td valign="top" style="font-size: 18px; letter-spacing: 0.15em; line-height: 26px; text-transform: uppercase;">Réinitialiser votre mot de passe</td>
	</tr>
	<tr>
		<td valign="top" style="padding-top: 40px; font-size: 18px; font-style: italic; letter-spacing: 0.1em; line-height: 26px;">Bonjour <?= Html::encode($user->gender) ?> <?= Html::encode($user->lastname) ?>,</td>
	</tr>
	<tr>
		<td valign="top" style="padding-top: 10px; font-size: 16px; font-style: italic; line-height: 24px;">
			Cliquez sur le lien ci-dessous pour réinitialiser votre email :<br>
			<?= Html::a(Html::encode($resetLink), $resetLink) ?>
		</td>
	</tr>
