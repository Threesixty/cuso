<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\models\Option;
use common\models\User;
use common\models\Company;
use backend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($model->title, 'Ajouter un événement', true);

#MainHelper::pp($event);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Form-->
        <?php $form = ActiveForm::begin(['id' => 'form-edit-event']); ?>

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
                    'value' => 'event'
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
                            <h5 class="text-white font-weight-bold my-1 mr-5"><?= MainHelper::getPageTitle($model->title, 'Ajouter un événement') ?></h5>

                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <div class="card-toolbar">
                        <a href="<?= Url::to(['site/event']) ?>" class="btn btn-light-dark font-weight-bolder mr-2">
                            <i class="ki ki-long-arrow-back icon-xs"></i>Retour
                        </a>
                        <div class="btn-group">
                            <?= Html::submitButton('Enregistrer', [
                                        'class' => 'btn btn-success border-success font-weight-bolder update-composer', 
                                        'name' => 'main-submit',
                                        'value' => 'stay',
                                    ]) ?>

                            <button type="button" class="btn btn-success border-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
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
                                    <li class="nav-item" data-toggle="<?= !empty(Yii::$app->request->get('id')) ? '' : 'popover' ?>" title="Prévisualisation" data-html="true" data-content="Enregistrer l'événement une première fois avant de pouvoir le prévisualiser">
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
                                            <a href="<?= Url::to(['site/edit-event', 'id' => Yii::$app->request->get('id')]) ?>" class="btn btn-success <?= !Yii::$app->request->get('lang') ? 'active' : '' ?>">Français</a>
                                            <?php
                                            if (!empty(Yii::$app->request->get('id'))) { ?>
                                                <a href="<?= Url::to(['site/edit-event', 'id' => Yii::$app->request->get('id'), 'lang' => 'en']) ?>" class="btn btn-success <?= Yii::$app->request->get('lang') == 'en' ? 'active' : '' ?>">Anglais</a>
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
                                                        'placeholder' => "Titre de l'événement",
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
                                                            'placeholder' => "Url de l'événement",
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
                                                <label>Extrait :</label>
                                                <?= $form->field($model, 'summary')
                                                    ->textarea([
                                                        'rows' => '3', 
                                                        'class' => 'form-control textarea-autosize', 
                                                        'placeholder' => "Extrait de l'événement"
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
                                                                <span class="option-body">L'événement est un brouillon et <strong>visible par les administrateurs uniquement</strong></span>
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
                                                                <span class="option-body">L'événement est publié et <strong>visible par tout le monde</strong></span>
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
                                                        <span class="form-text text-muted">Si vide, événement sans date de péremption</span>
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

                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionEventDetails">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header" id="headingEventDetails">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEventDetails">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-uppercase pl-4">Détails de l'événement</div>
                                        </div>
                                    </div>
                                    <div id="collapseEventDetails" class="collapse" data-parent="#accordionEventDetails">
                                        <div class="card-body mt-10">
                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Type d'événement :</label>
                                                        <?php 
                                                        $tplOption = Option::getOption('name', 'event-types', 'select');
                                                        $tpl = array_replace(array(''=>''), $tplOption); ?>

                                                        <?= $form->field($model, 'eventType', ['options' => ['tag' => false]])
                                                            ->dropDownList(
                                                                $tpl, 
                                                                [
                                                                    'template' => '{input}', 
                                                                    'class' => 'form-control select2',  
                                                                    'data-placeholder' => 'Sélectionnez une catégorie',
                                                                ]
                                                            )
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Sujets abordés :</label>
                                                        <?php 
                                                        $interests = Option::getOption('name', 'interests', 'select'); ?>

                                                        <?= $form->field($model, 'interests')
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
                                                        $products = Option::getOption('name', 'products', 'select', true); ?>

                                                        <?= $form->field($model, 'products')
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
                                                        $communities = Option::getOption('name', 'communities', 'select', true); ?>

                                                        <?= $form->field($model, 'communities')
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
                                                    <div class="form-group">
                                                        <label>Intervenants :</label>
                                                        <?php 
                                                        $userSpeakers = User::getSpeakers();
                                                        foreach ($userSpeakers as $speaker) {
                                                            $userCompany = Company::findOne($speaker->id);
                                                            $userCompanyText = null !== $userCompany ? strtoupper($userCompany->name) : '';
                                                            $speakers[$speaker->id] = $speaker->firstname.' '.$speaker->lastname.' | '.$userCompanyText;
                                                        } ?>

                                                        <?= $form->field($model, 'speakers')
                                                            ->dropDownList(
                                                                $speakers, 
                                                                [
                                                                    'class' => 'form-control select2-tags',
                                                                    'data-placeholder' => 'Sélectionnez des intervenants',
                                                                    'multiple' => true,
                                                                ]
                                                            )
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6">
                                                            <label>Ouvert aux prospects ?</label>
                                                            <span class="switch switch-outline switch-icon switch-success">
                                                                <label>

                                                                    <?= $form->field($model, 'prospect', [
                                                                            'options' => ['tag' => false], 
                                                                            'errorOptions' => ['tag' => null],
                                                                        ])
                                                                        ->checkbox([
                                                                                'template' => '{input}<span></span>',
                                                                                'checked' => $model->prospect == 1 ? true : false,
                                                                        ])
                                                                        ->label(false) ?>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label>Ouvert à l'inscription ?</label>
                                                            <span class="switch switch-outline switch-icon switch-success">
                                                                <label>

                                                                    <?= $form->field($model, 'registerable', [
                                                                            'options' => ['tag' => false], 
                                                                            'errorOptions' => ['tag' => null],
                                                                        ])
                                                                        ->checkbox([
                                                                                'template' => '{input}<span></span>',
                                                                                'checked' => $model->registerable == 1 ? true : false,
                                                                        ])
                                                                        ->label(false) ?>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Dates de l'événement :</label>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="input-group date dt-event-start" id="pickerEventStart" data-target-input="nearest">
                                                                    <?= $form->field($model, 'startDatetime', [
                                                                            'options' => ['tag' => false],
                                                                        ])
                                                                        ->textInput([
                                                                            'id' => 'pickerEventStart',
                                                                            'class' => 'form-control datetimepicker-input', 
                                                                            'placeholder' => "Date de début",
                                                                            'data-target' => '#pickerEventStart',
                                                                        ])
                                                                        ->label(false) ?>
                                                                    <div class="input-group-append" data-target="#pickerEventStart" data-toggle="datetimepicker">
                                                                        <span class="input-group-text">
                                                                            <i class="ki ki-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group date dt-event-end" id="pickerEventEnd" data-target-input="nearest">
                                                                    <?= $form->field($model, 'endDatetime', [
                                                                            'options' => ['tag' => false],
                                                                        ])
                                                                        ->textInput([
                                                                            'id' => 'pickerEventEnd',
                                                                            'class' => 'form-control datetimepicker-input', 
                                                                            'placeholder' => "Date de fin",
                                                                            'data-target' => '#pickerEventEnd',
                                                                        ])
                                                                        ->label(false) ?>
                                                                    <div class="input-group-append" data-target="#pickerEventEnd" data-toggle="datetimepicker">
                                                                        <span class="input-group-text">
                                                                            <i class="ki ki-calendar"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adresse :</label>
                                                        <?= $form->field($model, 'address')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Adresse de l'événement",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group init-summernote">
                                                        <label>Accès :</label>
                                                        <?= $form->field($model, 'addressDetail')
                                                            ->textarea([
                                                                'class' => 'summernote',
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionEventProgam">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header" id="headingEventProgam">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEventProgam">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-uppercase pl-4">Programme, synthèse & documents</div>
                                        </div>
                                    </div>
                                    <div id="collapseEventProgam" class="collapse" data-parent="#accordionEventProgam">
                                        <div class="card-body mt-10">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group init-summernote">
                                                        <label>Programme :</label>
                                                        <?= $form->field($model, 'program')
                                                            ->textarea([
                                                                'class' => 'summernote',
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group init-summernote">
                                                        <label>Synthèse :</label>
                                                        <?= $form->field($model, 'synthesis')
                                                            ->textarea([
                                                                'class' => 'summernote',
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="mb-0">Documents : 
                                                            <a href="javascript:;" class="btn btn-icon btn-light-success btn-circle btn-md pulse pulse-success mr-4 show-media">
                                                                <i class="flaticon-attachment"></i>
                                                                <span class="pulse-ring"></span>
                                                            </a>
                                                        </label>
                                                        <div class="mt-3 text-center card-body bg-white rounded p-0 content-media">
                                                            <?= $form->field($model, 'documents', [
                                                                    'options' => ['tag' => false], 
                                                                    'errorOptions' => ['tag' => null],
                                                                ])
                                                                ->hiddenInput()
                                                                ->label(false) ?>

                                                            <?php
                                                            $docsArr = JSON::decode($model->documents); ?>

                                                            <div class="row draggable-zone draggable-full p-5">
                                                                <p class="content-photo-msg m-5 text-center" <?= !empty($docsArr) ? 'style="display: none"' : '' ?>>Glisser-déposer un document provenant de la bibliothèque</p>

                                                                <?php
                                                                if (null !== $docsArr) {
                                                                    foreach ($docsArr as $docId) {
                                                                        $doc = Media::findOne($docId);
                                                                        if (null !== $doc) {
                                                        					$pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$doc->path); ?>

                                                                            <div class="col-md-6 mt-3 mb-3 draggable" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $doc->title ?>" data-id="<?= $doc->id ?>" tabindex="-1" style="">
                                                                                <div class="action-btn">
                                                                                    <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="<?= $doc->id ?>">
                                                                                        <i class="flaticon2-trash"></i>
                                                                                    </a>
                                                                                    <a href="javascript:;" class="btn btn-icon btn-primary btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="<?= Yii::getAlias('@uploadWeb').'/'.$doc->path ?>" data-media-id="<?= $doc->id ?>" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
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
					                                                                        <img src="<?= Yii::getAlias('@uploadWeb').'/'.$doc->path ?>">
					                                                                        <?php break;

					                                                                    case 'mp4': ?>
					                                                                        <video class="rounded" controls="">
					                                                                            <source src="<?= Yii::getAlias('@uploadWeb').'/'.$doc->path ?>">
					                                                                        </video>
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
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card-->
                            </div>

                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionComposer">

                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header" id="headingComposer">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseComposer">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-uppercase pl-4">Composition des contenus</div>
                                        </div>
                                    </div>

                                    <div id="collapseComposer" class="collapse" data-parent="#accordionComposer">
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
                                </div>
                                <!--end::Card-->
                            </div>

                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionEventParticipants">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header" id="headingEventParticipants">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEventParticipants">
                                            <span class="svg-icon svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <div class="card-label text-uppercase pl-4">Participants</div>
                                        </div>
                                    </div>
                                    <div id="collapseEventParticipants" class="collapse" data-parent="#accordionEventParticipants">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <label>Ajouter des participants :</label>
                                                </div>   
                                                <div class="col-lg-6">                                                    
                                                    <div class="form-group">
                                                        <?php 
                                                        $userList = User::getActiveUsers();
                                                        foreach ($userList as $user) {
                                                            $userCompany = Company::findOne($user->id);
                                                            $userCompanyText = null !== $userCompany ? strtoupper($userCompany->name) : '';
                                                            $users[$user->id] = $user->firstname.' '.$user->lastname.' | '.$userCompanyText;
                                                        } ?>

                                                        <?= Html::dropDownlist('addParticipants', null, $users, [
                                                                    'class' => 'form-control select2-tags',
                                                                    'data-placeholder' => 'Sélectionnez des participants',
                                                                    'multiple' => true,
                                                                ]); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <?= Html::submitButton("Ajouter", [
                                                                'class' => 'btn btn-success', 
                                                                'name' => 'participants-submit',
                                                                'value' => 'participants',
                                                            ]) ?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <hr>
                                                </div>   

                                                <div class="card-body">
                                                    <!--begin: Datatable-->
                                                    <table class="table table-separate table-head-custom table-checkable" id="datatableUser">
                                                        <thead>
                                                            <tr>
                                                                <th width="50">#ID</th>
                                                                <th>Nom</th>
                                                                <th>Société</th>
                                                                <th>Role</th>
                                                                <th>Status</th>
                                                                <th class="text-center">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($eventParticipantList)) {
                                                                foreach ($eventParticipantList as $user) {
                                                                    if (Yii::$app->user->identity->role >= $user->role) { ?>

                                                                        <tr>
                                                                            <td><?= $user->id ?></td>
                                                                            <td class="h6"><a href="<?= Url::to(['site/edit-user', 'id' => $user->id]) ?>"><strong><?= ucfirst($user->firstname) ?> <?= mb_strtoupper($user->lastname) ?></strong></a></td>
                                                                            <td>
                                                                                <?php 
                                                                                if (null !== $userCompany) { ?>
                                                                                    <a class="btn-link" href="<?= Url::to(['site/edit-company', 'id' => $userCompany->id]) ?>"><?= strtoupper($userCompany->name) ?></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td><span class="font-weight-bold text-uppercase"><?= User::getRoles($user->role) ?></span></td>
                                                                            <td><span class="label label-lg font-weight-bold label-light-<?= User::getUserStatusColor($user->status) ?> label-inline"><?= User::getUserStatusName($user->status) ?></span></td>
                                                                            <td nowrap="nowrap" class="text-center">
                                                                                <a href="<?= Url::to(['site/edit-user', 'id' => $user->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                                                    <i class="la la-edit"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>

                                                                    <?php }
                                                                }
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                    <!--end: Datatable-->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                        <a href="<?= Url::to([('site/event')]) ?>" class="btn btn-secondary">Annuler</a>
                        <?= Html::submitButton("Enregistrer l'événement", [
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