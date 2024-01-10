<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\models\Option;
use common\models\User;
use backend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($model->name, 'Ajouter une société', true);

#MainHelper::pp($cms);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Form-->
        <?php $form = ActiveForm::begin(['id' => 'form-edit-company']); ?>

            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6 subheader-transparent bg-primary" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-white font-weight-bold my-1 mr-5"><?= MainHelper::getPageTitle($model->name, 'Ajouter une société') ?></h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <div class="card-toolbar">
                        <a href="<?= Url::to(['site/company']) ?>" class="btn btn-light-dark font-weight-bolder mr-2">
                        	<i class="ki ki-long-arrow-back icon-xs"></i>Retour
                        </a>
                        <div class="btn-group">
                            <?= Html::submitButton('Enregistrer', [
                                        'class' => 'btn btn-light-primary border-light-primary font-weight-bolder', 
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
                                                'class' => 'nav-link', 
                                                'name' => 'main-submit', 
                                                'value' => 'stay',
                                            ]) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        $btnText = '<i class="nav-icon flaticon2-add-1"></i>
                                            <span class="nav-text">Enregistrer et créer un autre</span>'; ?>
                                        <?= Html::submitButton($btnText, [
                                                'class' => 'nav-link', 
                                                'name' => 'main-submit', 
                                                'value' => 'new',
                                            ]) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                        $btnText = '<i class="nav-icon flaticon2-reply-1"></i>
                                            <span class="nav-text">Enregistrer et quitter</span>'; ?>
                                        <?= Html::submitButton($btnText, [
                                                'class' => 'nav-link', 
                                                'name' => 'main-submit', 
                                                'value' => 'quit',
                                            ]) ?>
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
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nom :</label>
                                                <?= $form->field($model, 'name')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Nom",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-0">Logo : 
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
                                            <div class="form-group p-5 mb-0 bg-light-secondary">
                                                <label>Adresse :</label>
                                                <?= $form->field($model, 'addressLine1')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Ligne 1",
                                                    ])
                                                    ->label(false) ?>
                                                <?= $form->field($model, 'addressLine2')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Ligne 2",
                                                    ])
                                                    ->label(false) ?>
                                                <?= $form->field($model, 'postalCode')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Code postal",
                                                    ])
                                                    ->label(false) ?>
                                                <?= $form->field($model, 'city')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Ville",
                                                    ])
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
                                                                    <span class="option-title">Inactive</span>
                                                                    <span class="option-focus"></span>
                                                                    <?= $model->status == 0 ? '<span class="option-focus"><i class="nav-icon fas fa-check text-primary"></i></span>' : '<span class="option-focus"></span>' ?>
                                                                </span>
                                                                <span class="option-body">La société est désactivé, <strong>ses membres n'ont plus accès au portail</strong></span>
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
                                                                    <span class="option-title">Active</span>
                                                                    <span class="option-focus"></span>
                                                                    <?= $model->status == 1 ? '<span class="option-focus"><i class="nav-icon fas fa-check text-primary"></i></span>' : '<span class="option-focus"></span>' ?>
                                                                </span>
                                                                <span class="option-body">La société est activée, <strong>ses membres peuvent accéder librement au portail</strong></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Secteur d'activité :</label>
                                                <?php 
                                                $tplActivityAreas = Option::getOption('name', 'activity-areas', 'select');
                                                $activityAreas = array_replace(array(''=>''), $tplActivityAreas); ?>

                                                <?= $form->field($model, 'activityArea')
                                                    ->dropDownList(
                                                        $activityAreas, 
                                                        [
                                                            'class' => 'form-control select2-tags',
                                                            'data-placeholder' => "Sélectionnez un secteur",
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Taille :</label>
                                                <?php 
                                                $sizes = array_replace(array(''=>''), [
                                                        '- de 1000 salariés' => '- de 1000 salariés',
                                                        '+ de 1000 salariés' => '+ de 1000 salariés'
                                                    ]); ?>

                                                <?= $form->field($model, 'size')
                                                    ->dropDownList(
                                                        $sizes, 
                                                        [
                                                            'class' => 'form-control select2-tags',
                                                            'data-placeholder' => "Sélectionnez la taille de l'entreprise"
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Secteur public ?</label>
                                                        <span class="switch switch-outline switch-icon switch-success">
                                                            <label>

                                                                <?= $form->field($model, 'public', [
                                                                        'options' => ['tag' => false], 
                                                                        'errorOptions' => ['tag' => null],
                                                                    ])
                                                                    ->checkbox([
                                                                            'template' => '{input}<span></span>',
                                                                            'checked' => $model->public == 1 ? true : false,
                                                                    ])
                                                                    ->label(false) ?>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="col">
                                                        <label>Sponsor ?</label>
                                                        <span class="switch switch-outline switch-icon switch-success">
                                                            <label>

                                                                <?= $form->field($model, 'isSponsor', [
                                                                        'options' => ['tag' => false], 
                                                                        'errorOptions' => ['tag' => null],
                                                                    ])
                                                                    ->checkbox([
                                                                            'template' => '{input}<span></span>',
                                                                            'checked' => $model->isSponsor == 1 ? true : false,
                                                                    ])
                                                                    ->label(false) ?>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nombre de licences :</label>
                                                <?= $form->field($model, 'licensesCount')
                                                    ->textInput([
                                                        'type' => 'number',
                                                        'class' => 'form-control', 
                                                        'placeholder' => "1",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Date de fin d'adhésion :</label>
                                                <?= $form->field($model, 'membershipEnd', [
                                                        'options' => ['class' => 'input-group date dt-start'],
                                                        'template' => '
                                                            <div class="input-group date dt-start" id="pickerStart" data-target-input="nearest">
                                                                {input}
                                                                <div class="input-group-append" data-target="#pickerStart" data-toggle="datetimepicker">
                                                                    <span class="input-group-text">
                                                                        <i class="ki ki-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            {hint}
                                                            {error}'
                                                    ])
                                                    ->textInput([
                                                        'id' => 'pickerStart',
                                                        'class' => 'form-control datetimepicker-input', 
                                                        'placeholder' => "Date de fin d'adhésion",
                                                        'data-target' => '#pickerStart',
                                                    ])
                                                    ->label(false) ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->

                            <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="accordionCompanyContacts">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b example example-compact">
                                    <div class="card-header" id="headingCompanyContacts">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseCompanyContacts">
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
                                            <div class="card-label text-uppercase pl-4">Contacts principal et facturation</div>
                                        </div>
                                    </div>
                                    <div id="collapseCompanyContacts" class="collapse" data-parent="#accordionCompanyContacts">
                                        <div class="card-body mt-10">
                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <h4 class="card-title">Contact principal</h4>
                                                    <div class="form-group">
                                                        <label>Nom :</label>
                                                        <?= $form->field($model, 'mainContactName')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Nom",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email :</label>
                                                        <?= $form->field($model, 'mainContactEmail')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Email",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Téléphone :</label>
                                                        <?= $form->field($model, 'mainContactPhone')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Téléphone",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <h4 class="card-title">Contact facturation</h4>
                                                    <div class="form-group">
                                                        <label>Nom :</label>
                                                        <?= $form->field($model, 'billingContactName')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Nom",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email :</label>
                                                        <?= $form->field($model, 'billingContactEmail')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Email",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Téléphone :</label>
                                                        <?= $form->field($model, 'billingContactPhone')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Téléphone",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Plateforme de facturation :</label>
                                                        <?= $form->field($model, 'billingPlatform')
                                                            ->textInput([
                                                                'class' => 'form-control', 
                                                                'placeholder' => "Plateforme",
                                                            ])
                                                            ->label(false) ?>
                                                    </div>
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
                        <a href="<?= Url::to([('site/company')]) ?>" class="btn btn-secondary">Annuler</a>
                        <?= Html::submitButton('Enregistrer l‘utilisateur', [
                                    'class' => 'btn btn-success ml-3', 
                                    'name' => 'main-submit',
                                    'value' => 'stay',
                                ]) ?>
                    </div>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
        <!--end::Form-->
    </div>
    <!--end::Content-->