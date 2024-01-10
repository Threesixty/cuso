<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use backend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($model->title, 'Ajouter une option', true);

#MainHelper::pp($cms);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Form-->
        <?php $form = ActiveForm::begin(['id' => 'form-edit-option']); ?>

            <?= $form->field($model, 'lang', [
                    'options' => ['tag' => false], 
                    'errorOptions' => ['tag' => null],
                ])
                ->hiddenInput([
                    'value' => !empty(Yii::$app->request->get('id')) ? $model->lang : 'fr'
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
                            <h5 class="text-white font-weight-bold my-1 mr-5"><?= MainHelper::getPageTitle($model->title, 'Ajouter une option') ?></h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                    <!--end::Info-->
                    <div class="card-toolbar">
                        <a href="<?= Url::to(['site/option']) ?>" class="btn btn-light-dark font-weight-bolder mr-2">
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
                                    <!--div class="card-toolbar">
                                        <div class="btn-group" role="group">
                                            <a href="<?= Url::to(['site/edit-option', 'id' => Yii::$app->request->get('id')]) ?>" class="btn btn-success <?= !Yii::$app->request->get('lang') ? 'active' : '' ?>">Français</a>
                                            <?php
                                            if (!empty(Yii::$app->request->get('id'))) { ?>
                                                <a href="<?= Url::to(['site/edit-option', 'id' => Yii::$app->request->get('id'), 'lang' => 'en']) ?>" class="btn btn-success <?= Yii::$app->request->get('lang') == 'en' ? 'active' : '' ?>">Anglais</a>
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
                                                        'placeholder' => "Titre de l'option",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                            <div class="form-group">
                                                <label>Nom :</label>
                                                <?= $form->field($model, 'name')
                                                    ->textInput([
                                                        'class' => 'form-control', 
                                                        'placeholder' => "Identifiant unique de l'option",
                                                    ])
                                                    ->label(false) ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Description :</label>
                                                <?= $form->field($model, 'description')
                                                    ->textarea([
                                                        'rows' => '3', 
                                                        'class' => 'form-control textarea-autosize', 
                                                        'placeholder' => "Description de l'option"
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
                                    <h3 class="card-title text-uppercase w-100 mb-0">Configuration de l'option</h3>

                                    <div class="alert alert-custom alert-light-primary fade show mt-3 mb-5" role="alert">
                                        <div class="alert-icon">
                                            <i class="flaticon-warning"></i>
                                        </div>
                                        <div class="alert-text">Modifier la structure d'une option peut provoquer un dysfonctionnement des contenus qui l'utilise !</div>
                                        <div class="alert-close">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">
                                                    <i class="ki ki-close"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?= $form->field($model, 'options', [
                                                    'options' => ['tag' => false], 
                                                    'errorOptions' => ['tag' => null],
                                                ])
                                                ->hiddenInput([
                                                    'value' => null != $model->options ? $model->options : '[]'
                                                ])
                                                ->label(false) ?>
                                            <div class="tree-variation" data-name="Option"></div>
                                            <div class="row ">
                                                <div class="col-lg-6" style="white-space: pre-wrap;"><code id="code"></code></div>
                                                <div class="col-lg-6" style="white-space: pre-wrap;"><code id="code2"></code></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 variation-container">
                                            <?= $form->field($model, 'optionsContents', [
                                                    'options' => ['tag' => false], 
                                                    'errorOptions' => ['tag' => null],
                                                ])
                                                ->hiddenInput([
                                                    'value' => null != $model->optionsContents ? $model->optionsContents : '[]'
                                                ])
                                                ->label(false) ?>
                                            <div class="variation-item blockui_card d-none">
                                                <h3 class="display-4 p-5 mb-0 bg-light-secondary">
                                                    <span>Option</span>
                                                    <button type="button" class="btn btn-success float-right save-variation-content">Enregistrer</button>
                                                </h3>
                                                <div class="form-group p-5 mb-0 bg-light-secondary">
                                                    <label>Valeur :</label>
                                                    <input type="text" class="form-control" placeholder="Valeur de l'option" name="option_value" />
                                                </div>
                                            </div>
                                            <?php
                                            if (null !== JSON::decode($model->optionsContents)) {
                                                foreach (JSON::decode($model->optionsContents) as $key => $value) { ?>

                                                    <div class="bg-light-secondary variation-item blockui_card variation-<?= $value['id'] ?>" data-id="<?= $value['id'] ?>" data-name="<?= $value['name'] ?>" style="display:none">
                                                        <h3 class="display-4 p-5 mb-0">
                                                            <span><?= $value['name'] ?></span>
                                                            <button type="button" class="btn btn-success float-right save-variation-content">Enregistrer l'attribut</button>
                                                        </h3>
                                                        <?php
                                                        foreach ($value['content'] as $content) {
                                                            switch ($content['slug']) {
                                                                case 'option_value': ?>
                                                                    <div class="form-group p-5 mb-0">
                                                                        <label>Valeur :</label>
                                                                        <input type="text" class="form-control" placeholder="Valeur de l'option" name="option_value" value="<?= $content['value'] ?>" />
                                                                    </div>
                                                                    <?php
                                                                    break;
                                                                
                                                                default:
                                                                    break;
                                                            }
                                                        } ?>
                                                    </div>

                                                <?php }
                                            } ?>
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
                        <a href="<?= Url::to([('site/option')]) ?>" class="btn btn-secondary">Annuler</a>
                        <?= Html::submitButton('Enregistrer l‘option', [
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