<?php
use yii\helpers\Url;
use common\components\MainHelper;

#MainHelper::pp($blocks); ?>

	<nav class="block-menu">
		<div class="font-size-h1 text-white font-weight-bold text-uppercase">Contenus</div>
		<div class="separator separator-dashed border-ligth my-4"></div>
	    <?php
	    if (!empty(Yii::$app->request->get('id'))) {
	        foreach ($blocks as $key => $block) { ?>
		    	<a href="#" class="font-weight-bolder text-white" data-scroll="<?= $block['block'] ?>" data-scroll-idx="<?= $key+1 ?>"><?= str_replace('-', ' ', ucfirst($block['block'])) ?></a>
	        <?php }
		} ?>
	</nav>