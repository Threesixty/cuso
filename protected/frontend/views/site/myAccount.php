<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use common\models\Option;
use common\models\Media;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle(Yii::t('app', "Mon compte"), '', true); ?>

        <!-- contact-section -->
        <section class="contact-section login-section mt_100 pt_140 pb_140">
            <div class="pattern-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg);"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="offset-lg-1 col-lg-10 col-md-12 col-sm-12 form-column">
                        <div class="form-inner px-5">
                            <!--begin::Form-->
                            <?php $form = ActiveForm::begin(['id' => 'register-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                                <div class="wizard">
                                    <div class="pb-5 pt-5 pt-lg-15">
                                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg text-center"><?= $cms->title ?></h3>
                                    </div>

                                    <div class="wizard-layer row clearfix active">
                                        <h3 class="text-primary font-size-h3 mb-5">1. <?= Yii::t('app', "Informations personnelles") ?></h3>
                                        <div class="col-lg-6 col-md-12 col-sm-12 file-input">
                                            <span>Photo de profil :</span>
                                            <a href="javascript:void(0)" class="image-box" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= Yii::t('app', "Modifier") ?>">
                                                <?php
                                                if (null !== $model->photo) {
                                                    $photoIds = JSON::decode($model->photo);
                                                    if (!empty($photoIds)) { 
                                                        foreach ($photoIds as $photoId) {
                                                            $photo = Media::findOne($photoId);
                                                            if (null !== $photo) { ?>
                                                                <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="">
                                                            <?php } else { ?>
                                                                <img src="<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg" alt="">
                                                            <?php }
                                                        }
                                                    } else { ?>
                                                        <img src="<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg" alt="">
                                                    <?php }
                                                } ?>
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <?= $form->field($model, 'photo')->fileInput()->label(false) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <span><?= Yii::t('app', 'Identifiant') ?> :</span>
                                            <h3 class="font-size-h3 username mb-4"><?= $model->username ?></h3>
                                        </div>
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
                                                    'options' => ['class' => 'form-group form-floating'],
                                                    'labelOptions' => ['class' => $model->decisionScope != '' ? 'selected' : '']
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
                                                    'options' => ['class' => 'form-group form-floating'],
                                                    'labelOptions' => ['class' => $model->department != '' ? 'selected' : '']
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
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <hr class="mt-4">
                                        </div>
                                        <h3 class="text-primary font-size-h3 mt-4 mb-5">2. <?= Yii::t('app', "Société") ?></h3>
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
                                                            'disabled' => 'disabled',
                                                            'class' => 'disabled'
                                                        ]
                                                    )
                                                    ->label(false) ?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <hr class="mt-4">
                                        </div>
                                        <h3 class="text-primary font-size-h3 mt-4 mb-5">3. <?= Yii::t('app', "Centres d'intérêts") ?></h3>
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
                                                                            'checked' => in_array($key, $model->interests) ? true : false,
                                                                        ])->label($interest); ?>
                                                                <?php } ?>
                                                            </blockquote>
                                                        </div>
                                                    <?php }
                                                }
                                            } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <hr class="mt-4">
                                        </div>
                                        <h3 class="text-primary font-size-h3 mt-4 mb-5">4. <?= Yii::t('app', "Produits utilisés") ?></h3>
                                        <div class="row flex-options">
                                            <?php 
                                            if (!empty($productList)) {
                                                foreach ($productList as $productCat => $products) { ?>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <blockquote>
                                                            <h6 class="my-3"><?= strtoupper($productCat) ?></h6>
                                                            <?php
                                                            foreach ($products as $key => $product) { ?>
                                                                <?= $form->field($model, 'products[]')
                                                                    ->checkbox([
                                                                        'value' => $key,
                                                                        'id' => 'registerform-products_'.MainHelper::cleanUrl($productCat).'_'.MainHelper::cleanUrl($key),
                                                                        'checked' => in_array($key, $model->products) ? true : false,
                                                                    ])->label($product); ?>
                                                            <?php } ?>
                                                        </blockquote>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 message-btn mt-4">
                                            <?= Html::submitButton(Yii::t('app', "Enregistrer"), ['class' => 'theme-btn btn-one float-right', 'name' => 'register-button']) ?>
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