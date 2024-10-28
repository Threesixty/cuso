<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

$dataArr = null !== $value ? JSON::decode($value) : [];
$baseUrl = str_replace('backend', '', Url::base(true)); ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : 'init-summernote' ?> block-simple-text my-10" data-block="simple-text" data-init="summernote,select2" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
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
            <h3 class="text-primary text-uppercase">Texte simple</h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>

            <div class="form-group">
                <label>Contenu :</label>
                <div class="summernote summernote-box"><?= isset($dataArr['content']) ? $dataArr['content'] : '' ?></div>
            </div>
            <div class="form-group">
                <label>Largeur :</label>
                <select class="form-control" name="width">
                    <option label="Label"></option>
                    <option value="6" <?= isset($dataArr['width']) && 6 == $dataArr['width'] ? 'selected="selected"' : '' ?>>Petite</option>
                    <option value="8" <?= isset($dataArr['width']) && 8 == $dataArr['width'] ? 'selected="selected"' : '' ?>>Moyenne</option>
                    <option value="12" <?= isset($dataArr['width']) && 12 == $dataArr['width'] ? 'selected="selected"' : '' ?>>Grande</option>
                </select>
            </div>
        </div>
    </div>