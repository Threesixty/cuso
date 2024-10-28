<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value);
$col = isset($value['width']) ? $value['width'] : 12;
$offset = isset($value['width']) && $value['width'] != '' ? (12 - intval($value['width'])) /2 : 0; ?>

    <!-- sidebar-page-container -->
    <section id="simple-text<?= $position ?>" class="sidebar-page-container <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="offset-lg-<?= $offset ?> col-lg-<?= $col ?> col-md-12 col-sm-12">
                    <div class="blog-details-content">
                        <div class="content-one">
                            <div class="text-box"><?= $value['content'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->