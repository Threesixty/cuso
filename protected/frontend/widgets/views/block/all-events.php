<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Event;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value);
$eventList = Event::getNextEventList();
if (null !== $eventList) { ?>

    <section id="all-events<?= $position ?>" class="sidebar-page-container <?= $position == 0 ? 'pt_140' : 'pt_20' ?> pb_20">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="blog-grid-content">
                        <div class="row clearfix">
                            <?php
                            foreach ($eventList as $event) { ?>

                                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                                    <div class="conference-block-one">
                                        <div class="inner-box">
                                            <?php
                                            if (null !== $event->photo_id) {
                                                foreach (JSON::decode($event->photo_id) as $photoId) {
                                                    $photo = Media::findOne($photoId);
                                                    if (null !== $photo) { ?>
                                                        <figure class="image-box"><img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="<?= $photo->alt ?>"></figure>
                                                    <?php }
                                                }
                                            } ?>
                                            <div class="lower-content">
                                                <ul class="info-list">
                                                    <li><?= MainHelper::getPrettyEventDate($event['event']->start_datetime, $event['event']->end_datetime) ?></li>
                                                </ul>
                                                <h3><a href="<?= Url::to(['site/content', 'url' => $event->url]) ?>"><?= $event->title ?></a></h3>
                                                <p><?= $event->summary ?></p>
                                                <div class="link"><a href="<?= Url::to(['site/content', 'url' => $event->url]) ?>"><?= Yii::t('app', "En savoir +") ?></a></div>
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
