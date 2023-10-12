<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\MainWidget;
use common\models\Cms;
use common\models\Option;
use common\models\Media;
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
		<meta name="description" content="<?= $currentContent ? $currentContent->meta_description : '' ?>">
		<meta name="keywords" content="<?= Html::encode($this->title) ?>">
		<meta name="robots" content="index, follow">
		<meta name="viewport" content="width=device-width, initial-scale=1">

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

		<!-- FB verify domain -->
		<meta name="facebook-domain-verification" content="j3n7v2bib0pij0b53hswstjjk6k6a4" />

        <?php $this->registerCsrfMetaTags() ?>
        <title><?= $currentContent ? Html::encode($currentContent->meta_title) : Html::encode($this->title) ?></title>

		<link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->request->BaseUrl ?>/images/favicon.png">

		<!-- Début de la mention CookiePro de consentement aux cookies du domaine : hotels-attitude.com -->
		<script type="text/javascript" src="https://cookie-cdn.cookiepro.com/consent/490f5b18-6d17-496c-9f73-5e9c94d6924c/OtAutoBlock.js" ></script>
		<script src="https://cookie-cdn.cookiepro.com/scripttemplates/otSDKStub.js"  type="text/javascript" charset="UTF-8" data-domain-script="490f5b18-6d17-496c-9f73-5e9c94d6924c" ></script>
		<script type="text/javascript">
		function OptanonWrapper() { }
		</script>
		<!-- Fin de la mention CookiePro de consentement aux cookies du domaine : hotels-attitude.com -->

		<!-- Google Tag Manager -->
		<script>
			window.dataLayer = window.dataLayer || [];
		</script>
	    <script>
	        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	        })(window,document,'script','dataLayer','GTM-NNGWZTT');
	    </script>
	    <!-- End Google Tag Manager -->

	    <!-- Facebook Pixel Code -->
	    <script>
	        !function(f,b,e,v,n,t,s)
	        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	        n.queue=[];t=b.createElement(e);t.async=!0;
	        t.src=v;s=b.getElementsByTagName(e)[0];
	        s.parentNode.insertBefore(t,s)}(window, document,'script',
	        'https://connect.facebook.net/en_US/fbevents.js');
	        fbq('init', '587647358111631');
	        fbq('track', 'PageView');
	    </script>
	    <noscript><img height="1" width="1" style="display:none"
	        src="https://www.facebook.com/tr?id=587647358111631&ev=PageView&noscript=1"
	    /></noscript>
	    <!-- End Facebook Pixel Code -->

        <?php $this->head() ?>
	</head>
	<body class="" data-lang="<?= Yii::$app->language ?>">
        <?php $this->beginBody() ?>

		<div class="wrapper">
			<div class="top-links lightgray-bg hide-on-mobile">
				<div class="container fs-12 flex center-aligned-vert">
					<ul class="flex">
						<li class="wisepops">
							<a href="javascript:void(0)" class="wisp">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/wisp.svg" alt="" class="inline-block" width="24" height="24" >
							</a>
						</li>
						<?php
						if (isset($cmsContents['contact-us']) && null !== $cmsContents['contact-us']) { ?>
							<li><a href="<?= Url::to(['site/content', 'url' => $cmsContents['contact-us']->url]) ?>"><?= $cmsContents['contact-us']->title ?></a></li>
						<?php } ?>
						<li><a href="#call-us" class="show-modal gtm-clic" data-event="call_us_popin_open"><?= Yii::t('app', "Appelez-nous") ?></a></li>
						<?php
						if (isset($cmsContents['global-quote']) && null !== $cmsContents['global-quote']) { ?>
							<li><a href="<?= Url::to(['site/content', 'url' => $cmsContents['global-quote']->url]) ?>"><?= $cmsContents['global-quote']->title ?></a></li>
						<?php } ?>
					</ul>
					<?php
					if (!empty($this->params['lang'])) { ?>

						<div class="language-switcher relative">
							<a href="#">
								<span><?= ucfirst(str_replace('_', '-', Yii::$app->language)) ?></span>
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/dropdown-arrow-black.svg" alt="" class="inline-block">
							</a>
							<ul class="hidden absolute white-bg fs-14 border-1-light">
	                            <?php 
	                            foreach ($this->params['lang'] as $lang => $value) {
	                            	if (!empty($value)) { ?>
		                                <li class="<?= $value['lang'] == Yii::$app->language ? 'active' : '' ?>">
		                                	<a href="<?= Url::to(['site/'.$value['action'], 'url' => $value['url'], 'language' => $value['lang']]) ?>" class="block"><?= ucfirst(str_replace('_', '-', $lang)) ?></a>
		                                </li>
	                            	<?php }
	                            } ?>
							</ul>
						</div>

					<?php } ?>
				</div>
			</div>
			
			<div class="top-nav-bar white-bg">
				<div class="container">	
					<div class="top-navigation flex">
						<div class="logo">
							<a href="<?= Yii::$app->homeUrl ?>" class="block">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/logo-blue.png" alt="Attitude Hotels" title="Attitude Hotels" class="full-width block">
							</a>
						</div>
						
						<input type="checkbox" id="open-burger-menu" class="open-burger-menu display-none">
						<label for="open-burger-menu" class="burger-menu-icon absolute display-none">
							<em class="block relative darkgray-bg"></em>
							<em class="block relative darkgray-bg"></em>
							<em class="block relative darkgray-bg"></em>
						</label>
						
						<ul class="flex center-aligned-vert fs-15">

                            <?php
                            $megaMenus = Option::getOption('name', 'megamenu', true);
                            if ($menus && isset($menus['Menu principal']['children'])) {
                                foreach ($menus['Menu principal']['children'] as $name => $menu) {

                                	if (isset($menu['url'])) {
			                    		$menuContent = Cms::getContent($menu['url']); ?>

	                                    <li class="megamenu-item <?= isset($menu['children']) ? 'has-child' : '' ?>">
	                                        <a href="<?= MainHelper::getMenuLink($menu) ?>" class="<?= MainHelper::isMenuActive($menu) ?> hide-on-mobile"><?= $menuContent->title == 'Positive Impact' ? '<img src="'.Yii::$app->request->BaseUrl.'/images/positiveimpact.svg" alt="'.$menuContent->title.'" height="21">' : $menuContent->title ?></a>
	                                        <a href="<?= isset($menu['children']) ? 'javascript:void(0);' : MainHelper::getMenuLink($menu)  ?>" class="<?= MainHelper::isMenuActive($menu) ?> display-none show-on-mobile"><?= $menuContent->title == 'Positive Impact' ? '<img src="'.Yii::$app->request->BaseUrl.'/images/positiveimpact.svg" alt="'.$menuContent->title.'" height="28">' : $menuContent->title ?></a>
	                                        <?php            
	                                        if (isset($menu['children'])) {
	                                        	$menu['id'] = null !== $menuContent->lang_parent_id ? $menuContent->lang_parent_id : $menu['id'];

	                                            if (in_array($menu['id'], array_keys($megaMenus))) {

											        echo MegaMenuWidget::widget([
											                'name' => $megaMenus[$menu['id']],
											                'menu' => $menu,
											                'title' => $name,
											                'url' => MainHelper::getMenuLink($menu),
											            ]);
	                                           	} ?>
	                                        <?php } ?>
	                                    </li>

                                	<?php }
                                }
                            } ?>

							<li>
								<a href="#" class="show-filter-bar ah-btn border-rad-4 flex center-aligned-vert white-text darkgray-bg hide-on-mobile"><?= Yii::t('app', "Réserver") ?></a>
							</li>
							<li class="very-top-links display-none show-on-mobile">
								<div class="flex">
									<a href="#call-us" class="ah-btn border-rad-4 flex center-aligned-vert border-1 darkgray-text fs-14 center-aligned-hor show-modal gtm-clic" data-event="call_us_popin_open"><?= Yii::t('app', "Appelez-nous") ?></a>
									<?php
									if (isset($cmsContents['global-quote']) && null !== $cmsContents['global-quote']) { ?>
										<a href="<?= Url::to(['site/content', 'url' => $cmsContents['global-quote']->url]) ?>" class="ah-btn border-rad-4 flex center-aligned-vert border-1 darkgray-text fs-14 center-aligned-hor"><?= $cmsContents['global-quote']->title ?></a>
									<?php } ?>
								</div>
								<?php
								if (!empty($this->params['lang'])) { ?>

									<div class="language-switcher relative">
										<a href="#">
											<span><?= ucfirst(str_replace('_', '-', Yii::$app->language)) ?></span>
											<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/dropdown-arrow-black.svg" alt="" class="inline-block">
										</a>
										<ul class="hidden absolute white-bg fs-14 border-1-light">
				                            <?php 
				                            foreach ($this->params['lang'] as $lang => $value) {
				                            	if (!empty($value)) { ?>
					                                <li class="<?= $value['lang'] == Yii::$app->language ? 'active' : '' ?>">
					                                	<a href="<?= Url::to(['site/'.$value['action'], 'url' => $value['url'], 'language' => $value['lang']]) ?>" class="block"><?= ucfirst(str_replace('_', '-', $lang)) ?></a>
					                                </li>
					                            <?php }
					                        } ?>
										</ul>
									</div>

								<?php } ?>
							</li>
						</ul>
						<div class="mobile-wisepops flex">
							<a href="javascript:void(0)" class="wisp ah-btn center-aligned-vert display-none show-on-mobile">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/wisp.svg" alt="" class="inline-block" width="25" height="25" >
							</a>
							<a href="javascript:void(0);" id="activate-ah-filter" class="ah-btn border-rad-4 center-aligned-vert white-text darkgray-bg fs-14 display-none show-on-mobile"><?= Yii::t('app', "Réserver") ?></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="booking-bar pt-5 pb-10 white-bg display-none show-on-mobile">
				<div class="container">
			        <?=  MainWidget::widget([
			                'name' => 'booking-bar',
			            ]); ?>
				</div>
			</div>
			
			<?php
			if ($hotel) {
				$menusOption = Option::getOption('name', 'menus' , true); ?>

				<div class="hotel-top-bar" style="<?= $hotel->color != '' ? 'background-color: '.$hotel->color : '' ?>">
					<div class="container">
						<div class="top-navigation">
							<div class="pt-10 pb-10 flex center-aligned-vert">
								<div class="logo">
									<a href="#" class="block">
					                    <?php
					                    if (null !== $hotel->logo) {
					                        foreach (JSON::decode($hotel->logo) as $key => $photoId) {
					                            $photo = Media::findOne($photoId);
					                            if (null !== $photo) { ?>
					                                <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="" title="" class="full-width block">
					                            <?php }
					                        }
					                    } ?>
									</a>
								</div>
								<a href="#" class="show-booking-bar ah-btn border-rad-4 flex center-aligned-vert white-text darkgray-bg hide-on-mobile"><?= Yii::t('app', "Réserver") ?></a>
								<span class="fs-15 bold-text darkgray-text position-relative">
									<?= Yii::t('app', 'À partir de') ?> <?= $hotel->price ?>/<?= Yii::t('app', 'nuit') ?>/Pers.
									<?php
									if ($hotel->price_text != '') { ?>
										<img src="<?= Yii::$app->request->BaseUrl ?>/images/info-icon.png" class="info-icon" title="<?= htmlspecialchars($hotel->price_text) ?>">
									<?php } ?>
								</span>
							</div>
						</div>
					</div>
					<div class="top-navigation relative">
						<input type="checkbox" id="hotel-selected-dropdown" class="display-none">
						<label for="hotel-selected-dropdown" class="hotel-selected-dropdown display-none show-on-mobile">
							<div class="hotel-selected-dropdown-active flex half-width center-aligned-vert fs-15 darkgray-text bold-text">
								<span class="ellipsis"><?= $this->params['cms']->title ?></span>
								<span class="hotel-selected-dropdown-arrow"></span>
							</div>
							<div class="half-width"><a href="javascript:void(0);" id="activate-ah-filter-alt" class="ah-btn border-rad-4 flex center-aligned-vert white-text darkgray-bg display-none show-on-mobile"><?= Yii::t('app', "Réserver") ?></a></div>
						</label>
						<ul class="flex fs-15 hide-on-mobile nowrap">
							<?php
							$hotelId = null !== $hotel->lang_parent_id ? $hotel->lang_parent_id : $hotel->id;
			                if ($menus && isset($menus[$menusOption[$hotelId]]['children'])) {
			                    foreach ($menus[$menusOption[$hotelId]]['children'] as $name => $menu) {
			                    	if (isset($menu['url'])) {
			                    		$menuContent = Cms::getContent($menu['url']); ?>

										<li>
											<a href="<?= Url::to(['site/content', 'url' => $menu['url']]) ?>" class="<?= $menu['url'] == $this->params['cms']->url ? 'bold-text' : '' ?>"><?= $menuContent->title ?></a>
										</li>
			                    	<?php }
			                    }
			                } ?>
						</ul>
					</div>
				</div>

				<div class="booking-bar book-now-bar pt-15 pb-30 white-bg display-none show-on-mobile">
					<div class="container">
				        <?=  MainWidget::widget([
				                'name' => 'hotel-booking-bar',
				                'hotel' => $hotel,
				            ]); ?>
					</div>
				</div>

			<?php } ?>
			
			<div class="main">

				<?= $content ?>

				<div class="newsletter-subscription flex lightgray-bg" <?= $hotel && $hotel->color_newsletter != '' ? 'style="background-color: '.$hotel->color_newsletter.'"' : '' ?>>
					<div class="container">
						<div class="flex bottom-aligned relative center-aligned-hor">
							<div class="newsletter-subscription-icon absolute"><img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/jellyfish-1.png" alt="" class="block"></div>
							<div class="newsletter-subscription-title">
								<strong class="block bold-text"><?= Yii::t('app', "Recevez nos actualités et offres spéciales") ?></strong>
								<strong class="block mb-10 bold-text"><?= Yii::t('app', "Pour rêver, s’informer, et voyager") ?></strong>
								<div class="experience-in-mauritius"><p><?= Yii::t('app', "Souscrire à notre newsletter") ?></p></div>
							</div>
							<div class="newsletter-subscription-form">

						        <!--begin::Form-->
						        <?php $form = ActiveForm::begin(['id' => 'form-newsletter', 'options' => ['class' => 'flex bottom-aligned', 'data-parsley-validate' => true]]); ?>
									<input type="hidden" name="newsletter-isMauritian" value="">
									<input type="hidden" name="newsletter-type" value="">

									<label>
										<span class="block mb-5 fs-14 darkgray-text bold-text lh-20"><?= Yii::t('app', "Votre Email") ?></span>
										<input type="email" name="newsletter-email" class="border-1" required>
									</label>
									<a href="#newsletter-mauritian-citizen" class="ah-btn border-rad-4 flex center-aligned-vert center-aligned-hor show-nl-modal"><?= Yii::t('app', "S'inscrire") ?></a>
						        <?php ActiveForm::end(); ?>
						        <!--end::Form-->

							</div>
							<div class="newsletter-subscription-icon absolute"><img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/jellyfish-2.png" alt="" class="block"></div>
						</div>
					</div>
				</div>

				<?php
				if (isset($this->params['nlSaved']) && $this->params['nlSaved']) { ?>

					<div class="ah-popup-layer absolute flex center-aligned-hor center-aligned-vert modal cover-body">
						<div class="ah-popup-content call-up-popup get-quote-popup white-bg relative centered-text full-width">
							<div class="ah-popup-top">
								<a href="#" class="ah-popup-close block absolute"></a>
							</div>
							<div class="ah-popup-inner">
								<div>
									<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/get-a-quote-popup.png" alt="" class="block margin-auto-hor">
									<span class="block mt-10 mb-20 fs-18 darkgray-text"><?= $this->params['nlPopinTitle'] ?></span>
									<span class="fs-14 lh-20"><?= $this->params['nlPopinContent'] ?></span>
								</div>
								<div class="flex mt-30 center-aligned-hor">
									<a href="#" class="ah-btn small-ah-btn fs-14 border-rad-4 flex center-aligned-vert center-aligned-hor border-1 darkgray-text popup-close">OK</a>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>
			</div>
			
			<div class="widget-area blue-bg" <?= $hotel && $hotel->color_footer1 != '' ? 'style="background-color: '.$hotel->color_footer1.'"' : '' ?>>
				<div class="container flex pt-50 pb-50 fs-15 white-text">
					<div class="logo flex flex-3">
						<span class="block text-center">
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/logo-white.png" alt="Attitude Hotels" title="Attitude Hotels"  class="full-width block">
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/attitude-award.svg" alt="2021 Travellers' Choice" title="Attitude Hotels"  class="mw-70 mt-40">
						</span>
						<a href="#" class="scroll-up display-none"></a>
					</div>
					<div class="flex-3">
						<strong class="block mb-10 fs-14 lh-20 uppercase"><?= Yii::t('app', "Contact") ?></strong>
						<ul class="flex flex-wrap pb-5">
							<?php
							if (isset($cmsContents['contact-us']) && null !== $cmsContents['contact-us']) { ?>
								<li class="half-width">
									<a href="<?= Url::to(['site/content', 'url' => $cmsContents['contact-us']->url]) ?>"><?= $cmsContents['contact-us']->title ?></a>
								</li>
							<?php } ?>
							<li class="half-width">
								<a href="#call-us" class="show-modal gtm-clic" data-event="call_us_popin_open"><?= Yii::t('app', "Appelez-nous") ?></a>
							</li>
							<?php
							if (isset($cmsContents['global-quote']) && null !== $cmsContents['global-quote']) { ?>
								<li class="half-width">
									<a href="<?= Url::to(['site/content', 'url' => $cmsContents['global-quote']->url]) ?>"><?= $cmsContents['global-quote']->title ?></a>
								</li>
							<?php } ?>
							<li class="half-width">
								<a href="#call-me-back" data-event="call_me_back_popin_open" class="show-modal gtm-clic"><?= Yii::t('app', "Appelez-moi") ?></a>
							</li>
						</ul>
						<div class="social-media-icons flex center-aligned-vert mt-20">
							<a href="https://www.facebook.com/HotelsAttitude" target="_blank">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/facebook.svg" alt="" class="block">
							</a>
							<a href="https://www.instagram.com/attitudehotels/" target="_blank">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/instagram.svg" alt="" class="block">
							</a>
							<a href="https://www.youtube.com/user/HotelsAttitude" target="_blank">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/youtube.svg" alt="" class="block">
							</a>
							<a href="https://open.spotify.com/user/316s3negl6txk4btsa47x6brnwzu?si=7ccc1a1f584e481d&nd=1" target="_blank">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/spotify.png" alt="" class="block">
							</a>
						</div>
					</div>
					<div class="flex-1-5">
						<strong class="block mb-10 fs-14 lh-20 uppercase"><?= Yii::t('app', "Attitude") ?></strong>
						<ul>

	                        <?php
	                        if ($menus && isset($menus['MENU FOOTER - Attitude']['children'])) {
	                            foreach ($menus['MENU FOOTER - Attitude']['children'] as $name => $menu) {
	                            	if (isset($menu['url'])) {
			                    		$menuContent = Cms::getContent($menu['url']); ?>
										<li>
											<a href="<?= MainHelper::getMenuLink($menu) ?>"><?= $menuContent->title ?></a>
											<?php
											if (isset($menu['children'])) { ?>
												<ul class="sub">
													<?php
		                            				foreach ($menu['children'] as $subName => $subMenu) {
						                            	if (isset($menu['url'])) {
								                    		$subMenuContent = Cms::getContent($subMenu['url']); ?>
															<li class="full-width">
																<a href="<?= MainHelper::getMenuLink($subMenu) ?>"><?= $subMenuContent->title ?></a>
															</li>
		                            					<?php }
		                            				} ?>
	                            				</ul>
	                            			<?php } ?>
										</li>
	                            	<?php }
	                            }
	                        } ?>
							<li><a href="https://careers.hotels-attitude.com/" target="_blank"><?= Yii::t('app', "Nous recrutons !") ?></a></li>
						</ul>
					</div>
					<div class="flex-1-5">
						<strong class="block mb-10 fs-14 lh-20 uppercase"><?= Yii::t('app', "Restez connecté") ?></strong>
						<ul>
							<li>
								<a href="https://enjoymaurice.com/" target="_blank"><?= Yii::t('app', "Blog") ?></a>
							</li>
							<li>
								<a href="https://enjoymaurice.com/?_sft_category=podcast-fr" target="_blank"><?= Yii::t('app', "Podcast") ?></a>
							</li>
						</ul>
					</div>
					<div class="flex flex-col">
						<strong class="block mb-10 fs-14 lh-20 uppercase"><?= Yii::t('app', "Réservations") ?></strong>
						<ul>
							<li><a href="https://booking.hotels-attitude.com/?&chain=14463&configcode=ATTITUDE&dest=ATTITUDE&level=chain&themecode=ATTITUDE" target="_blank"><?= Yii::t('app', "Gérer mes réservations") ?></a></li>
						</ul>
						<div class="widget-area-logos flex right-aligned center-aligned-vert">
							<a href="https://travelifestaybetter.com" target="_blank">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/gold-travel-live-white.png" alt="" class="block hide-on-mobile">
							</a>
							<a href="https://travelifestaybetter.com" target="_blank">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/gold-travel-live-white-mobile.png" alt="" class="block display-none show-on-mobile">
							</a>
							<a href="https://madeinmoris.mu/propos">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/made-in-morris-white.png" alt="" class="block hide-on-mobile">
							</a>
							<a href="https://madeinmoris.mu/propos">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/widget-area/made-in-morris-white-mobile.png" alt="" class="block display-none show-on-mobile">
							</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="footer" <?= $hotel && $hotel->color_footer2 != '' ? 'style="background-color: '.$hotel->color_footer2.'"' : '' ?>>
				<div class="container flex fs-12 center-aligned-vert">
					<ul class="flex">
                        <?php
                        if ($menus && isset($menus['MENU FOOTER - Mentions']['children'])) {
                            foreach ($menus['MENU FOOTER - Mentions']['children'] as $name => $menu) {
                            	if (isset($menu['url'])) {
		                    		$menuContent = Cms::getContent($menu['url']); ?>
									<li>
										<a href="<?= MainHelper::getMenuLink($menu) ?>"><?= $menuContent->title ?></a>
									</li>
                            	<?php }
                            }
                        } ?>
					</ul>
					<?php
					if (!empty($this->params['lang'])) { ?>

						<div class="language-switcher relative right-aligned">
							<a href="#">
								<span><?= ucfirst(str_replace('_', '-', Yii::$app->language)) ?></span>
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/dropdown-arrow-black.svg" alt="">
							</a>
							<ul class="hidden absolute white-bg fs-14 border-1-light">
	                            <?php 
	                            foreach ($this->params['lang'] as $lang => $value) {
	                            	if (!empty($value)) { ?>
		                                <li class="<?= $value['lang'] == Yii::$app->language ? 'active' : '' ?>">
		                                	<a href="<?= Url::to(['site/'.$value['action'], 'url' => $value['url'], 'language' => $value['lang']]) ?>" class="block"><?= ucfirst(str_replace('_', '-', $lang)) ?></a>
		                                </li>
	                            	<?php }
	                            } ?>
							</ul>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>

		<a href="javascript:void(0)" id="zendeskButton" onclick="openWidget()" data-event="chat_opened" class="gtm-clic">
			<img src="<?= Yii::$app->request->BaseUrl ?>/images/zendesk-chat-bubble.svg" width="50">
		</a>

        <?=  MainWidget::widget([
                'name' => 'call-us',
            ]); ?>

        <?=  MainWidget::widget([
                'name' => 'call-me-back',
            ]); ?>

        <?=  MainWidget::widget([
                'name' => 'mauritian-citizen',
            ]); ?>

        <?=  MainWidget::widget([
                'name' => 'newsletter-mauritian-citizen',
            ]); ?>

        <?=  MainWidget::widget([
                'name' => 'full-media',
            ]); ?>

		
        <?php $this->endBody() ?>

        <?php 
        if (isset($currentContent->markup) && null !== $currentContent->markup) {
        	echo $currentContent->markup;
        }
        if ($hotel) { ?>
	        <script src="<?= $hotel->the_hotels_network ?>" async></script>
		<?php } ?>

        <!-- Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNGWZTT" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!-- End Google Tag Manager (noscript) -->

		<!-- Start of hotelsattitude Zendesk Widget script -->
		<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var e=this.createElement("script");n&&(this.domain=n),e.id="js-iframe-async",e.src="https://assets.zendesk.com/embeddable_framework/main.js",this.t=+new Date,this.zendeskHost="hotelsattitude.zendesk.com",this.zEQueue=a,this.body.appendChild(e)},o.write('<body onload="document._l();">'),o.close()}();
		    /*]]>*/</script>
		<script type="text/javascript">
			zE('webWidget', 'hide');

			function openWidget() {
				zE("webWidget", "show");
				zE("webWidget", "open");
				document.querySelector('#zendeskButton').style.opacity = 0;
			};

			zE('webWidget:on', 'close', function() {
				zE('webWidget', 'hide');
				document.querySelector('#zendeskButton').style.opacity = 1;
			});
		</script>
		<!-- End of hotelsattitude Zendesk Widget script -->

		<!-- Triptease Code -->
		<script>(function(a,b){var c=a.createElement("script");c.src="https://onboard.triptease.io/bootstrap.js?integrationId="+b,c.defer=true,c.async=true,c.type="text/javascript";var d=document.getElementsByTagName("script")[0];d.parentNode.insertBefore(c,d)})(document,"01DEY7SMS9ZNRS39JYMPGYTJF7");</script>
		<!-- End Triptease Code -->

		<!-- Wisepops Code -->
		<script data-cfasync="false">(function(W,i,s,e,P,o,p){W['WisePopsObject']=P;W[P]=W[P]||function(){(W[P].q=W[P].q||[]).push(arguments)},W[P].l=1*new Date();o=i.createElement(s),p=i.getElementsByTagName(s)[0];o.defer=1;o.src=e;p.parentNode.insertBefore(o,p)})(window,document,'script','//loader.wisepops.com/get-loader.js?v=1&site=9mG3z87mNt','wisepops');</script>
		<script>(function(w,i,s,p){a=document.createElement("script");a.src=w+"/embed?website_id="+i;a.onload=function(){wisp.start(w,i,s,p);};document.head.appendChild(a);})("https://notifications.wisepops.com", "3aQN");</script><!-- For test use "xayo" -->
		<!-- End Wisepops Code -->
	</body>
</html>
<?php $this->endPage() ?>