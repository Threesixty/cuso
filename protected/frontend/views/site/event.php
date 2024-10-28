<?php
use yii\helpers\Url;
use yii\helpers\Json;
use frontend\widgets\BlockWidget;
use frontend\widgets\MemberWidget;
use common\models\Event;
use common\models\User;
use common\models\Company;
use common\models\Media;
use common\components\MainHelper;

#MainHelper::pp($cms->content);

$this->title = MainHelper::getPageTitle($cms->title, '', true); ?>

    <!-- page-title -->
    <section class="page-title">
        <?php
        if (null !== $cms->photo_id) {
            foreach (JSON::decode($cms->photo_id) as $photoId) {
                $photo = Media::findOne($photoId);
                if (null !== $photo) { ?>
                    <div class="bg-layer" style="background-image: url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>);"></div>
                <?php }
            }
        } ?>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix mb_20">
                    <li><?= $cms['event']->event_type ?></li>
                </ul>
                <h1><?= $cms->title ?></h1>
            </div>
        </div>
    </section>
    <!-- page-title end -->


    <!-- event-details -->
    <section class="event-details pt_80 pb_80">
        <div class="auto-container">
            <div class="event-details-content">
                <div class="content-box p_relative">
                    <?php
                    if (null !== $cms['event']->start_datetime && $cms['event']->start_datetime > 0) { ?>
                        <div class="title-box">
                            <div class="title-text">
                                <h2><?= MainHelper::getPrettyEventDate($cms['event']->start_datetime, $cms['event']->end_datetime, false, 'date') ?></h2>
                                <div class="time"><i class="icon-16"></i><?= MainHelper::getPrettyEventDate($cms['event']->start_datetime, $cms['event']->end_datetime, false, 'time') ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row clearfix">
                        <div class="col-lg-9 col-md-12 col-sm-12 text-column">
                            <div class="text-box">
                                <h3 class="mb-3">Présentation</h3>
                                <?= $cms['event']->presentation ?>
                            </div>
                            <div class="text-box mt-5">
                                <h3 class="mb-3">Programme</h3>
                                <?= $cms['event']->program ?>
                            </div>
                            <?php
                            if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role >= 3 && $cms['event']->end_datetime < time()) {
                                if ($cms['event']->synthesis != '') { ?>
                                    <div class="text-box mt-5">
                                        <h3 class="mb-3">Synthèse</h3>
                                        <?= $cms['event']->synthesis ?>
                                    </div>
                                <?php }
                                if (null !== $cms['event']->documents) {
                                    $documentIds = JSON::decode($cms['event']->documents);
                                    if (!empty($documentIds)) { ?>

                                        <div class="text-box mt-5">
                                            <h3 class="mb-3">Documents</h3>
                                            <div class="row clearfix centred">
                                                <?php
                                                foreach ($documentIds as $documentId) {
                                                    $document = Media::findOne($documentId);
                                                    if (null !== $document) {

                                                        $mimeType = mime_content_type(Yii::getAlias('@uploadFolder').'/'.$document->path);
                                                        $type = explode('/', $mimeType);
                                                        $icon = '';
                                                        switch ($type[0]) {
                                                            case 'image':
                                                                $icon = '-image';
                                                                break;

                                                            case 'application':
                                                                switch ($type[1]) {
                                                                    case 'pdf':
                                                                        $icon = '-pdf';
                                                                        break;
                                                                    case 'msword':
                                                                    case 'vnd.openxmlformats-officedocument.wordprocessingml.document':
                                                                        $icon = '-word';
                                                                        break;
                                                                    case 'vnd.ms-excel':
                                                                    case 'vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                                                                        $icon = '-excel';
                                                                        break;
                                                                    case 'vnd.ms-powerpoint':
                                                                    case 'vnd.openxmlformats-officedocument.presentationml.presentation':
                                                                        $icon = '-powerpoint';
                                                                        break;
                                                                     
                                                                     default:
                                                                        break;
                                                                }
                                                                break;
                                                            
                                                            default:
                                                                break;
                                                        } ?>

                                                        <div class="col-lg-3 col-md-4 col-sm-6 mission-block">
                                                            <div class="mission-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                                                <a href="<?= Yii::getAlias('@uploadWeb').'/'.$document->path ?>" target="_blank" class="inner-box">
                                                                    <div class="icon-box file-icon"><i class="fa fa-file<?= $icon ?>"></i></div>
                                                                    <h5><?= $document->title ?></h5>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    <?php }
                                                } ?>

                                            </div>

                                        </div>
                                    <?php }
                                }
                            } ?>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 info-column">
                            <div class="btn-box <?= $cms['event']->start_datetime > time() ? 'mb-5' : '' ?>" data-bs-toggle="tooltip" data-bs-placement="top">
                                <?php
                                if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role >= 3 && $cms['event']->registerable && $cms['event']->start_datetime > time()) {
                                    if (null !== $currentParticipant && $currentParticipant->registered == 1) { ?>
                                        <a href="<?= Url::to(['site/content', 'url' => $cms->url, 'register' => false]) ?>" class="theme-btn btn-three btn-success w-100 <?= $cms['event']->start_datetime < time() ? 'btn disabled' : '' ?>"><?= Yii::t('app', "Me désinscrire") ?></a>
                                    <?php } elseif (null !== $currentParticipant && $currentParticipant->registered == 2) { ?>
                                        <a href="javascript:void(0)" class="theme-btn btn-four w-100"><?= Yii::t('app', "Réfusé") ?></a>
                                    <?php } else { ?>
                                        <a href="<?= Url::to(['site/content', 'url' => $cms->url, 'register' => true]) ?>" class="theme-btn btn-one w-100"><?= Yii::t('app', "Je m'inscris") ?></a>
                                    <?php }
                                } elseif (Yii::$app->user->isGuest && $cms['event']->registerable && $cms['event']->start_datetime > time()) { ?>
                                    <a href="<?= Url::to(['site/content', 'url' => $register->url]) ?>" class="theme-btn btn-one w-100"><?= Yii::t('app', "Je m'inscris") ?></a>
                                <?php } ?>
                            </div>
                            <div class="info-inner">
                                <div class="single-info-box">
                                    <div class="light-icon"><img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/icon-12.png" alt=""></div>
                                    <h3><?= Yii::t('app', "Lieu") ?> :</h3>
                                    <?php
                                    $and = '';
                                    if ($cms['event']->address != '' && $cms['event']->presential) {
                                        $and = Yii::t('app', 'ET '); ?>
                                        <span><img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/icon-11.png" alt=""> <?= $cms['event']->address ?></span>
                                    <?php }
                                    if ($cms['event']->distance) { ?>
                                        <span class="mt-2"><img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/icon-15.png" alt=""> <?= $and.strtoupper(Yii::t('app', "En distanciel")) ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                            if ($cms['event']->presential) { ?>
                                <div class="map-inner mt_30">
                                    <iframe id="map-canvas" class="map_part" width="500"  height="400" src="https://maps.google.com/maps?width=100%&amp;height=100%&amp;hl=en&amp;q=<?= strip_tags($cms['event']->address) ?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- event-details end -->


    <?php 
    foreach ($cms->content as $block) { ?>

        <?= BlockWidget::widget([
                'type' => $block['block'], 
                'value' => is_array($block['value']) ? JSON::encode($block['value']) : $block['value'],
                'position' => intval($block['position'])-1, 
            ]) ?>

    <?php } ?>


    <?php
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role >= 3) { ?>

        <section class="team-details pb_140">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 text-column">
                        <?php
                        $speakers = array_filter($cms['modelRelations'], function($item) {
                            return $item['type'] == 'speakers';
                        });
                        if (!empty($speakers)) { ?>
                            <div class="auto-container">
                                <div class="sec-title mb_40">
                                    <h2>Les intervenants</h2>
                                </div>
                                <div class="team-details-content">

                                    <?php
                                    foreach ($speakers as $speaker) {
                                        $currentSpeaker = User::findOne($speaker['type_id']);
                                        if (null !== $currentSpeaker) {
                                            $speakerCompanyName = Company::getUserCompanyName($currentSpeaker->company_id); ?>

                                            <div class="row align-items-center my-4">
                                                <div class="col-lg-4 col-md-12 col-sm-12 image-column">

                                                    <figure class="image-box">
                                                        <?php
                                                        if (null !== $currentSpeaker->photo_id) {
                                                            $photoIds = JSON::decode($currentSpeaker->photo_id);
                                                            if (!empty($photoIds)) { 
                                                                foreach ($photoIds as $photoId) {
                                                                    $photo = Media::findOne($photoId);
                                                                    if (null !== $photo) { ?>
                                                                        <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->alt ?>">
                                                                    <?php } else { ?>
                                                                        <img src="<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg" alt="Photo intervenant">
                                                                    <?php }
                                                                }
                                                            } else { ?>
                                                                <img src="<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg" alt="Photo intervenant">
                                                            <?php }
                                                        } ?>
                                                    </figure>
                                                </div>
                                                <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                                                    <div class="content-box">
                                                        <h3>
                                                            <a href="javascript:void(0)" class="author mb-3 show-member" data-member="<?= $currentSpeaker->id ?>" data-url="<?= Url::to(['site/content', 'url' => 'memberDetails']) ?>"><?= $currentSpeaker->firstname ?> <?= $currentSpeaker->lastname ?></a>
                                                        </h3>
                                                        <strong class="designation"><?= $currentSpeaker->function ?> | <?= $speakerCompanyName ?></strong>
                                                        <ul class="list-item clearfix mb-3">
                                                            <li><span>Email : </span>&nbsp;<a href="mailto:<?= $currentSpeaker->email ?>"><?= strtolower($currentSpeaker->email) ?></a></li>
                                                        </ul>
                                                        <p class="fst-italic"><?= $currentSpeaker->presentation ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                         
                                        <?php }
                                    } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="blog-sidebar default-sidebar">
                            <?php
                            $sponsors = array_filter($cms['modelRelations'], function($item) {
                                return $item['type'] == 'sponsors';
                            });
                            if (!empty($sponsors)) { ?>
                                <div class="sidebar-widget post-widget mb_40">
                                    <div class="widget-title mb_30">
                                        <h3>Sponsors</h3>
                                    </div>
                                    <div class="post-inner">
                                        <?php
                                        foreach ($sponsors as $sponsor) {
                                            $currentSponsor = Company::findOne($sponsor['type_id']);
                                            if (null !== $currentSponsor) { ?>

                                                <div class="post d-flex">
                                                    <figure class="post-thumb align-items-center d-flex">
                                                        <?php
                                                        if (null !== $currentSponsor->photo_id) {
                                                            $photoIds = JSON::decode($currentSponsor->photo_id);
                                                            if (!empty($photoIds)) { 
                                                                foreach ($photoIds as $photoId) {
                                                                    $photo = Media::findOne($photoId);
                                                                    if (null !== $photo) { ?>
                                                                        <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->alt ?>">
                                                                    <?php } else { ?>
                                                                        <img src="<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg" alt="Photo intervenant">
                                                                    <?php }
                                                                }
                                                            } else { ?>
                                                                <img src="<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg" alt="Photo intervenant">
                                                            <?php }
                                                        } ?>
                                                    </figure>
                                                    <h5 class="d-flex align-items-center">
                                                        <?= $currentSponsor->name ?>
                                                    </h5>
                                                </div>
                                         
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- team-details end -->

    <?= MemberWidget::widget() ?>