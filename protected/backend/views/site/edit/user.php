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

$this->title = MainHelper::getPageTitle($model->username, 'Ajouter un utilisateur', true);

#MainHelper::pp($cms);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Form-->
        <?php $form = ActiveForm::begin(['id' => 'form-edit-user']); ?>

            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6 subheader-transparent bg-primary" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-white font-weight-bold my-1 mr-5"><?= MainHelper::getPageTitle($model->username, 'Ajouter un utilisateur') ?></h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <div class="card-toolbar">
                        <a href="<?= Url::to(['site/user']) ?>" class="btn btn-light-dark font-weight-bolder mr-2">
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
                                                <label>Société :</label>
                                                <?php
                                                $companies = array_replace([''=>''], User::getRoles()); ?>

                                                <?= $form->field($model, 'companyId')
                                                    ->dropDownList(
                                                        $companies, 
                                                        [
                                                            'class' => 'form-control select2',
                                                            'data-placeholder' => 'Sélectionnez une société',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Civilité :</label>
                                                <?php
                                                $genders = [''=>'', 'Mr' => 'Mr', 'Mme' => 'Mme']; ?>

                                                <?= $form->field($model, 'gender')
                                                    ->dropDownList(
                                                        $genders, 
                                                        [
                                                            'class' => 'form-control select2',
                                                            'data-placeholder' => 'Sélectionnez une civilité',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Nom :</label>
                                                <?= $form->field($model, 'lastname')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Nom",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Prénom :</label>
                                                <?= $form->field($model, 'firstname')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Prénom",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Email :</label>
                                                <?= $form->field($model, 'email')
                                                    ->textInput([
                                                        'type' => 'email',
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Nom",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Mot de passe :</label>
                                                <?= $form->field($model, 'password')
                                                    ->textInput([
                                                        'type' => 'password',
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Mot de passe",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Téléphone fixe :</label>
                                                <?= $form->field($model, 'phone')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Téléphone",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Téléphone mobile :</label>
                                                <?= $form->field($model, 'mobile')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Mobile",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-0">Photo de profil : 
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
                                            <div class="form-group p-5 m-0 bg-light-secondary">
                                                <label>Statut :</label>
                                                <?php
                                                $status = array_replace([''=>''], User::getUserStatusName()); ?>

                                                <?= $form->field($model, 'status')
                                                    ->dropDownList(
                                                        $status, 
                                                        [
                                                            'class' => 'form-control select2',
                                                            'data-placeholder' => 'Sélectionnez un role',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group p-5 bg-light-secondary">
                                                <label>Rôle :</label>
                                                <?php
                                                $roles = array_replace([''=>''], User::getRoles()); ?>

                                                <?= $form->field($model, 'role')
                                                    ->dropDownList(
                                                        $roles, 
                                                        [
                                                            'class' => 'form-control select2',
                                                            'data-placeholder' => 'Sélectionnez un role',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Périmètre décisionnel :</label>
                                                <?php
                                                $decisionScopes = array_replace([''=>''], User::getRoles()); ?>

                                                <?= $form->field($model, 'decisionScope')
                                                    ->dropDownList(
                                                        $decisionScopes, 
                                                        [
                                                            'class' => 'form-control select2',
                                                            'data-placeholder' => 'Sélectionnez un périmètre',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Département / Service :</label>
                                                <?php
                                                $departments = array_replace([''=>''], User::getRoles()); ?>

                                                <?= $form->field($model, 'department')
                                                    ->dropDownList(
                                                        $departments, 
                                                        [
                                                            'class' => 'form-control select2',
                                                            'data-placeholder' => 'Sélectionnez une département',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Fonction :</label>
                                                <?= $form->field($model, 'function')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Fonction",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Centres d'intérêts :</label>
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
                                                <label>Produits utilisés :</label>
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
                                                <label>Communautés :</label>
                                                <?php 
                                                $tplCommunities = Option::getOption('name', 'communities', 'select', true);
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
                                            <div class="form-group">
                                                <label>Intervenant ?</label>
                                                <span class="switch switch-outline switch-icon switch-success">
                                                    <label>

                                                        <?= $form->field($model, 'isSpeaker', [
                                                                'options' => ['tag' => false], 
                                                                'errorOptions' => ['tag' => null],
                                                            ])
                                                            ->checkbox([
                                                                    'template' => '{input}<span></span>',
                                                                    'checked' => $model->isSpeaker == 1 ? true : false,
                                                            ])
                                                            ->label(false) ?>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
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
                        <a href="<?= Url::to([('site/user')]) ?>" class="btn btn-secondary">Annuler</a>
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