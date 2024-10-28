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

        <!-- contact-section -->
        <section class="contact-section login-section mt_100 pt_140 pb_140">
            <div class="pattern-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg);"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="offset-lg-1 col-lg-10 col-md-12 col-sm-12 form-column">
                        <div class="form-inner px-5">
                            <!--begin::Form-->
                            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

                                <div class="wizard">
                                    <div class="pb-5 pt-5 pt-lg-15">
                                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg text-center"><?= $cms->title ?> <span class="fw-100"><?= Yii::t('app', "ou") ?></span> <a href="<?= Url::to(['site/content', 'url' => $login->url]) ?>" class="theme-btn btn-one">Connexion</a></h3>
                                    </div>
                                    <div id="layer1" class="wizard-layer row clearfix active">
                                        <h3 class="text-primary font-size-h3 mb-5">1. <?= Yii::t('app', "Informations personnelles") ?></h3>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'firstname', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'autofocus' => true,
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Prénom")
                                                ])->label(Yii::t('app', "Prénom")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'lastname', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Nom")
                                                ])->label(Yii::t('app', "Nom")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'email', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'type' => 'email',
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Email")
                                                ])->label(Yii::t('app', "Email")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'password', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->passwordInput([
                                                    'autocomplete' => 'off',
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Mot de passe")
                                                ])->label(Yii::t('app', "Mot de passe")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'phone', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Téléphone")
                                                ])->label(Yii::t('app', "Téléphone")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'mobile', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Mobile")
                                                ])->label(Yii::t('app', "Mobile")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?php
                                            $decisionScopesList = Option::getOption('name', 'user-decision-scope', 'select');
                                            $decisionScopes = array_replace([''=>''], $decisionScopesList); ?>

                                            <?= $form->field($model, 'decisionScope', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->dropDownList(
                                                    $decisionScopes, 
                                                    [
                                                        'class' => 'form-control form-control-edit w-100',
                                                        'data-placeholder' => '',
                                                    ]
                                                )
                                                ->label(Yii::t('app', "Périmètre décisionnel")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?php
                                            $departmentsList = Option::getOption('name', 'user-departments', 'select');
                                            $departments = array_replace([''=>''], $departmentsList); ?>

                                            <?= $form->field($model, 'department', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->dropDownList(
                                                    $departments, 
                                                    [
                                                        'class' => 'form-control form-control-edit w-100',
                                                        'data-placeholder' => '',
                                                    ]
                                                )
                                                ->label(Yii::t('app', "Département / Service")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <?= $form->field($model, 'function', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Fonction")
                                                ])->label(Yii::t('app', "Fonction")) ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 message-btn mt-4">
                                            <a href="javascript:void(0)" class="theme-btn btn-one next float-right" data-id="2"><?= Yii::t('app', "Suivant") ?></a>
                                        </div>
                                    </div>
                                    <div id="layer2" class="wizard-layer row clearfix">
                                        <h3 class="text-primary font-size-h3 mb-5">2. <?= Yii::t('app', "Société") ?></h3>
                                        <div class="col-lg-12 col-md-12 col-sm-12 select-company">
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
                                        <div class="col-lg-12 col-md-12 col-sm-12 mt-4 text-center">
                                            <a href="javascript:void(0)" class="theme-btn btn-one font-size-18 show-company-form" data-id="2"><?= Yii::t('app', "Je ne trouve pas ma société") ?></a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mt-4 no-company">
                                            <?= $form->field($model, 'companyName', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Nom de la société")
                                                ])->label(Yii::t('app', "Nom de la société")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mt-4 no-company">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <?= $form->field($model, 'companyAddressLine1', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Numéro et Voie")
                                                ])->label(Yii::t('app', "Numéro et Voie")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <?= $form->field($model, 'companyAddressLine2', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Voie (suite)")
                                                ])->label(Yii::t('app', "Voie (suite)")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <?= $form->field($model, 'companyAddressZipcode', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Code postal")
                                                ])->label(Yii::t('app', "Code postal")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <?= $form->field($model, 'companyAddressCity', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Ville")
                                                ])->label(Yii::t('app', "Ville")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <?php 
                                            $tplActivityAreas = Option::getOption('name', 'activity-areas', 'select');
                                            $activityAreas = array_replace(array(''=>''), $tplActivityAreas); ?>

                                            <?= $form->field($model, 'companyActivityArea', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->dropDownList(
                                                    $activityAreas, 
                                                    [
                                                        'class' => 'form-control form-control-edit w-100',
                                                        'data-placeholder' => '',
                                                    ]
                                                )
                                                ->label(Yii::t('app', "Secteur d'activité")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <?php 
                                            $sizes = array_replace([''=>''], [
                                                    '- de 1000 salariés' => '- de 1000 salariés',
                                                    '+ de 1000 salariés' => '+ de 1000 salariés'
                                                ]); ?>

                                            <?= $form->field($model, 'companySize', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->dropDownList(
                                                    $sizes, 
                                                    [
                                                        'class' => 'form-control form-control-edit w-100',
                                                        'data-placeholder' => '',
                                                    ]
                                                )
                                                ->label(Yii::t('app', "Taille de l'entreprise")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <h4 class="text-dark font-size-h4 my-3 ms-2"><?= Yii::t('app', "Contact principal") ?></h4>
                                            <?= $form->field($model, 'companyMainContactName', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Nom du contact principal")
                                                ])->label(Yii::t('app', "Nom du contact principal")) ?>

                                            <?= $form->field($model, 'companyMainContactEmail', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'type' => 'email',
                                                    'placeholder' => Yii::t('app', "Email du contact principal")
                                                ])->label(Yii::t('app', "Email du contact principal")) ?>

                                            <?= $form->field($model, 'companyMainContactPhone', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Téléphone du contact principal")
                                                ])->label(Yii::t('app', "Téléphone du contact principal")) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 no-company">
                                            <h4 class="text-dark font-size-h4 my-3 ms-2"><?= Yii::t('app', "Contact facturation") ?></h4>
                                            <?= $form->field($model, 'companyBillingContactName', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Nom du contact facturation")
                                                ])->label(Yii::t('app', "Nom du contact facturation")) ?>

                                            <?= $form->field($model, 'companyBillingContactEmail', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'type' => 'email',
                                                    'placeholder' => Yii::t('app', "Email du contact facturation")
                                                ])->label(Yii::t('app', "Email du contact facturation")) ?>

                                            <?= $form->field($model, 'companyBillingContactPhone', [
                                                    'template' => '{input}{label}{hint}{error}', 
                                                    'options' => ['class' => 'form-group form-floating']
                                                ])->textInput([
                                                    'class' => 'form-control form-control-edit',
                                                    'placeholder' => Yii::t('app', "Téléphone du contact facturation")
                                                ])->label(Yii::t('app', "Téléphone du contact facturation")) ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 message-btn mt-4">
                                            <a href="javascript:void(0)" class="theme-btn btn-two prev" data-id="1"><?= Yii::t('app', "Précédent") ?></a>
                                            <a href="javascript:void(0)" class="theme-btn btn-one next float-right" data-id="3"><?= Yii::t('app', "Suivant") ?></a>
                                        </div>
                                    </div>
                                    <div id="layer3" class="wizard-layer row clearfix">
                                        <h3 class="text-primary font-size-h3 mb-5">3. <?= Yii::t('app', "Centres d'intérêts") ?></h3>
                                        <div class="row flex-options">
                                            <?php 
                                            if (!empty($interestList)) {
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
                                            } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 message-btn mt-4">
                                            <a href="javascript:void(0)" class="theme-btn btn-two prev" data-id="2"><?= Yii::t('app', "Précédent") ?></a>
                                            <a href="javascript:void(0)" class="theme-btn btn-one next float-right" data-id="4"><?= Yii::t('app', "Suivant") ?></a>
                                        </div>
                                    </div>
                                    <div id="layer4" class="wizard-layer row clearfix">
                                        <h3 class="text-primary font-size-h3 mb-5">4. <?= Yii::t('app', "Produits utilisés") ?></h3>
                                        <div class="row flex-options">
                                            <?php 
                                            if (!empty($productList)) {
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
                                            } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 message-btn mt-4">
                                            <a href="javascript:void(0)" class="theme-btn btn-two prev" data-id="3"><?= Yii::t('app', "Précédent") ?></a>
                                            <a href="javascript:void(0)" class="theme-btn btn-one next float-right" data-id="5"><?= Yii::t('app', "Suivant") ?></a>
                                        </div>
                                    </div>
                                    <div id="layer5" class="wizard-layer row clearfix">
                                        <h3 class="text-primary font-size-h3 mb-5">5. <?= Yii::t('app', "Validation") ?></h3>
                                        <div class="col-lg-12 col-md-6 col-sm-12">
                                            <?php
                                            $cgu = 'J\'ai bien pris connaissance et j\'accepte les <a href="'.Url::to(['site/content', 'url' => $cgi->url]).'" target="_blank">conditions générales d\'inscription</a>'; ?>
                                            <?= $form->field($model, 'cgu')->checkbox([
                                                'value' => 1,
                                            ])->label($cgu); ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 message-btn mt-4">
                                            <a href="javascript:void(0)" class="theme-btn btn-two prev" data-id="4"><?= Yii::t('app', "Précédent") ?></a>
                                            <?= Html::submitButton(Yii::t('app', "Valider"), ['class' => 'theme-btn btn-one float-right', 'name' => 'register-button']) ?>
                                        </div>
                                    </div>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->