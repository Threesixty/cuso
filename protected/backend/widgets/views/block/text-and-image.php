<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\components\MainHelper;

    $dataArr = null !== $value ? JSON::decode($value) : []; ?>

    <div class="col-lg-12 block <?= !$show ? 'block-widget' : 'init-summernote' ?> block-text-and-image my-10" data-block="text-and-image" data-init="summernote,select2" <?= $show ? 'data-idx="'.($idx+1).'"' : '' ?>>
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
            <h3 class="text-primary text-uppercase">Text and Image</h3>
            <div class="separator separator-dashed border-light-dark my-4"></div>
            <div class="form-group">
                <label>Titre :</label>
                <input type="text" class="form-control" placeholder="Titre" name="title" value="<?= isset($dataArr['title']) ? $dataArr['title'] : '' ?>" />
            </div>
            <div class="form-group">
                <label class="mb-0">Média titre : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>
                <span class="form-text text-muted mt-0">1 photo/vidéo maxi</span>
                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="title_photo" value="<?= isset($dataArr['title_photo']) ? $dataArr['title_photo'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5" data-draggable-max="1">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['title_photo']) && $dataArr['title_photo'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['title_photo'])) {
    
                            foreach (JSON::decode($dataArr['title_photo']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) {
						            $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path);
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path); ?>

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
                <label>Texte court :</label>
                <div class="summernote"><?= isset($dataArr['content']) ? $dataArr['content'] : '' ?></div>
            </div>
            <div class="form-group">
                <label class="mb-0">Miniature - Média : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>
                <span class="form-text text-muted mt-0">1 photo/vidéo maxi</span>
                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="photo_thumb" value="<?= isset($dataArr['photo_thumb']) ? $dataArr['photo_thumb'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5" data-draggable-max="1">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['photo_thumb']) && $dataArr['photo_thumb'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['photo_thumb'])) {
    
                            foreach (JSON::decode($dataArr['photo_thumb']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) {
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path);
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path); ?>

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
                <label class="mb-0">Média : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>
                <span class="form-text text-muted mt-0">1 photo/vidéo maxi</span>
                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="photo" value="<?= isset($dataArr['photo']) ? $dataArr['photo'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5" data-draggable-max="1">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['photo']) && $dataArr['photo'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['photo'])) {
    
                            foreach (JSON::decode($dataArr['photo']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) {
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path);
                                    $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path); ?>

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
                <label class="mb-0">Illustration facultative : 
                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                        <i class="flaticon-attachment"></i>
                        <span class="pulse-ring"></span>
                    </a>
                </label>
                <span class="form-text text-muted mt-0">1 photo maxi</span>
                <div class="mt-3 text-center card-body rounded border-light-dark p-0 content-media">
                    <input type="hidden" name="illustration" value="<?= isset($dataArr['illustration']) ? $dataArr['illustration'] : '[]' ?>">
                    <div class="row draggable-zone draggable-max p-5" data-draggable-max="1">
                        <p class="content-photo-msg m-5 text-center" <?= isset($dataArr['illustration']) && $dataArr['illustration'] != '[]' ? 'style="display: none"' : '' ?>>Glisser-déposer une photo provenant de la bibliothèque</p>

                        <?php
                        if (isset($dataArr['illustration'])) {
    
                            foreach (JSON::decode($dataArr['illustration']) as $photoId) {
                                $photo = Media::findOne($photoId);
                                if (null !== $photo) {
						            $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$photo->path); ?>

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
                <label>Couleur de fond :</label>
                <input type="text" class="form-control" placeholder="#f5d876" name="color" value="<?= isset($dataArr['color']) ? $dataArr['color'] : '' ?>" />
            </div>
            <div class="form-group">
                <label>Alignement :</label>
                <select class="form-control" name="alignment">
                    <option label="Label"></option>
                    <option value="left" <?= isset($dataArr['alignment']) && 'left' == $dataArr['alignment'] ? 'selected="selected"' : '' ?>>Gauche</option>
                    <option value="right" <?= isset($dataArr['alignment']) && 'right' == $dataArr['alignment'] ? 'selected="selected"' : '' ?>>Droite</option>
                </select>
            </div>
        </div>
    </div>