<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Hotel;
use common\models\RoomCategory;
use common\models\Media;
use common\models\Option;
use common\models\Newsletter;
use common\models\Form;
use common\models\Faq;
use common\components\MainHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        	];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
    	if (!Yii::$app->request->isAjax) {

	        $this->view->params['cms'] = null !== Yii::$app->request->get('url') || $action->id == 'index' ? Cms::getContent(Yii::$app->request->get('url')) : false;
	        $this->view->params['menus'] = MainHelper::getMenus();
	        $this->view->params['lang'] = MainHelper::getLangSwitcher($action->id);

	        // Open Graph
	        $content = $this->view->params['cms'];
			$this->view->params['og']['title'] = $content && $content->meta_title != '' ? $content->meta_title : Yii::t('app', "Bienvenue chez Hôtels Attitude");
			$this->view->params['og']['description'] =  $content && $content->meta_description != '' ? $content->meta_description : Yii::t('app', "Découvrez les hôtels Attitude à l'île Maurice");
			$this->view->params['og']['url'] = $content && $action->id != 'index' ? Url::to(['site/content', 'url' => $content->url]) : Yii::$app->request->BaseUrl;

			$this->view->params['og']['image'] = Yii::$app->request->BaseUrl.'/images/og-image.jpg';
			if (isset($content->content)) {
				$heroPic = array_filter($content->content, function($block) {
				   return ($block['block'] == 'hero-pic');
				});

	            $heroPic = array_values($heroPic);
	            if (!empty($heroPic) && isset($heroPic[0])) {
	                foreach (JSON::decode($heroPic[0]['value']['media']) as $photoId) {
	                    $photo = Media::findOne($photoId);
	                    if (null !== $photo)
	                    	$this->view->params['og']['image'] =  Yii::getAlias('@uploadWeb').'/'.$photo->path;
	                }
	            }
			}
	    }

    	if (null != Yii::$app->request->post() && isset(Yii::$app->request->post()['submit-call-me-back'])) {
        	$p = Yii::$app->request->post();

    		if (MainHelper::isAHuman('verify', trim($p['_human']))) {
    			unset($p['_human']);

        		$mailContent = 'Vous avez reçu une nouvelle demande de rappel depuis le site https://hotels-attitude.com<br><br>';
        		foreach ($p as $key => $value) {
        			if ($key != '_csrf-frontend' && $key != 'submit-call-me-back') {
            			$field = str_replace('call-me-back', '', $key);
            			$field = str_replace('-', ' ', $field);
            			$mailContent .= ucwords($field).': '.$value.'<br>';
            		}
        		}

        		$sendStatus = MainHelper::sendMail('Call me back', $mailContent);
        		if ($sendStatus) {
        			$this->view->params['cmbPopinTitle'] = Yii::t('app', "Votre demande de rappel a été envoyée avec succès !");
        			$this->view->params['cmbPopinContent'] = Yii::t('app', "Nous vous recontacterons dans les plus brefs délais.");
        		} else {
        			$this->view->params['cmbPopinTitle'] = Yii::t('app', "Une erreur s'est produite !");
        			$this->view->params['cmbPopinContent'] = Yii::t('app', "Veuillez nous contacter à resa@hotels-attitude.com.");
        		}
    		} else {
    			$this->view->params['cmbPopinTitle'] = Yii::t('app', "Une erreur s'est produite !");
    			$this->view->params['cmbPopinContent'] = Yii::t('app', "Le Captcha est invalide.");
    		}
    	}


		if (null != Yii::$app->request->post() && isset(Yii::$app->request->post()['newsletter-email'])) {

			$nlEmail = Yii::$app->request->post()['newsletter-email'];
	    	$newsletter = Newsletter::findOne(['email' => $nlEmail]);
	    	if (null === $newsletter) {
		    	$newsletter = new Newsletter();
	    	}
		    $newsletter->email = $nlEmail;
		    $newsletter->maurician = Yii::$app->request->post()['newsletter-isMauritian'];
		    $newsletter->types = Yii::$app->request->post()['newsletter-type'];
		    $newsletter->date = date('d/m/Y');
		    $newsletter->lang = strtoupper(Yii::$app->language);
		    $newsletterStatus = $newsletter->save();

		    // Send mail
			$res = Yii::$app
	            ->mailer
	            ->compose(
	                ['html' => 'welcome-'.Yii::$app->language.'-html'],
	            )
	            ->setFrom(['resaweb@hotels-attitude.com' => 'Hôtels Attitude'])
	            ->setTo($nlEmail)
	            ->setSubject('🌴 '.Yii::t('app', 'Bravo, vous êtes inscrit !'))
	            ->send();

    		$this->view->params['nlSaved'] = true;
    		if ($newsletterStatus) {
    			$this->view->params['nlPopinTitle'] = Yii::t('app', "Vous êtes inscrit !");
    			$this->view->params['nlPopinContent'] = Yii::t('app', "Votre demande d'inscription à notre newsletter à bien été prise en compte. Merci.");
    		} else {
    			$this->view->params['nlPopinTitle'] = Yii::t('app', "Une erreur s'est produite !");
    			$this->view->params['nlPopinContent'] = Yii::t('app', "Veuillez nous contacter à resa@hotels-attitude.com.");
    		}
		}

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
                'cms' => Cms::getContent(),
            ]);
    }

    /**
     * Displays cms contents.
     *
     * @return mixed
     */
    public function actionContent()
    {
        $currentContent = Cms::getContent(Yii::$app->request->get('url'));
        if ($currentContent) {
	        $view = $currentContent->template != '' ? $currentContent->template : 'content';

	        $args = [
	                'cms' => $currentContent,
	                'mailSent' => false,
	            ];

	        switch ($view) {
	            case 'form/global-quote':
	            case 'form/event-quote':
	            case 'form/event-global-quote':

	            	$type = 'global';
	            	if ($view == 'form/global-quote') {
						$args['optionNames'] = Option::getOption('name', 'hotel-category', true, false, true);
			    		foreach (Hotel::getHotelsByLang() as $hotel) {
			    		 	$args['hotelsByCat'][$hotel->category][] = $hotel;
			    		}
	            	}
					if ($view == 'form/event-quote' && null !== $currentContent->hotel) {
	            		$type = 'event';
						$args['hotel'] = Hotel::getHotelById($currentContent->hotel);
						$args['events'] = Cms::getCmsByTag('events');
						$args['rooms'] = RoomCategory::getRoomCategoriesByHotelId($currentContent->hotel);
					}
	            	if ($view == 'form/event-global-quote') {
	            		$type = 'event_global';
	            		$args['hotelList'] = Hotel::getHotels();
						$args['events'] = Cms::getCmsByTag('events');
						$args['rooms'] = RoomCategory::getRoomCategories();
	            	}

	            	if (null != Yii::$app->request->post() && isset(Yii::$app->request->post()['quote-firstname'])) {

	            		$args['mailSent'] = Form::send(Yii::$app->request->post(), $type, $view);
	            		if ($args['mailSent']) {
	            			$args['popinTitle'] = Yii::t('app', "Votre demande de devis a été envoyée avec succès !");
	            			$args['popinContent'] = Yii::t('app', "Nous vous répondrons dans les plus brefs délais.");
	            		} else {
	            			$args['popinTitle'] = Yii::t('app', "Une erreur s'est produite !");
	            			$args['popinContent'] = Yii::t('app', "Veuillez nous contacter à resa@hotels-attitude.com.");
	            		}
	            	}
	                break;

	            case 'form/contact-us':
	            	$args['hotelList'] = Hotel::getHotels(true);
	            	$args['quoteForm'] = Cms::getCmsByTag('global-quote', true);
	            	$args['quoteEventForm'] = Cms::getCmsByTag('event-global-quote', true);
	                break;

	            case 'faq':
	            	// Generic
    				$generic = Cms::getCmsByTemplate('faq', null, false, true);
    				$args['generic'] = $generic
								->andWhere(['like', 'content', '"hotel":"general"'])
								->andWhere(['like', 'content', '"category":"most-asked"'])
								->one();
	            	// Hotels
	            	$hotels = Hotel::getHotels();
	            	if (null !== $hotels) {
	            		$args['hotelList'] = [];
	            		foreach ($hotels as $hotel) {
	            			$cat = Option::getOptionLabel('hotel-category', $hotel->category);
	            			if ($cat) {
	            				$hotelMostAsked = Cms::getCmsByTemplate('faq', null, false, true);
	            				$hotelMostAsked = $hotelMostAsked
	            									->andWhere(['like', 'content', '"hotel":"'.$hotel->id.'"'])
	            									->andWhere(['like', 'content', '"category":"most-asked"'])
	            									->one();
	            				if (null !== $hotelMostAsked) {
	            					$args['hotelList'][$cat][] = ['name' => $hotel->name, 'content' => $hotelMostAsked];
	            				}
	            			}
	            		}
	            	}

	            	// Categories
	            	$args['faqCategories'] = Option::getOption('name', 'faq-categories', null, false, true);

	            	// Search
	            	if (null !== Yii::$app->request->get('q')) {

	            		$hotel = $args['cms']->content[0]['value']['hotel'];
	            		$search = Faq::searchFaq($hotel, Yii::$app->request->get('q'));

	            		if (!empty($search)) {
	            			$args['search'] = $search;
	            		} else {
	            			$args['search'] = Faq::getFaqByHotelAndCategory($hotel, 'most-asked', Yii::$app->language);
	            			$args['noMatch'] = true;
	            		}
	            	}

	                break;
	            
	            default:
	                break;
	        }

	        return $this->render($view, $args);
	    } else {

        	$redirect = Cms::getContentRedirect(Yii::$app->request->get('url'));
        	if ($redirect)
        		return $this->redirect(['site/content', 'url' => $redirect->url]);

	        return $this->render('error');
	    }
    }

    /**
     * Error.
     *
     * @return mixed
     */
    public function actionError()
    {
	   	return $this->render('error');
    }
}
