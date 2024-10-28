<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle(Yii::t('app', "Une erreur s'est produite"), '', true); ?>

        <!-- error-section -->
        <section class="error-section centred">
            <div class="bg-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg);"></div>
            <div class="auto-container">
                <div class="inner-box">
                    <div class="content-box">
                        <span>Oops!</span>
                        <h1>404</h1>
                        <h2>Cette page n'est pas disponible.</h2>
                        <a href="<?= Yii::$app->homeUrl ?>" class="theme-btn btn-one">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- error-section end -->