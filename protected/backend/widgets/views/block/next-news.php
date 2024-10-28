<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\models\Event;
use common\components\MainHelper;

$dataArr = null !== $value ? JSON::decode($value) : [];
$baseUrl = str_replace('backend', '', Url::base(true)); ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : 'init-summernote' ?> block-next-news my-10" data-block="next-news" data-init="summernote" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
        <div class="action-btn text-center">
            <a href="javascript:;" class="btn btn-danger btn-icon btn-circle btn-lg remove-block"><i class="flaticon2-trash"></i></a>
            <a href="javascript:;" class="btn btn-success btn-icon btn-circle btn-lg move-top"><i class="flaticon2-up"></i></a>
            <a href="javascript:;" class="btn btn-success btn-icon btn-circle btn-lg move-bottom"><i class="flaticon2-down"></i></a>
            <a href="javascript:;" class="btn btn-primary btn-icon btn-circle btn-lg dropdown-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon2-plus"></i></a>
            <div class="dropdown-menu py-0 add-block" style="">
                <?php
                foreach ($blocks as $key => $block) { ?>
                    <!--div class="dropdown-divider"></div-->
                    <a class="dropdown-item" href="javascript:;" data-block="block-<?= $key ?>"><?= $block ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="block-unit bg-gray-100 p-5 border-light-dark rounded">
            <h3 class="text-primary text-uppercase">Prochaines actualités</h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>

            <div class="form-group">
                <label>Titre :</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" value="<?= isset($dataArr['title']) ? $dataArr['title'] : '' ?>" />
            </div>
            <div class="form-group">
                <label>Paragraphe :</label>
                <div class="summernote"><?= isset($dataArr['subtitle']) ? $dataArr['subtitle'] : '' ?></div>
            </div>
            <div class="form-group">
                <label>Lien :</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= isset($dataArr['link']) && substr($dataArr['link'], 0, 4) == 'http' ? 'Lien externe' : $baseUrl ?></button>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item link-ddl" href="javascript:void(0)" data-placeholder="url-du-contenu"><?= $baseUrl ?></a>
                            <a class="dropdown-item link-ddl" href="javascript:void(0)" data-placeholder="https://...">Lien externe</a>
                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="url-du-contenu" name="link" value="<?= isset($dataArr['link']) ? $dataArr['link'] : '' ?>" />
                </div>

            </div>
            <div class="form-group">
                <label>Texte du lien :</label>
                <input type="text" class="form-control" placeholder="Texte du lien" name="button" value="<?= isset($dataArr['button']) ? $dataArr['button'] : '' ?>" />
            </div>
        </div>
    </div>