<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?php $this->registerCsrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->request->BaseUrl ?>/favicon.png">

	    <?php $this->head() ?>
	</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading">
		<?php $this->beginBody() ?>

			<div class="d-flex flex-column flex-root">

                <?= Alert::widget() ?>
				<?= $content ?>

			</div>

		<?php $this->endBody() ?>
	</body>
</html>

<?php $this->endPage() ?>
