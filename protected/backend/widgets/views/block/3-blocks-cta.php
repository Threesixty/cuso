<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

    $dataArr = null !== $value ? JSON::decode($value) : [];
    $baseUrl = str_replace('backend', '', Url::base(true)); ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : 'init-summernote' ?> block-3-blocks-cta my-10" data-block="3-blocks-cta" data-init="summernote" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
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
            <h3 class="text-primary text-uppercase">3 pictos + CTA </h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>

            <div class="form-group">
                <label>Titre :</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" value="<?= isset($dataArr['title']) ? $dataArr['title'] : '' ?>" />
            </div>
            <div class="form-group">
                <label>Paragraphe :</label>
                <div class="summernote"><?= isset($dataArr['content']) ? $dataArr['content'] : '' ?></div>
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
			<div class="accordion accordion-toggle-arrow" id="accordion3BlocksCTA">

	            <?php
	            for ($boxes = 1; $boxes <= 3; $boxes++) { ?>

					<div class="card bg-gray-100 border-light-dark px-3">
						<div class="card-header bg-gray-100" id="heading<?= $boxes ?>">
							<div class="card-title collapsed" data-toggle="collapse" data-parent="#accordion3BlocksCTA" data-target="#collapse3BlocksCTA<?= $boxes ?>">Icône <?= $boxes ?></div>
						</div>
						<div id="collapse3BlocksCTA<?= $boxes ?>" class="collapse">
							<div class="card-body">
					            <div class="form-group">
					                <label class="mb-0">Picto : 
					                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
					                        <i class="flaticon-attachment"></i>
					                        <span class="pulse-ring"></span>
					                    </a>
					                </label>
					                <span class="form-text text-muted mt-0">1 photo/vidéo maxi</span>
					                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
					                    <input type="hidden" name="icon<?= $boxes ?>" value="<?= isset($dataArr['icon'.$boxes]) ? $dataArr['icon'.$boxes] : '[]' ?>">
					                    <div class="row draggable-zone draggable-max p-5" data-draggable-max="1">
					                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['icon'.$boxes]) && $dataArr['icon'.$boxes] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo/vidéo provenant de la bibliothèque</p>

					                        <?php
					                        if (isset($dataArr['icon'.$boxes])) {
					    
					                            foreach (JSON::decode($dataArr['icon'.$boxes]) as $photoId) {
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
					            <div class="form-group">
					                <label>Titre :</label>
					                <input type="text" class="form-control" placeholder="Titre <?= $boxes ?>" name="title<?= $boxes ?>" value="<?= isset($dataArr['title'.$boxes]) ? $dataArr['title'.$boxes] : '' ?>" />
					            </div>
					            <div class="form-group">
					                <label>Texte :</label>
					                <div class="summernote summernote-box<?= $boxes ?>"><?= isset($dataArr['content'.$boxes]) ? $dataArr['content'.$boxes] : '' ?></div>
					            </div>
							</div>
						</div>
					</div>

	            <?php } ?>

	        </div>
        </div>
    </div>