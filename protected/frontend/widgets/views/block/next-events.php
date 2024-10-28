<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Event;
use common\models\Media;
use common\components\MainHelper;

$value = JSON::decode($value);
$nextEventList = Event::getNextEventList();
if (!empty($nextEventList)) {

	$headlineEvent = $nextEventList[0];
	unset($nextEventList[0]); ?>

	<div id="next-events<?= $position ?>">

        <!-- banner-section -->
        <section class="banner-section p_relative centred">
            <?php
            if (null !== $headlineEvent->photo_id) {
                foreach (JSON::decode($headlineEvent->photo_id) as $photoId) {
                    $photo = Media::findOne($photoId);
                    if (null !== $photo) { ?>
            			<div class="bg-layer" style="background-image: url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>);"></div>
                    <?php }
                }
            } ?>
            <div class="auto-container">
                <div class="content-box">
                    <span class="date"><img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/icon-1.png" alt=""><?= MainHelper::getPrettyEventDate($headlineEvent['event']->start_datetime, $headlineEvent['event']->end_datetime) ?></span>
                    <h2><?= $headlineEvent->title ?><span><?= $headlineEvent['event']->event_type ?></span></h2>
                    <a href="<?= Url::to(['site/content', 'url' => $headlineEvent->url]) ?>" class="theme-btn btn-one">Je m'inscris</a>
                </div>
            </div>
        </section>
        <!-- banner-section end -->


        <!-- conference-section -->
        <section class="conference-section">
            <div class="outer-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 content-column">
                        <div class="content-box">
                            <h3>Informations générales:</h3>
                            <div class="inner-box">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-3"></i></div>
                                    <h4>Date :</h4>
                                    <p><?= MainHelper::getPrettyEventDate($headlineEvent['event']->start_datetime, $headlineEvent['event']->end_datetime) ?></p>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-4"></i></div>
                                    <h4>Lieu :</h4>
                                    <p><?= $headlineEvent['event']->address ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 carousel-column">
                        <div class="carousel-content">
                            <?php
                            if ($value['link'] != '') { ?>
                                <a href="<?= MainHelper::getBlockLink($value['link']) ?>" class="title-text"><?= $value['button'] ?></a>
                            <?php } ?>
                            <div class="conference-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
                            	<?php
                            	foreach ($nextEventList as $event) { ?>

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
	                                            <h3><a href="<?= Url::to(['site/content', 'url' => $event->url]) ?>"><?= $event->title ?></a></h3>
	                                            <ul class="info-list">
	                                                <li><?= MainHelper::getPrettyEventDate($event['event']->start_datetime, $event['event']->end_datetime, true) ?></li>
	                                            </ul>
	                                            <p><?= $event->summary ?></p>
	                                            <div class="link"><a href="<?= Url::to(['site/content', 'url' => $event->url]) ?>">En savoir +</a></div>
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
        <!-- conference-section end -->
    </div>
<?php } ?>