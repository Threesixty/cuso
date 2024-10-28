<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\News;
use common\models\User;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value);
$lastNews = News::getLastNews(3); ?>


    <!-- conference-style-two -->
    <section id="next-news<?= $position ?>" class="conference-style-two pt_120 pb_120">
        <div class="bg-layer" style="background-image: url(<?= Yii::$app->request->BaseUrl ?>/images/background/error-bg.jpg);"></div>
        <div class="auto-container">
            <div class="title-inner mb_60">
                <div class="sec-title mb_20 light">
                    <h2><?= $value['title'] ?></h2>
                </div>
                <?= $value['subtitle'] ?>
            </div>
            <div class="row clearfix">

                <?php
                if (!empty($lastNews)) {
                    foreach ($lastNews as $news) {
                        $author = User::getAuthorNicename($news->author); ?>

                        <div class="col-lg-4 col-md-6 col-sm-12 conference-block">
                            <div class="conference-block-one">
                                <div class="inner-box">
                                    <?php
                                    if (null !== $news->photo_id) {
                                        foreach (JSON::decode($news->photo_id) as $photoId) {
                                            $photo = Media::findOne($photoId);
                                            if (null !== $photo) { ?>
                                                <figure class="image-box"><img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->alt ?>"></figure>
                                            <?php }
                                        }
                                    } ?>
                                    <div class="lower-content">
                                        <ul class="info-list">
                                            <li><?= strftime('%d %B %Y', $news->start_date) ?></li>
                                            <?php
                                            if ($author) { ?>
                                                <li>|</li>
                                                <li><?= $author ?></a></li>
                                            <?php } ?>
                                        </ul>
                                        <h3><a href="<?= Url::to(['site/content', 'url' => $news->url]) ?>"><?= $news->title ?></a></h3>
                                        <p><?= $news->summary ?></p>
                                        <div class="link"><a href="<?= Url::to(['site/content', 'url' => $news->url]) ?>">En savoir +</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                } ?>

            </div>
            <?php
            if ($value['link'] != '') { ?>
                <div class="centred mt_60">
                    <a href="<?= MainHelper::getBlockLink($value['link']) ?>" class="theme-btn btn-one"><?= $value['button'] ?></a>  
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- conference-style-two end -->