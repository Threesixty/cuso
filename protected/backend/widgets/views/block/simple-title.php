<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

    $dataArr = null !== $value ? JSON::decode($value) : [];
    $baseUrl = str_replace('backend', '', Url::base(true)); ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : '' ?> block-simple-title my-10" data-block="simple-title" data-init="select2" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
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
            <h3 class="text-primary text-uppercase">Simple Title</h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>
            <div class="form-group">
                <label>Titre :</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" value="<?= isset($dataArr['title']) ? $dataArr['title'] : '' ?>" />
            </div>
            <div class="form-group">
                <label>Sous-titre :</label>
                <input type="text" class="form-control" placeholder="Sous-titre" name="subtitle" value="<?= isset($dataArr['subtitle']) ? $dataArr['subtitle'] : '' ?>" />
            </div>
            <div class="form-group">
                <label>Couleur de fond :</label>
                <input type="text" class="form-control" placeholder="#f5d876" name="color" value="<?= isset($dataArr['color']) ? $dataArr['color'] : '' ?>" />
            </div>
            <div class="form-group">
                <label>Alignement :</label>
                <select class="form-control" name="alignment">
                    <option label="Label"></option>
                    <option value="left" <?= isset($dataArr['alignment']) && 'left' == $dataArr['alignment'] ? 'selected="selected"' : '' ?>>Gauche</option>
                    <option value="center" <?= isset($dataArr['alignment']) && 'center' == $dataArr['alignment'] ? 'selected="selected"' : '' ?>>Centré</option>
                </select>
            </div>
        </div>
    </div>