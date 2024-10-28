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
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                                <div class="row clearfix">
                                    <div class="pb-5 pt-5 pt-lg-15">
                                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"><?= $cms->title ?></h3>
                                        <p class="text-muted font-weight-bold font-size-h4"><?= Yii::t('app', "Veuillez saisir votre email afin de mettre à jour votre mot de passe") ?></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <?= $form->field($model, 'email')->textInput([
                                                'autofocus' => true, 
                                                'class' => 'form-control h-auto py-7 px-6 rounded-lg border-0',
                                                'placeholder' => Yii::t('app', "Votre email"),
                                                'autocomplete' => 'off',
                                            ])->label(false) ?>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mt-5">
                                        <a href="<?= Url::to(['site/content', 'url' => $login->url]) ?>" class="theme-btn btn-two me-3"><?= Yii::t('app', "Annuler") ?></a>
                                        <?= Html::submitButton(Yii::t('app', "Valider"), ['class' => 'theme-btn btn-one', 'name' => 'request-password-reset-button']) ?>
                                    </div>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->