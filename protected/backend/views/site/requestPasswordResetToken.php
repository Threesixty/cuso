<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\PasswordResetRequestForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Mot de passe oublié';
?>

            <!--begin::Login-->
            <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto">
                    <!--begin::Aside Top-->
                    <div class="d-flex flex-column-auto flex-column pt-lg-10 pt-15"></div>
                    <!--end::Aside Top-->
                </div>
                <!--begin::Aside-->
                <!--begin::Content-->
                <div class="login-content flex-column-fluid d-flex flex-column p-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-row-fluid flex-center">
                        <!--begin::Forgot-->
                        <div class="login-form">
                            <!--begin::Form-->
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                                <!--begin::Aside header-->
                                <a href="#" class="login-logo text-center pt-lg-25">
                                    <img src="<?= Yii::$app->request->BaseUrl ?>/media/logo-white.png">
                                </a>
                                <!--end::Aside header-->
                                <!--begin::Title-->
                                <div class="pb-5 pt-5 pt-lg-15">
                                    <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Mot de passe oublié ?</h3>
                                    <p class="text-muted font-weight-bold font-size-h4">Veuillez saisir votre email afin de mettre à jour votre mot de passe</p>
                                </div>
                                <!--end::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <?= $form->field($model, 'email')->textInput([
                                            'autofocus' => true, 
                                            'class' => 'form-control h-auto py-7 px-6 rounded-lg border-0',
                                            'placeholder' => 'Votre email',
                                            'autocomplete' => 'off',
                                        ])->label(false) ?>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group d-flex flex-wrap">
                                    <?= Html::submitButton('Valider', ['class' => 'btn btn-success font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4', 'name' => 'request-password-reset-button']) ?>
                                    <a href="<?= Url::to(['site/login']) ?>" class="btn btn-light-success font-weight-bolder font-size-h6 px-8 py-4 my-3">Annuler</a>
                                </div>
                                <!--end::Form group-->

                            <?php ActiveForm::end(); ?>
                            <!--end::Form-->
                        </div>
                        <!--end::Forgot-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
