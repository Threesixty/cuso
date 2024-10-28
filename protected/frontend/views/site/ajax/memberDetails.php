<?php
use yii\helpers\Url;
use common\models\Company;
use common\models\Participant;
use common\components\MainHelper;

    if (null !== $member) {
        $memberCompany = Company::getUserCompanyName($member->company_id);
        $interests = $products = [];
        foreach ($member['modelRelations'] as $modelRelation) {
            if ($modelRelation->model == 'user' && $modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                $interests[] = $modelRelation->type_id;
            if ($modelRelation->model == 'user' && $modelRelation->type == 'option' && $modelRelation->type_name == 'products') {
                $products[] = $modelRelation->type_id;
            }
        } ?>

        <div class="sec-title mt_30 mb_40">
            <h2><?= $member->firstname ?> <?= $member->lastname ?></h2>
        </div>
        <ul class="accordion-box accordion-member-box">
            <li class="accordion accordion-member block active-block">
                <div class="acc-btn active">
                    <div class="icon-box"><i class="icon-20"></i></div>
                    INFORMATIONS PERSONNELLES
                </div>
                <div class="acc-content pt-5 current">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <span>Prénom :</span>
                            <h4 class="font-size-h4 mb-4"><?= ucfirst($member->firstname) ?></h4>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <span>Nom :</span>
                            <h4 class="font-size-h4 mb-4"><?= strtoupper($member->lastname) ?></h4>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <span>Email :</span>
                            <h4 class="font-size-h4 mb-4"><?= strtolower($member->email) ?></h4>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <span>Téléphone :</span>
                            <h4 class="font-size-h4 mb-4"><?= $member->phone != '' ? $member->phone : '' ?><?= $member->phone != '' && $member->mobile != '' ? ' / ' : '' ?><?= $member->mobile != '' ? $member->mobile : '' ?></h4>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <span>Fonction :</span>
                            <h4 class="font-size-h4 mb-4"><?= $member->function ?></h4>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <span>Société :</span>
                            <h4 class="font-size-h4 mb-4"><?= strtoupper($memberCompany) ?></h4>
                        </div>
                    </div>
                </div>
            </li>
            <li class="accordion accordion-member block">
                <div class="acc-btn">
                    <div class="icon-box"><i class="icon-20"></i></div>
                     CENTRES D'INTÉRÊT
                </div>
                <div class="acc-content pt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="accordion-list">
                                <?php
                                foreach ($interests as $interest) { ?>
                                    <li><h4 class="font-size-h4 mb-4"><?= $interest ?></h4></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="accordion accordion-member block">
                <div class="acc-btn">
                    <div class="icon-box"><i class="icon-20"></i></div>
                      PRODUITS UTILISÉS
                </div>
                <div class="acc-content pt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="accordion-list">
                                <?php
                                foreach ($products as $product) { ?>
                                    <li><h4 class="font-size-h4 mb-4"><?= $product ?></h4></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="accordion accordion-member block">
                <div class="acc-btn">
                    <div class="icon-box"><i class="icon-20"></i></div>
                       ÉVÉNEMENTS
                </div>
                <div class="acc-content">
                    <?php
                    $participations = Participant::getMemberParticipation($member->id); ?>
                    <ul>
                        <?php
                        if (null !== $participations) {
                            foreach ($participations as $participation) {
                                if (isset($participation['event'])) { ?>
                                    <li>
                                        <h4 class="font-size-h4 mb-4">
                                            <a href="<?= Url::to(['site/content', 'url' => $participation['event']->url]) ?>" target="_blank" class="text-dark"><?= $participation['event']->title ?></a>
                                        </h4>
                                    </li>
                                <?php }
                            }
                        } ?>
                    </ul>
                </div>
            </li>
        </ul>
    <?php } ?>