<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\models\Event;
use common\components\MainHelper;

$dataArr = null !== $value ? JSON::decode($value) : [];
$baseUrl = str_replace('backend', '', Url::base(true)); ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : 'init-summernote' ?> block-photos my-10" data-block="photos" data-init="summernote" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
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
            <h3 class="text-primary text-uppercase">Photos</h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>

            <div class="form-group">
                <label class="mb-0">Photos : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>
                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="photos" value="<?= isset($dataArr['photos']) ? $dataArr['photos'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['photos']) && $dataArr['photos'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['photos'])) {
    
                            foreach (JSON::decode($dataArr['photos']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) { ?>

                                    <div class="col-md-6 mt-3 mb-3 draggable" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $photo->title ?>" data-id="<?= $photo->id ?>" tabindex="-1" style="">
                                        <div class="action-btn">
                                            <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="<?= $photo->id ?>">
                                                <i class="flaticon2-trash"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-icon btn-success btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" data-media-id="<?= $photo->id ?>" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
                                                <i class="flaticon2-edit"></i>
                                            </a>
                                        </div>
                                        <div class="overflow-image rounded draggable-handle">
                                            <?php
                                            $mimeType = mime_content_type(Yii::getAlias('@uploadFolder').'/'.$photo->path);
                                            $type = explode('/', $mimeType);
                                            switch ($type[0]) {
                                                case 'image': ?>
                                                    <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                    <?php break;

                                                case 'video': ?>
                                                    <video class="rounded" muted autoplay>
                                                        <source src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                    </video>
                                                    <?php break;

                                                case 'application':
                                                    $icon = ''; 
                                                    switch ($type[1]) {
                                                        case 'pdf':
                                                            $icon = 'pdf';
                                                            break;
                                                        case 'msword':
                                                        case 'vnd.openxmlformats-officedocument.wordprocessingml.document':
                                                            $icon = 'word';
                                                            break;
                                                        case 'vnd.ms-excel':
                                                        case 'vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                                                            $icon = 'excel';
                                                            break;
                                                        case 'vnd.ms-powerpoint':
                                                        case 'vnd.openxmlformats-officedocument.presentationml.presentation':
                                                            $icon = 'powerpoint';
                                                            break;
                                                         
                                                         default:
                                                            $icon = 'document';
                                                            break;
                                                    } ?>
                                                    <img src="<?= Yii::$app->request->BaseUrl ?>/media/<?= $icon ?>.png">
                                                    <?php break;
                                                
                                                default: ?>
                                                    <img src="<?= Yii::$app->request->BaseUrl ?>/media/document.png">
                                                    <?php break;
                                            } ?>
                                        </div>
                                    </div>

                                <?php }
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>