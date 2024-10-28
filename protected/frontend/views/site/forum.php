<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use common\models\Forum;
use common\models\Company;
use common\models\User;
use common\models\Option;
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

    <!-- event-section -->
    <section class="event-section event-page-section pt_50 pb_110">
        <div class="auto-container">
            <a href="javascript:void(0)" class="theme-btn btn-one mb-4 show-forum-modal" data-bs-toggle="modal" data-bs-target="#forumModal">Poser une nouvelle question</a>
            <?php 
            if (null !== Yii::$app->request->get('id')) { ?>
                <a href="<?= Url::to(['site/content', 'url' => $cms->url]) ?>" class="theme-btn btn-two mb-4 float-right">Voir toutes les questions</a>
            <?php } ?>
            <div class="tabs-box">
                <div class="event-content">

                    <?php
                    if (null !== $forums) {
                        foreach ($forums as $forum) {
                            $author = User::findOne($forum->author);
                            $authorCompany = Company::getUserCompanyName($author->company_id);
                            $forumsLevelOne = Forum::getActiveForums($forum->id, SORT_ASC);

                            $interests = $products = [];
                            foreach ($forum['modelRelations'] as $modelRelation) {
                                if ($modelRelation->model == 'forum' && $modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                                    $interests[] = $modelRelation->type_id;
                                if ($modelRelation->model == 'forum' && $modelRelation->type == 'option' && $modelRelation->type_name == 'products') {
                                    $products[] = $modelRelation->type_id;
                                }
                            }

                            $foreground = null !== Yii::$app->request->get('id') && Yii::$app->request->get('id') != $forum->id ? 'd-none' : ''; ?>

                            <div class="event-block-one mb-5 <?= $foreground ?>">
                                <div class="inner-box">

                                    <div class="inner">
                                        <h5><a href="javascript:void(0)"><?= $forum->title ?></a></h5>
                                        <span class="content"><?= nl2br($forum->content) ?></span>
                                        <a href="javascript:void(0)" class="author mt-3 mb-3 show-member" data-member="<?= $forum->author ?>" data-url="<?= Url::to(['site/content', 'url' => 'memberDetails']) ?>"><?= $author->firstname ?> <?= $author->lastname ?> | <?= $authorCompany ?></a>
                                        <hr>
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="default-sidebar">
                                                    <div class="tags-widget">
                                                        <ul class="tags-list clearfix">
                                                            <?php
                                                            foreach ($interests as $interest) { ?>
                                                                <li><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= Yii::t('app', "Sujets abordés") ?>"><?= $interest ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                    <div class="tags-widget mt-2">
                                                        <ul class="tags-list clearfix">
                                                            <?php
                                                            foreach ($products as $product) { ?>
                                                                <li class="secondary"><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?= Yii::t('app', "Produits concernés") ?>"><?= $product ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <ul class="info-list">
                                                    <li><i class="icon-3"></i><?= strftime("%d %B %Y", $forum->created_at) ?></li>
                                                    <li><a href="javascript:void(0)" class="<?= count($forumsLevelOne) > 0 ? 'show-response' : '' ?>" data-level="one"><i class="icon-12"></i><?= count($forumsLevelOne) ?> réponse<?= count($forumsLevelOne) > 1 ? 's' : '' ?></a></li>
                                                    <li><a href="javascript:void(0)" class="show-forum-modal" data-bs-toggle="modal" data-bs-target="#forumModal" data-parent-id="<?= $forum->id ?>"><i class="icon-26"></i>Répondre</a></li>
                                                    <?php
                                                    if ($author->id == Yii::$app->user->identity->id) { ?>
                                                        <li><a href="<?= Url::to(['site/content', 'url' => $cms->url, 'del' => $forum->id]) ?>"><i class="icon-19"></i>Supprimer</a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    foreach ($forumsLevelOne as $forumLevelOne) {
                                        $author = User::findOne($forumLevelOne->author);
                                        $authorCompany = Company::getUserCompanyName($author->company_id);
                                        $forumsLevelTwo = Forum::getActiveForums($forumLevelOne->id, SORT_ASC); ?>

                                        <!-- Niveau -1 -->
                                        <div class="inner level-one">
                                            <div class="d-flex">
                                                <div class="answer-icon">
                                                    <i class="icon-26"></i>
                                                </div>
                                                <div class="answer-content">
                                                    <span class="content"><?= nl2br($forumLevelOne->content) ?></span>
                                                    <a href="javascript:void(0)" class="author mt-3 mb-3 show-member" data-member="<?= $forumLevelOne->author ?>" data-url="<?= Url::to(['site/content', 'url' => 'memberDetails']) ?>"><?= $author->firstname ?> <?= $author->lastname ?> | <?= $authorCompany ?></a>
                                                    <hr>
                                                    <div class="row clearfix">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <ul class="info-list">
                                                                <li><i class="icon-3"></i><?= strftime("%d %B %Y", $forumLevelOne->created_at) ?></li>
                                                                <li><a href="javascript:void(0)" class="<?= count($forumsLevelTwo) > 0 ? 'show-response' : '' ?>" data-level="two"><i class="icon-12"></i><?= count($forumsLevelTwo) ?> réponse<?= count($forumsLevelTwo) > 1 ? 's' : '' ?></a></li>
                                                                <li><a href="javascript:void(0)" class="show-forum-modal" data-bs-toggle="modal" data-bs-target="#forumModal" data-parent-id="<?= $forumLevelOne->id ?>"><i class="icon-26"></i>Répondre</a></li>
                                                                <?php
                                                                if ($author->id == Yii::$app->user->identity->id) { ?>
                                                                    <li><a href="<?= Url::to(['site/content', 'url' => $cms->url, 'del' => $forumLevelOne->id]) ?>"><i class="icon-19"></i>Supprimer</a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        foreach ($forumsLevelTwo as $forumLevelTwo) {
                                            $author = User::findOne($forumLevelTwo->author);
                                            $authorCompany = Company::getUserCompanyName($author->company_id);
                                            $forumsLevelOne = Forum::getActiveForums($forumLevelTwo->id); ?>

                                            <!-- Niveau -2 -->
                                            <div class="inner level-two">
                                                <div class="d-flex">
                                                    <div class="answer-icon">
                                                        <i class="icon-26"></i>
                                                    </div>
                                                    <div class="answer-content">
                                                        <span class="content"><?= nl2br($forumLevelTwo->content) ?></span>
                                                        <a href="javascript:void(0)" class="author mt-3 mb-3 show-member" data-member="<?= $forumLevelTwo->author ?>" data-url="<?= Url::to(['site/content', 'url' => 'memberDetails']) ?>"><?= $author->firstname ?> <?= $author->lastname ?> | <?= $authorCompany ?></a>
                                                        <hr>
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <ul class="info-list">
                                                                    <li><i class="icon-3"></i><?= strftime("%d %B %Y", $forumLevelTwo->created_at) ?></li>
                                                                    <?php
                                                                    if ($author->id == Yii::$app->user->identity->id) { ?>
                                                                        <li><a href="<?= Url::to(['site/content', 'url' => $cms->url, 'del' => $forumLevelTwo->id]) ?>"><i class="icon-19"></i>Supprimer</a></li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }
                                    } ?>

                                </div>
                            </div>
                                
                        <?php }
                    } ?>

                </div>
            </div>
        </div>
    </section>
    <!-- event-section end -->


    <!-- Modal Forum -->
    <div class="modal modal-forum fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <?php $form = ActiveForm::begin(['id' => 'forum-form']); ?>

                <?= $form->field($model, 'parentId', ['options' => ['tag' => false]])->hiddenInput()->label(false) ?>

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forumModalLabel" data-label-question="<?= Yii::t('app', "Poser une question") ?>" data-label-response="<?= Yii::t('app', "Répondre à :") ?>"><?= Yii::t('app', "Poser une question") ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Yii::t('app', "Fermer") ?>"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-6 col-sm-12 response"></div>
                            <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                <?= $form->field($model, 'title', [
                                        'template' => '{input}{label}{hint}{error}', 
                                        'options' => ['class' => 'form-group form-floating']
                                    ])->textInput([
                                        'autofocus' => true, 
                                        'class' => 'form-control form-control-edit',
                                        'placeholder' => Yii::t('app', "Titre"),
                                    ])->label(Yii::t('app', "Titre")) ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <?= $form->field($model, 'content', [
                                        'template' => '{input}{label}{hint}{error}', 
                                        'options' => ['class' => 'form-group form-floating']
                                    ])->textarea([
                                        'placeholder' => Yii::t('app', "Contenu"),
                                        'class' => 'form-control form-control-edit form-control-textarea',
                                        'rows' => 6
                                    ])->label(Yii::t('app', "Contenu")) ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group select-primary">
                                <?php 
                                $interests = Option::getOption('name', 'interests', 'select', true); ?>

                                <?= $form->field($model, 'interests', [
                                        'template' => '{input}{label}{hint}{error}', 
                                        'options' => ['class' => 'form-group form-floating']
                                    ])
                                    ->dropDownList(
                                        $interests, 
                                        [
                                            'class' => 'form-control form-control-edit w-100',
                                            'data-placeholder' => '',
                                            'multiple' => true,
                                        ]
                                    )
                                    ->label(Yii::t('app', "Sélectionnez des sujets")) ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group select-secondary">
                                <?php 
                                $products = Option::getOption('name', 'products', 'select', true); ?>

                                <?= $form->field($model, 'products', [
                                        'template' => '{input}{label}{hint}{error}', 
                                        'options' => ['class' => 'form-group form-floating']
                                    ])
                                    ->dropDownList(
                                        $products, 
                                        [
                                            'class' => 'form-control form-control-edit w-100',
                                            'data-placeholder' => '',
                                            'multiple' => true,
                                        ]
                                    )
                                    ->label(Yii::t('app', "Sélectionnez des produits")) ?>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="theme-btn btn-two float-left" data-bs-dismiss="modal"><?= Yii::t('app', "Fermer") ?></button>
                        <?= Html::submitButton(Yii::t('app', "Envoyer"), ['class' => 'theme-btn btn-one', 'name' => 'forum-button']) ?>
                    </div>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?= MemberWidget::widget() ?>
