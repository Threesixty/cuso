<?php
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value); ?>

    <section id="3-blocks-cta<?= $position ?>" class="mission-section centred <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <div class="auto-container">
        	<h2><?= $value['title'] ?></h2>
        	<div class="mt-3 <?= $value['content'] != '<p><br></p>' ? 'mb-5' : '' ?>"><?= $value['content'] ?></div>
            <div class="row clearfix">
				<?php
				for ($idx = 1; $idx <= 3; $idx++) { ?>

	                <div class="col-lg-4 col-md-6 col-sm-12 mission-block">
	                    <div class="mission-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
	                        <div class="inner-box">
	                        	<?php
	                        	if (null !== $value['icon'.$idx]) {
					                foreach (JSON::decode($value['icon'.$idx]) as $photoId) {
					                    $photo = Media::findOne($photoId);
					                    if (null !== $photo) { ?>
                            				<div class="icon-box"><img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->path ?>"></div>
					                    <?php }
					                }
					            } ?>
	                            <h3><?= $value['title'.$idx] ?></h3>
	                            <?= $value['content'.$idx] ?>
	                        </div>
	                    </div>
	                </div>

	            <?php } ?>
            </div>
            <?php 
            if ($value['button'] != '') { ?>
	            <div class="mt_40 mb_40">
	                <a href="<?= MainHelper::getBlockLink($value['link']) ?>" class="theme-btn btn-one"><?= $value['button'] ?></a>
	            </div>
	       	<?php } ?>
        </div>
    </section>