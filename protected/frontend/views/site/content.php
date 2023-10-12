<?php

use yii\helpers\Url;
use yii\helpers\Json;
use frontend\widgets\BlockWidget;
use common\components\MainHelper;

#MainHelper::pp($cms->content);

$this->title = MainHelper::getPageTitle($cms->title, '', true);
?>

    <?php 
    foreach ($cms->content as $block) { ?>

        <?= BlockWidget::widget([
                'type' => $block['block'], 
                'value' => is_array($block['value']) ? JSON::encode($block['value']) : $block['value'],
                'position' => intval($block['position'])-1, 
            ]) ?>

    <?php } ?>

	<?php
	if (isset($mailSent) && $mailSent) { ?>

		<div class="ah-popup-layer absolute flex center-aligned-hor center-aligned-vert modal cover-body">
			<div class="ah-popup-content call-up-popup get-quote-popup white-bg relative centered-text full-width">
				<div class="ah-popup-top">
					<a href="#" class="ah-popup-close block absolute"></a>
				</div>
				<div class="ah-popup-inner">
					<div>
						<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/get-a-quote-popup.png" alt="" class="block margin-auto-hor">
						<span class="block mt-10 mb-20 fs-18 darkgray-text"><?= $popinTitle ?></span>
						<span class="fs-14 lh-20"><?= $popinContent ?></span>
					</div>
					<div class="flex mt-30 center-aligned-hor">
						<a href="#" class="ah-btn small-ah-btn fs-14 border-rad-4 flex center-aligned-vert center-aligned-hor border-1 darkgray-text popup-close">OK</a>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>
