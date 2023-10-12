<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label class="option <?= $model->status < 10 ? 'border-primary' : '' ?>">
                                                            <span class="option-control">
                                                                <span class="radio">
                                                                    <?= $form->field($model, 'status', [
                                                                            'options' => ['tag' => false],
                                                                            'errorOptions' => ['tag' => null],
                                                                        ])
                                                                        ->radio([
                                                                            'template' => '{input}', 
                                                                            'value' => 9, 
                                                                            'uncheck' => null,
                                                                            'checked' => $model->status < 10 ? 'checked' : false,
                                                                        ])
                                                                        ->label(false); ?>
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="option-label">
                                                                <span class="option-head">
                                                                    <span class="option-title">Désactivé</span>
                                                                    <span class="option-focus"></span>
                                                                    <?= $model->status < 10 ? '<span class="option-focus"><i class="nav-icon fas fa-check text-primary"></i></span>' : '<span class="option-focus"></span>' ?>
                                                                </span>
                                                                <span class="option-body">L'utilisateur est désactivé et <strong>ne peut plus accéder au back-office</strong></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="option <?= $model->status == 10 ? 'border-primary' : '' ?>">
                                                            <span class="option-control">
                                                                <span class="radio">
                                                                    <?= $form->field($model, 'status', [
                                                                            'options' => ['tag' => false],
                                                                            'errorOptions' => ['tag' => null],
                                                                        ])
                                                                        ->radio([
                                                                            'template' => '{input}', 
                                                                            'value' => 10, 
                                                                            'uncheck' => null,
                                                                            'checked' => $model->status == 10 ? 'checked' : false,
                                                                        ])
                                                                        ->label(false); ?>
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="option-label">
                                                                <span class="option-head">
                                                                    <span class="option-title">Activé</span>
                                                                    <span class="option-focus"></span>
                                                                    <?= $model->status == 10 ? '<span class="option-focus"><i class="nav-icon fas fa-check text-primary"></i></span>' : '<span class="option-focus"></span>' ?>
                                                                </span>
                                                                <span class="option-body">L'utilisateur est actif et <strong>peut se connecter au back-office</strong></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group p-5 bg-light-secondary">
                                                <label>Rôle :</label>
                                                <?php
                                                $roles = array_replace([''=>''], MainHelper::getRoles()); ?>

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