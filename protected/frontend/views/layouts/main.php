<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
use common\models\Cms;
use common\models\Option;
use common\models\Media;
use frontend\widgets\Alert;
use frontend\widgets\MegaMenuWidget;
use common\components\MainHelper;

AppAsset::register($this);

$currentContent = isset($this->params['cms']) && $this->params['cms'] ? $this->params['cms'] : false;
$menus = !empty($this->params['menus']) ? $this->params['menus'] : false;
?>

<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
	<head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="<?= $currentContent ? $currentContent->meta_description : '' ?>">
		<meta name="keywords" content="<?= Html::encode($this->title) ?>">
		<meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <?php 
        foreach ($this->params['lang'] as $lang => $value) {
        	if (!empty($value)) { ?>
        		<link rel="alternate" href="<?= Url::to(['site/'.$value['action'], 'url' => $value['url'], 'language' => $value['lang']]) ?>" hreflang="<?= $value['lang'] ?>" />
        	<?php }
        } ?>

		<!-- Open Graph -->
		<meta property="og:title" content="<?= $this->params['og']['title'] ?>"/>
		<meta property="og:description" content="<?= $this->params['og']['description'] ?>"/>
		<meta property="og:image" content="<?= $this->params['og']['image'] ?>" />
		<meta property="og:url" content="<?= $this->params['og']['url'] ?>" />
		<meta property="og:type" content="article">

        <?php $this->registerCsrfMetaTags() ?>
        <title><?= $currentContent ? Html::encode($currentContent->meta_title) : Html::encode($this->title) ?></title>

		<link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->request->BaseUrl ?>/images/favicon.png">

        <?php $this->head() ?>
	</head>
	<body class="" data-lang="<?= Yii::$app->language ?>">
        <?php $this->beginBody() ?>

        <div class="wrapper">
            <header class="header bg-white">
                <div class="header-container">
                    <div class="container container-fluid">
                        <h2 class="header-title hidden">Club utilisateurs de solutions Oracle</h2>
                        <div class="header-logo">
                            <a href="<?= Yii::$app->homeUrl ?>">
                                <img src="<?= Yii::$app->request->BaseUrl ?>/img/logo-1.png" alt="" width="160" height="70">
                            </a>
                        </div>
                        <div class="header-icon">
                            <button class="search-toggle navy" type="button">
                                <svg width="24" height="24">
                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#magnifier"></use>
                                </svg>
                            </button>
                            <button class="login-toggle hidden-lg navy" type="button">
                                <svg width="24" height="24">
                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#user"></use>
                                </svg>
                            </button>
                            <button class="header-menu--open hidden-lg" type="button">
                                <svg width="24" height="24">
                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#bar"></use>
                                </svg>
                            </button>
                            <button class="header-menu--close hidden-lg hidden" type="button">
                                <svg width="24" height="24">
                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#close"></use>
                                </svg>
                            </button>
                        </div>
                        <div class="header-menu bg-white">
                            <div class="header-group i1">
                                <div class="header-nav">
                                    <ul>
                                        <li class="<?= Yii::$app->controller->action->id == 'index' ? 'current' : '' ?>">
                                            <a href="<?= Yii::$app->homeUrl ?>"><?= Yii::t('app', "Accueil") ?></a>
                                        </li> 

                                        <?php
                                        $megaMenus = Option::getOption('name', 'megamenu', true);
                                        if ($menus && isset($menus['Menu principal']['children'])) {
                                            foreach ($menus['Menu principal']['children'] as $name => $menu) {

                                                if (isset($menu['url'])) {
                                                    $menuContent = Cms::getContent($menu['url']); ?>

                                                    <li class="<?= MainHelper::isMenuActive($menu) ?>">
                                                        <a href="<?= MainHelper::getMenuLink($menu) ?>" class="<?= isset($menu['children']) ? 'header-subnav--toggle' : '' ?>"><?= $menuContent->title ?></a>
                                                        <?php
                                                        if (isset($menu['children'])) {
                                                            $menu['id'] = null !== $menuContent->lang_parent_id ? $menuContent->lang_parent_id : $menu['id'];
                                                            if (in_array($menu['id'], array_keys($megaMenus))) {
                                                                echo MegaMenuWidget::widget([
                                                                        'name' => $megaMenus[$menu['id']],
                                                                        'menu' => $menu,
                                                                        'menuContent' => $menuContent,
                                                                        'title' => $name,
                                                                        'url' => MainHelper::getMenuLink($menu),
                                                                    ]);
                                                            }
                                                        } ?>
                                                    </li>

                                                <?php }
                                            }
                                        }

                                        if (!Yii::$app->user->isGuest) { ?>
                                            <li class="dropdown member-menu">
                                                <a href="javascript:void(0)">Espace membre</a>
                                                <ul>
                                                    <?php
                                                    if ($menus && isset($menus['Menu membres']['children'])) {
                                                        foreach ($menus['Menu membres']['children'] as $name => $menu) {

                                                            if (isset($menu['url'])) {
                                                                $menuContent = Cms::getContent($menu['url']); ?>
                                                                    <li>
                                                                        <a href="<?= Url::to(['site/content', 'url' => $menu['url']]) ?>"><?= $menuContent->title ?></a>
                                                                    </li>
                                                            <?php }
                                                        }
                                                    } ?>
                                                    <li>
                                                        <a href="<?= Url::to(['site/content', 'url' => 'logout']) ?>"><i class="fa fa-sign-out"></i> <?= Yii::t('app', "Déconnexion") ?></a>
                                                    </li>
                                                </ul>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </div>
                            </div>
                            <div class="header-group i2">
                                <div class="header-button hidden-xs hidden-sm hidden-md">
                                    <?php
                                    if (Yii::$app->user->isGuest) { ?>
                                        <a href="<?= Url::to(['site/content', 'url' => $this->params['login']->url]) ?>" class="orange thin br-a-20">
                                            <span>Connexion</span>
                                            <svg width="18" height="18">
                                                <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                            </svg>
                                        </a>
                                        <a class="orange thin br-a-20 login-toggle" href="#">
                                            <span>Connexion</span>
                                            <svg width="18" height="18">
                                                <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                            </svg>
                                        </a>
                                    <?php } ?>
                                    <a href="<?= Url::to(['site/content', 'url' => $this->params['contact']->url]) ?>" class="navy reverse thin br-a-20">Contact</a>
                                </div>
                                <!--div class="header-lang">
                                    <a href="#">En</a>
                                    <a class="active" href="#">Fr</a>
                                </div-->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- header -->
            <div class="search">
                <div class="search-wrapper">
                    <div class="container container-fixed">
                        <div class="search-container gutter-lg">
                            <button class="search-close search-toggle" type="button">
                                <svg width="20" height="20">
                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#close"></use>
                                </svg>
                            </button>
                            <div class="search-form">
                                <div class="search-form--input">
                                    <input class="br-a-20" type="text" placeholder="Votre recherche">
                                </div>
                                <div class="search-form--button">
                                    <button class="button orange icon-right shadow br-a-20" type="submit">
                                        <span>Rechercher</span>
                                        <svg width="18" height="18">
                                            <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#magnifier"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="search-recent mt-30">
                                <h3 class="search-recent--title">Vos derni&egrave;res recherches</h3>
                                <div class="search-recent--list fw-medium uppercase">
                                    <div class="tag navy">
                                        <ul>
                                            <li>
                                                <a class="br-a-4" href="#">PeopleSoft HCM</a>
                                            </li>
                                            <li>
                                                <a class="br-a-4" href="#">Oracle</a>
                                            </li>
                                            <li>
                                                <a class="br-a-4" href="#">Cloud Infrastructure</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-mask search-toggle"></div>
            </div>
            <!-- search -->
            <div class="login">
                <div class="login-wrapper">
                    <div class="container container-fixed">
                        <div class="login-container gutter-lg">
                            <button class="login-close login-toggle" type="button">
                                <svg width="20" height="20">
                                    <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#close"></use>
                                </svg>
                            </button>
                            <div class="login-recent">
                                <h3 class="login-recent--title">Connectez-vous à l'aide de vos identifiants</h3>
                            </div>
                            <div class="login-form mt-20">
                                <div class="login-form--container">
                                    <div class="login-form--input mr-10">
                                        <input class="br-a-20" type="text" placeholder="Votre email">
                                    </div>
                                    <div class="login-form--input ml-10">
                                        <input class="br-a-20" type="password" placeholder="Votre mot de passe">
                                    </div>
                                </div>
                                <a href="#" class="login-form--link mt-5">Mot de passe oublié</a>
                                <div class="login-form--button mt-20">
                                    <button class="button orange icon-right shadow br-a-20" type="submit">
                                        <span>Connexion</span>
                                        <svg width="18" height="18">
                                            <use xlink:href="<?= Yii::$app->request->BaseUrl ?>/img/sprites.svg#right"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="login-mask login-toggle"></div>
            </div>
            <!-- login -->
            <main class="main">

            <?= Alert::widget() ?>
			<?= $content ?>

                <!-- section -->
            </main>
            <!-- main -->
            <footer class="footer">
                <div class="footer-container">
                    <div class="container container-fluid">
                        <div class="footer-logo">
                            <a href="<?= Yii::$app->homeUrl ?>">
                                <img src="<?= Yii::$app->request->BaseUrl ?>/img/logo-1.png" alt="" width="160" height="70">
                            </a>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <?php
                                if ($menus && isset($menus['Menu footer 1']['children'])) {
                                    foreach ($menus['Menu footer 1']['children'] as $name => $menu) {
                                        if (isset($menu['url'])) {
                                            $menuContent = Cms::getContent($menu['url']); ?>
                                            <li>
                                                <a href="<?= MainHelper::getMenuLink($menu) ?>"><?= $menuContent->title ?></a>
                                            </li>
                                        <?php }
                                    }
                                } ?>
                            </ul>
                            <ul>
                                <?php
                                if ($menus && isset($menus['Menu footer 2']['children'])) {
                                    foreach ($menus['Menu footer 2']['children'] as $name => $menu) {
                                        if (isset($menu['url'])) {
                                            $menuContent = Cms::getContent($menu['url']); ?>
                                            <li>
                                                <a href="<?= MainHelper::getMenuLink($menu) ?>"><?= $menuContent->title ?></a>
                                            </li>
                                        <?php }
                                    }
                                } ?>
                            </ul>
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li>
                                    <a href="#" target="_blank">
                                    <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-youtube.svg" alt="Youtube" width="40" height="40">
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                    <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-linkedin.svg" alt="LinkedIn" width="32" height="32">
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                    <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-twitter.svg" alt="Twitter" width="40" height="32">
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                    <img src="<?= Yii::$app->request->BaseUrl ?>/img/ico-facebook.svg" alt="Facebook" width="16" height="32">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-info ta-center">
                    <div class="container container-fluid">
                        <?php
                        if ($menus && isset($menus['Menu bas de page']['children'])) {
                            $idx = 1;
                            foreach ($menus['Menu bas de page']['children'] as $name => $menu) {
                                if (isset($menu['url'])) {
                                    $menuContent = Cms::getContent($menu['url']); ?>
                                    <a href="<?= MainHelper::getMenuLink($menu) ?>"><?= $menuContent->title ?></a>
                                <?php }
                                if ($idx < count($menus['Menu bas de page']['children'])) {
                                    $idx++;
                                    echo ' - ';

                                }
                            }
                        } ?>
                    </div>
                </div>
            </footer>
            <!-- footer -->
        </div>
        <!-- wrapper -->
		
        <?php $this->endBody() ?>
	</body>
</html>
<?php $this->endPage() ?>