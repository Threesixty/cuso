<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Connexion', '', true);
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
                <div class="login-content flex-row-fluid d-flex flex-column p-10">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-row-fluid flex-center">
                        <!--begin::Signin-->
                        <div class="login-form">
                            <!--begin::Form-->
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                                <!--begin::Aside header-->
                                <a href="#" class="login-logo text-center pt-lg-25">
                                    <img src="<?= Yii::$app->request->BaseUrl ?>/media/logo-white.png">
                                </a>
                                <!--end::Aside header-->
                                <!--begin::Title-->
                                <div class="pb-5 pt-5 pt-lg-15">
                                    <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Connexion</h3>
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Identifiant</label>
                                    <?= $form->field($model, 'username')->textInput([
                                            'autofocus' => true, 
                                            'class' => 'form-control h-auto py-7 px-6 rounded-lg border-0',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Votre email',
                                        ])->label(false) ?>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Mot de passe</label>
                                        <a href="<?= Url::to(['site/request-password-reset']) ?>" class="text-success font-size-h6 font-weight-bolder text-hover-success pt-5">Mot de passe oublié ?</a>
                                    </div>
                                    <?= $form->field($model, 'password')->passwordInput([
                                            'class' => 'form-control h-auto py-7 px-6 rounded-lg border-0',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Votre mot de passe',
                                        ])->label(false) ?>
                                    
                                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Action-->
                                <div class="pb-lg-0 pb-5">
                                    <?= Html::submitButton('Connexion', ['class' => 'btn btn-success font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3', 'name' => 'login-button']) ?>
                                </div>
                                <!--end::Action-->

                            <?php ActiveForm::end(); ?>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Login-->
