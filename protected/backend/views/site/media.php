<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des médias', '', true);

#MainHelper::pp($mediaList);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="row">
                    <!--begin::Desktop Search-->
                    <div class="quick-search quick-search-inline flex-grow-1" id="kt_quick_search_inline">
                        <!--begin::Form-->
                        <form method="get" class="quick-search-form">
                            <div class="input-group rounded" style="background-color: #eee;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="svg-icon svg-icon-lg svg-icon-success">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-primary h-40px" placeholder="Rechercher un media..." data-url="<?= Url::to(['site/search-medias']) ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="quick-search-close ki ki-close icon-sm text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Search Toggle-->
                        <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px"></div>
                        <!--end::Search Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-anim-up">
                            <div class="quick-search-wrapper scroll" data-scroll="true" data-height="350" data-mobile-height="200"></div>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Desktop Search-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
						<div id="mediaContent">
	                        <div class="medias-evenodd masonry-layout" data-medialist-url="<?= Url::to(['site/media-list']) ?>" data-offset="<?= count($mediaList) ?>">

	                            <?php
	                            if (null !== $mediaList) { 
	                                foreach ($mediaList as $media) {
						                $pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$media->path); ?>

	                                    <div class="col-6 col-sm-3 col-md-2 mt-3 mb-3 draggable media<?= $media->id ?>" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $media->title ?>" data-id="<?= $media->id ?>">
	                                        <div class="action-btn">
	                                            <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-sm delete-media" data-toggle="modal" data-target="#deleteModal" data-media-id="<?= $media->id ?>">
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
                                                $mimeType = mime_content_type(Yii::getAlias('@uploadFolder').'/'.$media->path);
                                                $type = explode('/', $mimeType);
                                                switch ($type[0]) {
                                                    case 'image': ?>
                                                        <img src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>">
                                                        <?php break;

                                                    case 'video': ?>
                                                        <video class="rounded" muted autoplay>
                                                            <source src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>">
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
	                            } ?>

	                        </div>
	                        <div class="text-center mt-5">
	                        	<div class="spinner spinner-track spinner-success spinner-lg mt-5 text-center d-none"></div>
	                        	<a href="javascript:void(0)" class="btn btn-primary more-medias">Charger plus de médias</a>
	                        </div>
	                    </div>

                        <?= PopinWidget::widget(['name' => 'delete-item', 'type' => 'list']) ?>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->