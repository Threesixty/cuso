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

$this->title = MainHelper::getPageTitle($model->title, 'Ajouter une discussion', true);

#MainHelper::pp($cms);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Form-->
        <?php $form = ActiveForm::begin(['id' => 'form-edit-discussion']); ?>

            <!--begin::Subheader-->
            <div class="subheader py-2 py-lg-6 subheader-transparent bg-primary" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-white font-weight-bold my-1 mr-5"><?= MainHelper::getPageTitle($model->title, 'Ajouter une discussion') ?></h5>

                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <div class="card-toolbar">
                        <a href="<?= Url::to(['site/forum']) ?>" class="btn btn-light-dark font-weight-bolder mr-2">
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
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Titre :</label>
                                                <?= $form->field($model, 'title')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Titre de la discussion",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group init-summernote">
                                                <label>Sujet :</label>
                                                <?= $form->field($model, 'content')
                                                    ->textarea([
                                                        'rows' => '3', 
                                                        'class' => 'form-control summernote', 
                                                        'placeholder' => "Description du contenu"
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
                                                <label>Sujets abordés :</label>
                                                <?php 
                                                $interests = Option::getOption('name', 'interests', 'select', true); ?>

                                                <?= $form->field($model, 'interests')
                                                    ->dropDownList(
                                                        $interests, 
                                                        [
                                                            'class' => 'form-control select2-tags',
                                                            'data-placeholder' => 'Sélectionnez des sujets',
                                                            'multiple' => true,                                                        ]
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
                        <a href="<?= Url::to([('site/cms')]) ?>" class="btn btn-secondary">Annuler</a>
                        <?= Html::submitButton("Enregistrer la discussion", [
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
    <!--end::Content-->