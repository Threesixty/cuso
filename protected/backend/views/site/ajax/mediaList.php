<?php
use yii\helpers\Url;
use common\components\MainHelper; ?>

    <?php
    if (null !== $mediaList) { 
        foreach ($mediaList as $media) {
        	$pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$media->path); ?>

            <div class="<?= $draggable ? 'col-md-6 mt-3 mb-3' : 'col-6 col-sm-3 col-md-2 mt-3 mb-3' ?> draggable media<?= $media->id ?>" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $media->title ?>" data-id="<?= $media->id ?>">
                <div class="action-btn">
                    <a href="" class="btn btn-icon btn-danger btn-circle btn-sm delete-media" data-toggle="modal" data-target="#deleteModal" data-media-id="<?= $media->id ?>">
                        <i class="flaticon2-trash"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="<?= $media->id ?>">
                        <i class="flaticon2-trash"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-primary btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>" data-media-id="<?= $media->id ?>" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
                        <i class="flaticon2-edit"></i>
                    </a>
                </div>
                <div class="overflow-image rounded draggable-handle text-center">
                	<?php
                	switch ($pathInfo['extension']) {
                		case 'jpg':
                		case 'png':
                		case 'gif':
                		case 'svg': ?>
                			<img src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>">
                			<?php break;

                		case 'mp4': ?>
                        	<video class="rounded" muted autoplay>
                        		<source src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>">
                        	</video>
                			<?php break;
                		
                		default: 
                			# code...
                			break;
                	} ?>
                </div>
            </div>
        <?php } 
    } ?>