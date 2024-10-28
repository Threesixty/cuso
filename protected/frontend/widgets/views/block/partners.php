<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value); ?>

    <!-- clients-style-two -->
    <section id="partners<?= $position ?>" class="clients-style-two <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <div class="auto-container">
            <div class="title-inner <?= $value['title'] != '' ? 'mb_60' : '' ?> text-center">
                <h2><?= $value['title'] ?></h2>
                <?php
                if ($value['subtitle'] != '<p><br></p>') { ?>
                    <div class="my-3"><?= $value['subtitle'] ?></div>
                <?php } ?>
            </div>
            <ul class="clients-logo-list">

                <?php
                if (null !== $value['logos']) {
                    foreach (JSON::decode($value['logos']) as $photoId) {
                        $photo = Media::findOne($photoId);
                        if (null !== $photo) { ?>
                            <li>
                                <a href="<?= null !== $photo->link ? $photo->link : 'javascript:void(0)' ?>" target="_blank">
                                    <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->path ?>">
                                </a>
                            </li>
                        <?php }
                    }
                } ?>

            </ul>
            <?php
            if ($value['link'] != '') { ?>
                <div class="centred mt_60">
                    <a href="<?= MainHelper::getBlockLink($value['link']) ?>" class="theme-btn btn-one"><?= $value['button'] ?></a>  
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- clients-style-two end -->