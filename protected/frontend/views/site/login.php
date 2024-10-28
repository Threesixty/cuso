<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($cms->title, '', true); ?>

        <!-- contact-section -->
        <section class="contact-section login-section mt_100 pt_140 pb_140">
            <div class="pattern-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg);"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <!--begin::Form-->
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                <div class="row clearfix">
                                    <div class="pb-5 pt-5 pt-lg-15">
                                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"><?= $cms->title ?></h3>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <?= $form->field($model, 'username')->textInput([
                                                'autofocus' => true, 
                                                'autocomplete' => 'off',
                                                'placeholder' => 'Votre email',
                                            ])->label(false) ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <?= $form->field($model, 'password')->passwordInput([
                                                'autocomplete' => 'off',
                                                'placeholder' => 'Votre mot de passe',
                                            ])->label(false) ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group d-flex w-100">
                                        <?= $form->field($model, 'rememberMe', ['options' =>  ['class' => 'w-50']])->checkbox() ?>
                                        <a href="<?= Url::to(['site/content', 'url' => $requestPasswordReset->url]) ?>" class="theme-color text-right w-50"><?= Yii::t('app', "Mot de passe oublié ?") ?></a>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mt-5">
                                        <?= Html::submitButton(Yii::t('app', "Connexion"), ['class' => 'theme-btn btn-one', 'name' => 'login-button']) ?>
                                        <a href="<?= Url::to(['site/content', 'url' => $register->url]) ?>" class="theme-btn btn-two next float-right" data-id="1"><?= Yii::t('app', "Inscription") ?></a>
                                    </div>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->