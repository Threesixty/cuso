<?php
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Media;
use common\components\MainHelper;

	// MainHelper::pp($items); ?>

    <span class="header-subnav--trigger hidden-lg">
        <svg width="13" height="7">
            <use xlink:href="assets/img/sprites.svg#down"></use>
        </svg>
    </span>
    <div class="header-subnav bg-white br-bl-20 br-br-20">
        <div class="header-intro hidden-xs hidden-sm hidden-md">
            <h2 class="header-intro--title"><?= $menuContent->title ?></h2>
            <div class="header-intro--summary mt-20"><?= $menuContent->summary ?></div>
        </div>
        <div class="header-link" data-column="3">
            <ul class="header-list">
                <?php
                foreach ($items as $itemTitle => $item) { ?>

                    <li>
                        <span class="button navy br-a-20"><?= $itemTitle ?></span>

                        <?php
                        if (!empty($item['children'])) { ?>
                            <ul>
                                <?php
                                foreach ($item['children'] as $content) {
                                    $currentCms = Cms::getContent($content['url']); ?>
                                    <li>
                                        <a href="<?= Url::to(['site/content', 'url' => $content['url']]) ?>"><?= $currentCms->title ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="header-download hidden-xs hidden-sm hidden-md">
            <div class="header-download--legend">Adhérez aux clubs utilisateurs de solutions Oracle</div>
            <div class="header-download--button">
                <a class="button orange reverse shadow br-a-20" href="#">Adhérer</a>
            </div>
            <div class="header-download--image backstretch bg-orange bp-rc br-bl-20 br-br-20">
                <img src="<?= Yii::$app->request->BaseUrl ?>/img/img-1.jpg" alt="" width="660" height="550">
            </div>
        </div>
    </div>