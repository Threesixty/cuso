<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use common\models\Company;
use common\models\Media;
use frontend\widgets\BlockWidget;
use frontend\widgets\MemberWidget;
use common\components\MainHelper;

#MainHelper::pp($cms->content);

$this->title = MainHelper::getPageTitle($cms->title, '', true);
?>

    <?php 
    foreach ($cms->content as $block) { ?>

        <?= BlockWidget::widget([
                'type' => $block['block'], 
                'value' => is_array($block['value']) ? JSON::encode($block['value']) : $block['value'],
                'position' => intval($block['position'])-1, 
            ]) ?>

    <?php } ?>

    <!-- team-section -->
    <section class="search-section pt_60">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="search-content">
                        <h3 class="theme-color mb-3">Rechercher un membre</h3>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                                <?php
                                $selectMembers = [''=>''];
                                foreach ($members as $member) {
                                    $company = Company::getUserCompanyName($member->company_id);
                                    $selectMembers[$company][$member->id] = $member->firstname.' '.$member->lastname;
                                } ?>
                                <?= Html::dropDownList('company', null, $selectMembers,
                                        [
                                            'class' => 'form-control w-100 init-select2 filter-member',
                                            'data-placeholder' => 'Sélectionnez un membre',
                                        ]
                                    ) ?>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                                <?= Html::dropDownList('company', null, array_replace([''=>''], array_column($companies, 'name', 'id')),
                                        [
                                            'class' => 'form-control w-100 init-select2 filter-company',
                                            'data-placeholder' => 'Sélectionnez une société',
                                        ]
                                    ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section pt_50">
        <div class="outer-container clearfix">
            <?php
            if (null !== $members) {
                foreach ($members as $member) {
                    $company = Company::findOne($member->company_id); ?>

                    <div class="team-block-one member-<?= $member->id ?> company-<?= $member->company_id ?>">
                        <div class="inner-box">
                            <?php
                            if (null !== $member->photo_id) {
                                $photoIds = JSON::decode($member->photo_id);
                                if (!empty($photoIds)) { 
                                    foreach ($photoIds as $photoId) {
                                        $photo = Media::findOne($photoId);
                                        if (null !== $photo) { ?>
                                            <div class="bg-layer" style="background-image: url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>);"></div>
                                        <?php } else {
                                            if (null !== $company->photo_id) {
                                                $photoIds = JSON::decode($company->photo_id);
                                                if (!empty($photoIds)) { 
                                                    foreach ($photoIds as $photoId) {
                                                        $photo = Media::findOne($photoId);
                                                        if (null !== $photo) { ?>
                                                            <div class="bg-layer bg-contain" style="background-image: url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>);"></div>
                                                        <?php }
                                                    }
                                                }
                                            } else { ?>
                                                <div class="bg-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg);"></div>
                                            <?php }
                                        }
                                    }
                                } else {
                                    if (null !== $company->photo_id) {
                                        $photoIds = JSON::decode($company->photo_id);
                                        if (!empty($photoIds)) { 
                                            foreach ($photoIds as $photoId) {
                                                $photo = Media::findOne($photoId);
                                                if (null !== $photo) { ?>
                                                    <div class="bg-layer bg-contain" style="background-image: url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>);"></div>
                                                <?php }
                                            }
                                        }
                                    } else { ?>
                                        <div class="bg-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/team/team-1.jpg);"></div>
                                    <?php }
                                }
                            } ?>
                            <div class="content-box">
                                <h3><a href="javascript:void(0)" class="show-member" data-member="<?= $member->id ?>" data-url="<?= Url::to(['site/content', 'url' => 'memberDetails']) ?>"><?= $member->firstname ?> <?= $member->lastname ?></a></h3>
                                <span class="designation"><?= $member->function ?></span>
                                <p><?= $company->name ?></p>
                            </div>
                        </div>
                    </div>

                <?php }
            } ?>
        </div>
    </section>

    <?= MemberWidget::widget() ?>
