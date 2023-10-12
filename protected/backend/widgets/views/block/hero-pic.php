<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

    $dataArr = null !== $value ? JSON::decode($value) : [];
    $baseUrl = str_replace('backend', '', Url::base(true)); ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : '' ?> block-hero-pic my-10" data-block="hero-pic" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
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
            <h3 class="text-primary text-uppercase">Bloc Hero Pic</h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>
            
            <div class="form-group">
                <label>Titre :</label>
                <input type="text" class="form-control" placeholder="Titre du contenu" name="title" value="<?= isset($dataArr['title']) ? $dataArr['title'] : '' ?>" />
            </div>
            <div class="form-group">
                <label class="mb-0">Miniatures - Photos ou vidéos : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>

                <div class="alert alert-custom alert-light-primary fade show mt-3 mb-5" role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-warning"></i>
                    </div>
                    <div class="alert-text">Le nombre et l'ordre des médias miniatures doivent correspondre avec le nombre et l'ordre des médias haute définition</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="ki ki-close"></i>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="media_thumb" value="<?= isset($dataArr['media_thumb']) ? $dataArr['media_thumb'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['media_thumb']) && $dataArr['media_thumb'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo/vidéo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['media_thumb'])) {
    
                            foreach (JSON::decode($dataArr['media_thumb']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) {
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path); ?>

                                    <div class="col-md-6 mt-3 mb-3 draggable" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $photo->title ?>" data-id="<?= $photo->id ?>" tabindex="-1" style="">
                                        <div class="action-btn">
                                            <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="<?= $photo->id ?>">
                                                <i class="flaticon2-trash"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-icon btn-primary btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" data-media-id="<?= $photo->id ?>" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
                                                <i class="flaticon2-edit"></i>
                                            </a>
                                        </div>
                                        <div class="overflow-image rounded draggable-handle">
                                            <?php
                                            switch ($pathInfo['extension']) {
                                                case 'jpg':
                                                case 'png':
                                                case 'gif':
                                                case 'svg': ?>
                                                    <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                    <?php break;

                                                case 'mp4': ?>
                                                    <video class="rounded" controls="">
                                                        <source src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                    </video>
                                                    <?php break;
                                                
                                                default: 
                                                    # code...
                                                    break;
                                            } ?>
                                        </div>
                                    </div>

                                <?php }
                            }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="mb-0">Photos ou vidéos : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>
                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="media" value="<?= isset($dataArr['media']) ? $dataArr['media'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['media']) && $dataArr['media'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo/vidéo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['media'])) {
    
                            foreach (JSON::decode($dataArr['media']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) {
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path); ?>

                                    <div class="col-md-6 mt-3 mb-3 draggable" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $photo->title ?>" data-id="<?= $photo->id ?>" tabindex="-1" style="">
                                        <div class="action-btn">
                                            <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="<?= $photo->id ?>">
                                                <i class="flaticon2-trash"></i>
                                            </a>
                                            <a href="javascript:;" class="btn btn-icon btn-primary btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" data-media-id="<?= $photo->id ?>" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
                                                <i class="flaticon2-edit"></i>
                                            </a>
                                        </div>
                                        <div class="overflow-image rounded draggable-handle">
                                            <?php
                                            switch ($pathInfo['extension']) {
                                                case 'jpg':
                                                case 'png':
                                                case 'gif':
                                                case 'svg': ?>
                                                    <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                    <?php break;

                                                case 'mp4': ?>
                                                    <video class="rounded" controls="">
                                                        <source src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                    </video>
                                                    <?php break;
                                                
                                                default: 
                                                    # code...
                                                    break;
                                            } ?>
                                        </div>
                                    </div>

                                <?php }
                            }
                        } ?>
                    </div>
                </div>
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
        </div>
    </div>