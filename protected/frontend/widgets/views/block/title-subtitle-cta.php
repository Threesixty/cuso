<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value); ?>


    <!-- cta-section -->
    <section id="title-subtitle-cta<?= $position ?>" class="cta-section centred <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <?php
        if (null !== $value['photo']) {
        MainHelper::pp($value['photo']);
        	$photoArr = JSON::decode($value['photo']);
        	if (!empty($photoArr)) {
	            foreach ($photoArr as $photoId) {
	                $photo = Media::findOne($photoId); ?>
			        <div class="bg-layer parallax-bg" data-parallax='{"y": 100}' style="background-image: url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>);"></div>
			    <?php }
			} else { ?>
			        <div class="bg-layer parallax-bg" data-parallax='{"y": 100}' style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg)"></div>
		    <?php }
        } ?>
        <div class="auto-container">
            <div class="inner-box">
                <h2><?= $value['title'] ?></h2>
                <span><?= $value['subtitle'] ?></span>
                <?php
                if ($value['link'] != '') { ?>
                	<a href="<?= MainHelper::getBlockLink($value['link']) ?>" class="theme-btn btn-one"><?= $value['button'] ?></a>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- cta-section end -->