<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\News;
use common\models\User;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value);
$newsList = News::getLastNews();
if (null !== $newsList) { ?>

    <section id="all-news<?= $position ?>" class="sidebar-page-container <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="blog-grid-content">
                        <div class="row clearfix">
                            <?php
                            foreach ($newsList as $news) {
                                $author = User::getAuthorNicename($news->author); ?>

                                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
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
                                                <div class="link"><a href="<?= Url::to(['site/content', 'url' => $news->url]) ?>"><?= Yii::t('app', "Lire la suite") ?></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->

<?php } ?>
