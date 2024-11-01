<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Option;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($cms->title, '', true); ?>



                <div class="breadcrumb">
                    <div class="container container-fluid">
                        <div class="breadcrumb-link">
                            <a href="#">Accueil</a> -
                            <strong>Inscription</strong>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
                <section class="section i4">
                    <div class="container container-fixed">
                        <div class="section-toolbar">
                            <div class="toolbar i3 navy">
                                <div class="toolbar-item">
                                    <button class="toolbar-button button orange icon-only s1 shadow br-round" type="button">
                                        <svg width="18" height="20">
                                            <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#share"></use>
                                        </svg>
                                    </button>
                                    <div class="toolbar-share">
                                        <ul class="br-a-20">
                                            <li>
                                                <a href="#">
                                                <span>
                                                <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-facebook.svg" alt="" width="16" height="32">
                                                </span>
                                                <em>Partager par Facebook</em>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                <span>
                                                <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-linkedin.svg" alt="" width="32" height="32">
                                                </span>
                                                <em>Partager par Linkedin</em>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                <span>
                                                <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-twitter.svg" alt="" width="40" height="32">
                                                </span>
                                                <em>Partager par Twitter</em>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span>
                                                        <svg width="20" height="16">
                                                            <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#email"></use>
                                                        </svg>
                                                    </span>
                                                    <em>Partager par mail</em>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span>
                                                        <svg width="20" height="10">
                                                            <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#link"></use>
                                                        </svg>
                                                    </span>
                                                    <em>Copier le lien</em>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="toolbar-item">
                                    <button class="toolbar-button button orange icon-only s1 shadow br-round" type="button">
                                        <svg width="20" height="18">
                                            <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#print"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <header class="section-header w-760 mx-auto">
                            <div class="register-header">
                                <h1 class="section-title">
                                    <?= $cms->title ?> 
                                </h1>
                                <span><?= Yii::t('app', "ou") ?></span>
                                <a href="<?= Url::to(['site/content', 'url' => $login->url]) ?>" class="button orange icon-right shadow br-a-20">
                                    <span>Connexion</span>
                                    <svg width="20" height="14">
                                        <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                    </svg>
                                </a>
                            </div>
                        </header>
                        <div class="section-body w-760 mx-auto">                            
                            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

                                <div class="wizard">
                                    <div id="layer1" class="wizard-layer row clearfix active">
                                        <div class="section-summary mt-20">
                                            <h3>1. <?= Yii::t('app', "Informations personnelles") ?></h3>
                                        </div>
                                        <div class="form-grid mt-20">
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'firstname') ?>">Prénom *</label>
                                                    <?= $form->field($model, 'firstname')
                                                        ->textInput([
                                                            'autofocus' => true,
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Prénom")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'lastname') ?>">Nom *</label>
                                                    <?= $form->field($model, 'lastname')
                                                        ->textInput([
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Nom")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-grid mt-20">
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'email') ?>">Email *</label>
                                                    <?= $form->field($model, 'email')
                                                        ->textInput([
                                                            'type' => 'email',
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Email")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'password') ?>">Mot de passe *</label>
                                                    <?= $form->field($model, 'password')
                                                        ->passwordInput([
                                                            'autocomplete' => 'off',
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Mot de passe")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-grid mt-20">
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'phone') ?>">Téléphone **</label>
                                                    <?= $form->field($model, 'phone')
                                                        ->textInput([
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Téléphone")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'mobile') ?>">Mobile **</label>
                                                    <?= $form->field($model, 'mobile')
                                                        ->textInput([
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Mobile")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-grid mt-20">
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'decisionScope') ?>">Périmètre décisionnel *</label>
                                                    <?php
                                                    $decisionScopesList = Option::getOption('name', 'user-decision-scope', 'select');
                                                    $decisionScopes = array_replace([''=>''], $decisionScopesList); ?>

                                                    <?= $form->field($model, 'decisionScope')
                                                        ->dropDownList(
                                                            $decisionScopes, 
                                                            [
                                                                'class' => 'form-input br-a-10',
                                                                'data-placeholder' => "Sélectionnez un prérimètre décisionnel",
                                                            ]
                                                        )->label(false) ?>
                                                </div>
                                            </div>
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'department') ?>">Département / Service *</label>
                                                    <?php
                                                    $departmentsList = Option::getOption('name', 'user-departments', 'select');
                                                    $departments = array_replace([''=>''], $departmentsList); ?>

                                                    <?= $form->field($model, 'department')
                                                        ->dropDownList(
                                                            $departments, 
                                                            [
                                                                'class' => 'form-input br-a-10',
                                                                'data-placeholder' => "Sélectionnez un département",
                                                            ]
                                                        )->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-grid mt-20">
                                            <div class="form-item">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?= Html::getInputId($model, 'function') ?>">Fonction *</label>
                                                    <?= $form->field($model, 'function')
                                                        ->textInput([
                                                            'class' => 'form-input br-a-10',
                                                            'placeholder' => Yii::t('app', "Fonction")
                                                        ])->label(false) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-button text-right mt-50">
                                            <a href="javascript:void(0)" class="button orange icon-right shadow br-a-20 next" data-id="2">
                                                <span>Suivant</span>
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="layer2" class="wizard-layer row clearfix">
                                        <div class="section-summary mt-20">
                                            <h3>2. <?= Yii::t('app', "Société") ?></h3>
                                        </div>
                                        <div class="form-group mt-30 select-company">
                                            <label class="form-label" for="<?= Html::getInputId($model, 'company') ?>">Société *</label>
                                            <?php 
                                            if (null !== $companyList) {
                                                $companies = [''=>''];
                                                foreach ($companyList as $company) {
                                                    $companies[$company->id] = $company->name;
                                                } ?>

                                                <?= $form->field($model, 'company')
                                                    ->dropDownList(
                                                        $companies, 
                                                        [
                                                            'class' => 'form-control w-100',
                                                            'data-placeholder' => 'Sélectionnez une société',
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group mt-30 text-center">
                                            <a href="javascript:void(0)" class="button navy icon-right shadow br-a-20 show-company-form" data-id="2">
                                                <span><?= Yii::t('app', "Je ne trouve pas ma société") ?></span>
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                                </svg>
                                            </a>
                                        </div>

                                        <div class="no-company">
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyName') ?>">Nom de la société *</label>
                                                        <?= $form->field($model, 'companyName')
                                                            ->textInput([
                                                                'autofocus' => true,
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Nom de la société")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyAddressLine1') ?>">Numéro et Voie *</label>
                                                        <?= $form->field($model, 'companyAddressLine1')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Numéro et Voie")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyAddressLine2') ?>">Voie (suite)</label>
                                                        <?= $form->field($model, 'companyAddressLine2')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Voie (suite)")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyAddressZipcode') ?>">Code postal *</label>
                                                        <?= $form->field($model, 'companyAddressZipcode')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Code postal")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyAddressCity') ?>">Ville *</label>
                                                        <?= $form->field($model, 'companyAddressCity')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Ville")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyActivityArea') ?>">Secteur d'activité *</label>
                                                        <?php
                                                        $tplActivityAreas = Option::getOption('name', 'activity-areas', 'select');
                                                        $activityAreas = array_replace(array(''=>''), $tplActivityAreas); ?>

                                                        <?= $form->field($model, 'companyActivityArea')
                                                            ->dropDownList(
                                                                $activityAreas, 
                                                                [
                                                                    'class' => 'form-input br-a-10',
                                                                    'data-placeholder' => "Sélectionnez un secteur d'activité",
                                                                ]
                                                            )->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companySize') ?>">Taille de l'entreprise *</label>
                                                        <?php 
                                                        $sizes = array_replace([''=>''], [
                                                                '- de 1000 salariés' => '- de 1000 salariés',
                                                                '+ de 1000 salariés' => '+ de 1000 salariés'
                                                            ]); ?>

                                                        <?= $form->field($model, 'companySize')
                                                            ->dropDownList(
                                                                $sizes, 
                                                                [
                                                                    'class' => 'form-input br-a-10',
                                                                    'data-placeholder' => "Sélectionnez une taille",
                                                                ]
                                                            )->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyMainContactName') ?>">Contact principal *</label>
                                                        <?= $form->field($model, 'companyMainContactName')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Nom et prénom")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyBillingContactName') ?>">Contact facturation</label>
                                                        <?= $form->field($model, 'companyBillingContactName')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Nom et prénom")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyMainContactEmail') ?>">Email du contact principal *</label>
                                                        <?= $form->field($model, 'companyMainContactEmail')
                                                            ->textInput([
                                                                'type' => 'email',
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Email du contact principal")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyBillingContactEmail') ?>">Email du contact facturation *</label>
                                                        <?= $form->field($model, 'companyBillingContactEmail')
                                                            ->textInput([
                                                                'type' => 'email',
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Email du contact facturation")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-grid mt-20">
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyMainContactPhone') ?>">Téléphone du contact principal *</label>
                                                        <?= $form->field($model, 'companyMainContactPhone')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Téléphone du contact principal")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                                <div class="form-item">
                                                    <div class="form-group">
                                                        <label class="form-label" for="<?= Html::getInputId($model, 'companyBillingContactPhone') ?>">Téléphone du contact facturation *</label>
                                                        <?= $form->field($model, 'companyBillingContactPhone')
                                                            ->textInput([
                                                                'class' => 'form-input br-a-10',
                                                                'placeholder' => Yii::t('app', "Téléphone du contact facturation")
                                                            ])->label(false) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-button mt-50">
                                            <a href="javascript:void(0)" class="button gray icon-left shadow br-a-20 prev" data-id="1">
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#left"></use>
                                                </svg>
                                                <span>Précédent</span>
                                            </a>
                                            <a href="javascript:void(0)" class="button float-right orange icon-right shadow br-a-20 next" data-id="3">
                                                <span>Suivant</span>
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="layer3" class="wizard-layer row clearfix">
                                        <div class="section-summary mt-20">
                                            <h3>3. <?= Yii::t('app', "Centres d'intérêts") ?></h3>
                                        </div>
                                        <div class="form-grid flex-options mt-20">
                                            <?php 
                                            if (!empty($interestList)) {
                                                $tmpArr = $interestList;
                                                rsort($tmpArr);
                                                if (is_array($tmpArr[0])) {
                                                    foreach ($interestList as $interestCat => $interests) {
                                                        if (is_array($interests)) { ?>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 d-grid">
                                                                <blockquote>
                                                                    <h6 class="my-3"><?= strtoupper($interestCat) ?></h6>
                                                                    <?php
                                                                    foreach ($interests as $key => $interest) { ?>
                                                                        <?= $form->field($model, 'interests[]')
                                                                            ->checkbox([
                                                                                'value' => $key,
                                                                                'id' => 'registerform-interests_'.MainHelper::cleanUrl($interestCat).'_'.MainHelper::cleanUrl($key),
                                                                                'checked' => null !== $model->interests && in_array($key, $model->interests) ? true : false,
                                                                            ])->label($interest); ?>
                                                                    <?php } ?>
                                                                </blockquote>
                                                            </div>
                                                        <?php }
                                                    }                                                    
                                                } else { ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 d-grid">
                                                        <blockquote>
                                                            <?php
                                                            foreach ($interestList as $key => $interest) { ?>
                                                                <?= $form->field($model, 'interests[]')
                                                                    ->checkbox([
                                                                        'value' => $key,
                                                                        'id' => 'registerform-interests_'.MainHelper::cleanUrl($key),
                                                                        'checked' => null !== $model->interests && in_array($key, $model->interests) ? true : false,
                                                                    ])->label($interest); ?>
                                                            <?php } ?>
                                                        </blockquote>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>

                                        <div class="form-button mt-50">
                                            <a href="javascript:void(0)" class="button gray icon-left shadow br-a-20 prev" data-id="2">
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#left"></use>
                                                </svg>
                                                <span>Précédent</span>
                                            </a>
                                            <a href="javascript:void(0)" class="button float-right orange icon-right shadow br-a-20 next" data-id="4">
                                                <span>Suivant</span>
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="layer4" class="wizard-layer row clearfix">
                                        <div class="section-summary mt-20">
                                            <h3>4. <?= Yii::t('app', "Produits utilisés") ?></h3>
                                        </div>
                                        <div class="form-grid flex-options mt-20">
                                            <?php 
                                            if (!empty($productList)) {
                                                $tmpArr = $productList;
                                                rsort($tmpArr);
                                                if (is_array($tmpArr[0])) {
                                                    foreach ($productList as $productCat => $products) {
                                                        if (is_array($products)) { ?>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <blockquote>
                                                                    <h6 class="my-3"><?= strtoupper($productCat) ?></h6>
                                                                    <?php
                                                                    foreach ($products as $key => $product) { ?>
                                                                        <?= $form->field($model, 'products[]')
                                                                            ->checkbox([
                                                                                'value' => $key,
                                                                                'id' => 'registerform-products_'.MainHelper::cleanUrl($productCat).'_'.MainHelper::cleanUrl($key),
                                                                                'checked' => null !== $model->products && in_array($key, $model->products) ? true : false,
                                                                            ])->label($product); ?>
                                                                    <?php } ?>
                                                                </blockquote>
                                                            </div>
                                                        <?php }
                                                    }
                                                } else { ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 d-grid">
                                                        <blockquote>
                                                            <?php
                                                            foreach ($products as $key => $product) { ?>
                                                                <?= $form->field($model, 'products[]')
                                                                    ->checkbox([
                                                                        'value' => $key,
                                                                        'id' => 'registerform-products_'.MainHelper::cleanUrl($key),
                                                                        'checked' => null !== $model->products && in_array($key, $model->products) ? true : false,
                                                                    ])->label($product); ?>
                                                            <?php } ?>
                                                        </blockquote>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>

                                        <div class="form-button mt-50">
                                            <a href="javascript:void(0)" class="button gray icon-left shadow br-a-20 prev" data-id="3">
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#left"></use>
                                                </svg>
                                                <span>Précédent</span>
                                            </a>
                                            <a href="javascript:void(0)" class="button float-right orange icon-right shadow br-a-20 next" data-id="5">
                                                <span>Suivant</span>
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="layer5" class="wizard-layer row clearfix">
                                        <div class="section-summary mt-20">
                                            <h3>5. <?= Yii::t('app', "Validation") ?></h3>
                                        </div>
                                        <div class="form-option mt-30">
                                            <?= $form->field($model, 'cgu')->checkbox([
                                                    'value' => 1,
                                                    'template' => '{input}<label for="'.Html::getInputId($model, 'cgu').'">J\'ai pris connaissance et j\'accepte les <a href="'.Url::to(['site/content', 'url' => $cgi->url]).'">conditions générales d\'inscription</a>.</label>{error}'
                                                ])->label(false); ?>
                                        </div>

                                        <div class="form-button mt-50">
                                            <a href="javascript:void(0)" class="button gray icon-left shadow br-a-20 prev" data-id="4">
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#left"></use>
                                                </svg>
                                                <span>Précédent</span>
                                            </a>
                                            <button type="submit" class="button float-right orange icon-right shadow br-a-20" data-id="3">
                                                <span>Suivant</span>
                                                <svg width="20" height="14">
                                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            <?php ActiveForm::end(); ?>
                            <!-- form -->
                        </div>
                    </div>
                </section>
                <!-- section -->