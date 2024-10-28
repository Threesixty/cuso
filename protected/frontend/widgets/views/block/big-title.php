<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value); ?>

    <!-- page-title -->
    <section id="big-title<?= $position ?>" class="page-title <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <?php
        if (null !== $value['photo']) {
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
            <div class="content-box">
                <h1><?= $value['title'] ?></h1>
            </div>
        </div>
    </section>
    <!-- page-title end -->