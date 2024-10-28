<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($cms->title, '', true); ?>

    <!-- contact-section -->
    <section class="contact-section mt_100 pt_140 pb_140">
        <div class="pattern-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg);"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <!--begin::Form-->
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                            <div class="row clearfix">
                                <div class="pb-5 pt-5 pt-lg-15">
                                    <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg"><?= $cms->title ?></h3>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <?= $form->field($model, 'name', [
                                            'template' => '{input}{label}{hint}{error}', 
                                            'options' => ['class' => 'form-group form-floating']
                                        ])->textInput([
                                            'autofocus' => true, 
                                            'class' => 'form-control form-control-edit',
                                            'placeholder' => Yii::t('app', "Votre nom"),
                                        ])->label(Yii::t('app', "Votre nom")) ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <?= $form->field($model, 'email', [
                                            'template' => '{input}{label}{hint}{error}', 
                                            'options' => ['class' => 'form-group form-floating']
                                        ])->textInput([
                                            'autocomplete' => 'off',
                                            'class' => 'form-control form-control-edit',
                                            'placeholder' => Yii::t('app', "Votre email"),
                                        ])->label(Yii::t('app', "Votre email")) ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <?= $form->field($model, 'phone', [
                                            'template' => '{input}{label}{hint}{error}', 
                                            'options' => ['class' => 'form-group form-floating']
                                        ])->textInput([
                                            'class' => 'form-control form-control-edit',
                                            'placeholder' => Yii::t('app', "Votre téléphone"),
                                        ])->label(Yii::t('app', "Votre téléphone")) ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <?= $form->field($model, 'subject', [
                                            'template' => '{input}{label}{hint}{error}', 
                                            'options' => ['class' => 'form-group form-floating']
                                        ])->textInput([
                                            'class' => 'form-control form-control-edit',
                                            'placeholder' => Yii::t('app', "Sujet"),
                                        ])->label(Yii::t('app', "Sujet")) ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <?= $form->field($model, 'message', [
                                            'template' => '{input}{label}{hint}{error}', 
                                            'options' => ['class' => 'form-group form-floating']
                                        ])->textarea([
                                            'class' => 'form-control form-control-edit',
                                            'placeholder' => Yii::t('app', "Votre message"),
                                        ])->label(Yii::t('app', "Votre message")) ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                    <?= Html::submitButton(Yii::t('app', "Envoyer"), ['class' => 'theme-btn btn-one', 'name' => 'contact-button']) ?>
                                </div>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->

    <?php 
    foreach ($cms->content as $block) { ?>

        <?= BlockWidget::widget([
                'type' => $block['block'], 
                'value' => is_array($block['value']) ? JSON::encode($block['value']) : $block['value'],
                'position' => intval($block['position'])-1, 
            ]) ?>

    <?php } ?>