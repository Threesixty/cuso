<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\models\Option;
use backend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($model->title, 'Ajouter une actualité', true);

#MainHelper::pp($cms);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Form-->
        <?php $form = ActiveForm::begin(['id' => 'form-edit-news']); ?>

            <?= $form->field($model, 'lang', [
                    'options' => ['tag' => false], 
                    'errorOptions' => ['tag' => null],
                ])
                ->hiddenInput([
                    'value' => !empty(Yii::$app->request->get('id')) ? $model->lang : 'fr'
                ])
                ->label(false) ?>

            <?= $form->field($model, 'type', [
                    'options' => ['tag' => false], 
                    'errorOptions' => ['tag' => null],
                ])
                ->hiddenInput([
                    'value' => 'news'
                ])
                ->label(false) ?>

            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6 subheader-transparent bg-primary" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-white font-weight-bold my-1 mr-5"><?= MainHelper::getPageTitle($model->title, 'Ajouter une actualité') ?></h5>

                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <div class="card-toolbar">
                        <a href="<?= Url::to(['site/news']) ?>" class="btn btn-light-dark font-weight-bolder mr-2">
                            <i class="ki ki-long-arrow-back icon-xs"></i>Retour
                        </a>
                        <div class="btn-group">
                            <?= Html::submitButton('Enregistrer', [
                                        'class' => 'btn btn-light-primary border-light-primary font-weight-bolder update-composer', 
                                        'name' => 'main-submit',
                                        'value' => 'stay',
                                    ]) ?>

                            <button type="button" class="btn btn-light-primary border-light-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
                                <ul class="nav nav-hover flex-column">
                                    <li class="nav-item">
                                        <?php
                                        $btnText = '<i class="nav-icon flaticon2-reload"></i>
                                            <span class="nav-text">Enregistrer et rester</span>'; ?>
                                        <?= Html::submitButton($btnText, [
                                                'class' => 'nav-link update-composer', 
                                                'name' => 'main-submit', 
                                                'value' => 'stay',
                                            ]) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        $btnText = '<i class="nav-icon flaticon2-add-1"></i>
                                            <span class="nav-text">Enregistrer et créer un autre</span>'; ?>
                                        <?= Html::submitButton($btnText, [
                                                'class' => 'nav-link update-composer', 
                                                'name' => 'main-submit', 
                                                'value' => 'new',
                                            ]) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        $btnText = '<i class="nav-icon flaticon2-reply-1"></i>
                                            <span class="nav-text">Enregistrer et quitter</span>'; ?>
                                        <?= Html::submitButton($btnText, [
                                                'class' => 'nav-link update-composer', 
                                                'name' => 'main-submit', 
                                                'value' => 'quit',
                                            ]) ?>
                                    </li>
                                    <li class="nav-item" data-toggle="<?= !empty(Yii::$app->request->get('id')) ? '' : 'popover' ?>" title="Prévisualisation" data-html="true" data-content="Enregistrer le contenu une première fois avant de pouvoir le prévisualiser">
                                        <a href="#" class="nav-link <?= !empty(Yii::$app->request->get('id')) ? '' : 'disabled' ?>">
                                            <i class="nav-icon flaticon-eye"></i>
                                            <span class="nav-text">Prévisualiser</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b example example-compact">
                                <div class="card-header pl-5">
                                    <h3 class="card-title text-uppercase">Informations générales</h3>
                                    <!--div class="card-toolbar">
                                        <div class="btn-group" role="group">
                                            <a href="<?= Url::to(['site/edit-news', 'id' => Yii::$app->request->get('id')]) ?>" class="btn btn-success <?= !Yii::$app->request->get('lang') ? 'active' : '' ?>">Français</a>
                                            <?php
                                            if (!empty(Yii::$app->request->get('id'))) { ?>
                                                <a href="<?= Url::to(['site/edit-news', 'id' => Yii::$app->request->get('id'), 'lang' => 'en']) ?>" class="btn btn-success <?= Yii::$app->request->get('lang') == 'en' ? 'active' : '' ?>">Anglais</a>
                                            <?php } ?>
                                        </div>
                                    </div-->
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Titre :</label>
                                                <?= $form->field($model, 'title')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Titre du contenu",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <?php
                                            if (!empty(Yii::$app->request->get('id'))) { ?>
                                                <div class="form-group">
                                                    <label>Url :</label>
                                                    <?= $form->field($model, 'url')
                                                        ->textInput([
                                                            'class' => 'form-control', 
                                                            'placeholder' => "Url du contenu",
                                                        ])
                                                        ->label(false) ?>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label>Url de redirection :</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><?= str_replace('backend', '', Url::base(true)) ?><?= !empty(Yii::$app->request->get('id')) ? $model->lang : 'fr' ?>/</span>
                                                    </div>
                                                    <?= $form->field($model, 'urlRedirect', [
                                                            'options' => ['tag' => false],
                                                            'errorOptions' => ['tag' => null],
                                                        ])
                                                        ->textInput([
                                                            'class' => 'form-control',
                                                        ])
                                                        ->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Description :</label>
                                                <?= $form->field($model, 'summary')
                                                    ->textarea([
                                                        'rows' => '3', 
                                                        'class' => 'form-control textarea-autosize', 
                                                        'placeholder' => "Description du contenu"
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-0">Photo principale : 
                                                    <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                                                        <i class="flaticon-attachment"></i>
                                                        <span class="pulse-ring"></span>
                                                    </a>
                                                </label>
                                                <span class="form-text text-muted mt-0">1 photo maxi</span>
                                                <div class="mt-3 text-center card-body bg-white rounded p-0 content-media">
                                                    <?= $form->field($model, 'photoId', [
                                                            'options' => ['tag' => false], 
                                                            'errorOptions' => ['tag' => null],
                                                        ])
                                                        ->hiddenInput()
                                                        ->label(false) ?>

                                                    <?php
                                                    $photoArr = JSON::decode($model->photoId); ?>

                                                    <div class="row draggable-zone draggable-max p-5" data-draggable-max="1">
                                                        <p class="content-photo-msg m-5 text-center" <?= !empty($photoArr) ? 'style="display: none"' : '' ?>>Glisser-déposer une photo provenant de la bibliothèque</p>

                                                        <?php
                                                        if (null !== $photoArr) {
                                                            foreach ($photoArr as $photoId) {
                                                                $photo = Media::findOne($photoId);
                                                                if (null !== $photo) { ?>

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
                                                                            <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>">
                                                                        </div>
                                                                    </div>

                                                                <?php }
                                                            }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sujets abordés :</label>
                                                <?php 
                                                $tplInterests = Option::getOption('name', 'interests', 'select');
                                                $interests = array_replace(array(''=>''), $tplInterests); ?>

                                                <?= $form->field($model, 'interests', ['options' => ['tag' => false]])
                                                    ->dropDownList(
                                                        $interests, 
                                                        [
                                                            'class' => 'form-control select2-tags',
                                                            'data-placeholder' => 'Sélectionnez des sujets',
                                                            'multiple' => true,
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Produits concernés :</label>
                                                <?php 
                                                $tplProducts = Option::getOption('name', 'products', 'select', true);
                                                $products = array_replace(array(''=>''), $tplProducts); ?>

                                                <?= $form->field($model, 'products', ['options' => ['tag' => false]])
                                                    ->dropDownList(
                                                        $products, 
                                                        [
                                                            'class' => 'form-control select2-tags',
                                                            'data-placeholder' => 'Sélectionnez des produits',
                                                            'multiple' => true,
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Communautés concernées :</label>
                                                <?php 
                                                $tplCommunities = Option::getOption('name', 'products', 'select', true);
                                                $communities = array_replace(array(''=>''), $tplCommunities); ?>

                                                <?= $form->field($model, 'communities', ['options' => ['tag' => false]])
                                                    ->dropDownList(
                                                        $communities, 
                                                        [
                                                            'class' => 'form-control select2-tags',
                                                            'data-placeholder' => 'Sélectionnez des communautés',
                                                            'multiple' => true,
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="option <?= $model->status == 0 ? 'border-primary' : '' ?>">
                                                            <span class="option-control">
                                                                <span class="radio">
                                                                    <?= $form->field($model, 'status', [
                                                                            'options' => ['tag' => false],
                                                                            'errorOptions' => ['tag' => null],
                                                                        ])
                                                                        ->radio([
                                                                            'template' => '{input}', 
                                                                            'value' => 0, 
                                                                            'uncheck' => null,
                                                                            'checked' => $model->status == 0 ? 'checked' : false,
                                                                        ])
                                                                        ->label(false); ?>
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="option-label">
                                                                <span class="option-head">
                                                                    <span class="option-title">Brouillon</span>
                                                                    <span class="option-focus"></span>
                                                                    <?= $model->status == 0 ? '<span class="option-focus"><i class="nav-icon fas fa-check text-primary"></i></span>' : '<span class="option-focus"></span>' ?>
                                                                </span>
                                                                <span class="option-body">Le contenu est un brouillon et <strong>visible par les administrateurs uniquement</strong></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="option <?= $model->status == 1 ? 'border-primary' : '' ?>">
                                                            <span class="option-control">
                                                                <span class="radio">
                                                                    <?= $form->field($model, 'status', [
                                                                            'options' => ['tag' => false],
                                                                            'errorOptions' => ['tag' => null],
                                                                        ])
                                                                        ->radio([
                                                                            'template' => '{input}', 
                                                                            'value' => 1, 
                                                                            'uncheck' => null,
                                                                            'checked' => $model->status == 1 ? 'checked' : false,
                                                                        ])
                                                                        ->label(false); ?>
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="option-label">
                                                                <span class="option-head">
                                                                    <span class="option-title">Publié</span>
                                                                    <span class="option-focus"></span>
                                                                    <?= $model->status == 1 ? '<span class="option-focus"><i class="nav-icon fas fa-check text-primary"></i></span>' : '<span class="option-focus"></span>' ?>
                                                                </span>
                                                                <span class="option-body">Le contenu est publié et <strong>visible par tout le monde</strong></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Date de publication :</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="input-group date dt-start" id="pickerStart" data-target-input="nearest">
                                                            <?= $form->field($model, 'startDate', [
                                                                    'options' => ['tag' => false],
                                                                ])
                                                                ->textInput([
                                                                    'id' => 'pickerStart',
                                                                    'class' => 'form-control datetimepicker-input', 
                                                                    'placeholder' => "Date de début",
                                                                    'data-target' => '#pickerStart',
                                                                ])
                                                                ->label(false) ?>
                                                            <div class="input-group-append" data-target="#pickerStart" data-toggle="datetimepicker">
                                                                <span class="input-group-text">
                                                                    <i class="ki ki-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="form-text text-muted">Si vide, date du jour</span>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group date dt-end" id="pickerEnd" data-target-input="nearest">
                                                            <?= $form->field($model, 'endDate', [
                                                                    'options' => ['tag' => false],
                                                                ])
                                                                ->textInput([
                                                                    'id' => 'pickerEnd',
                                                                    'class' => 'form-control datetimepicker-input', 
                                                                    'placeholder' => "Date de fin",
                                                                    'data-target' => '#pickerEnd',
                                                                ])
                                                                ->label(false) ?>
                                                            <div class="input-group-append" data-target="#pickerEnd" data-toggle="datetimepicker">
                                                                <span class="input-group-text">
                                                                    <i class="ki ki-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span class="form-text text-muted">Si vide, contenu sans date de péremption</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group p-5 mb-0 bg-light-secondary">
                                                <label>Meta title :</label>
                                                <?= $form->field($model, 'metaTitle')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Balise meta title",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group p-5 bg-light-secondary">
                                                <label>Meta description :</label>
                                                <?= $form->field($model, 'metaDescription')
                                                    ->textarea([
                                                        'rows' => '3', 
                                                        'class' => 'form-control textarea-autosize', 
                                                        'placeholder' => "Balise meta description"
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="card card-custom gutter-b example example-compact">
                                <div class="card-header pl-5">
                                    <h3 class="card-title text-uppercase">Composition des contenus</h3>
                                </div>

                                <div class="card-body composer">
                                    <div class="row">
                                        <?= $form->field($model, 'content', [
                                                'options' => ['tag' => false], 
                                                'errorOptions' => ['tag' => null],
                                            ])
                                            ->hiddenInput([
                                                'id' => 'contentComposer',
                                            ])
                                            ->label(false) ?>

                                        <?php
                                        $blocks = BlockWidget::getBlocks();
                                        foreach ($blocks as $key => $block) { ?>
                                            <?= BlockWidget::widget(['type' => $key]) ?>
                                        <?php } ?>

                                        <div class="col-lg-12">
                                            <div class="text-center mb-10">
                                                <div class="btn-group">
                                                    <a href="javascript:;" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ajouter un bloc</a>
                                                    <div class="dropdown-menu py-0 add-block main-add" style="">
                                                        <?php
                                                        foreach ($blocks as $key => $block) { ?>
                                                            <!--div class="dropdown-divider"></div-->
                                                            <a class="dropdown-item" href="javascript:;" data-block="block-<?= $key ?>"><?= $block ?></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        $blocks = JSON::decode($model->content);
                                        if (!empty($blocks)) {
                                            foreach ($blocks as $key => $block) {
                                                if (null !== $block) { ?>
                                                    <?= BlockWidget::widget([
                                                            'type' => $block['block'], 
                                                            'value' => is_array($block['value']) ? JSON::encode($block['value']) : $block['value'],
                                                            'show' => true,
                                                            'idx' => $key,
                                                        ]) ?>
                                                <?php }
                                            }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Entry-->

            <div class="subheader py-2 py-lg-6 subheader-transparent bg-primary" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <div></div>
                    <div class="card-toolbar">
                        <a href="<?= Url::to([('site/cms')]) ?>" class="btn btn-secondary">Annuler</a>
                        <?= Html::submitButton('Enregistrer le contenu', [
                                    'class' => 'btn btn-success ml-3 update-composer', 
                                    'name' => 'main-submit',
                                    'value' => 'stay',
                                ]) ?>
                    </div>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
        <!--end::Form-->
    </div>

	<nav class="block-menu">
		<div class="font-size-h1 text-primary font-weight-bold text-uppercase">Blocs</div>
		<div class="separator separator-dashed border-dark my-4"></div>
	    <?php
	    if (!empty(Yii::$app->request->get('id'))) {
	        foreach ($blocks as $key => $block) { ?>
		    	<a href="#" class="font-weight-bolder text-seconday" data-scroll="<?= $block['block'] ?>" data-scroll-idx="<?= $key+1 ?>"><?= str_replace('-', ' ', ucfirst($block['block'])) ?></a>
	        <?php }
		} ?>
	</nav>
    <!--end::Content-->