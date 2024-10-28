<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value); ?>

    <!-- sidebar-page-container -->
    <section id="photos<?= $position ?>" class="sidebar-page-container <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="content-one">
                            <div class="row clearfix">
                                <?php
                                if (null !== $value['photos']) {
                                    $photos = JSON::decode($value['photos']);
                                    $col = 8;
                                    $offset = 'offset-lg-2';
                                    if (count($photos) %2 == 0) {
                                        $col = 6;
                                        $offset = '';
                                    }
                                    elseif (count($photos) %3 == 0) {
                                        $col = 4;
                                        $offset = '';
                                    }

                                    foreach ($photos as $photoId) {
                                        $photo = Media::findOne($photoId);
                                        if (null !== $photo) { ?>
                                            <div class="<?= $offset ?> col-lg-<?= $col ?> col-md-<?= $col ?> col-sm-12 image-column">
                                                <figure class="image">
                                                    <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->path ?>">
                                                </figure>
                                            </div>
                                        <?php }
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->