<?php
namespace console\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\console\Controller;
use common\models\Cms;
use common\models\Faq;
use common\models\Hotel;
use common\models\Update;
use common\components\MainHelper;

/**
 * Test controller
 */
class CronController extends Controller {

    public function actionIndex() {

    }

    public function actionSitemap() {

    	$sitemapArr = $allContentsByLang = [];
    	$allContents = Cms::find()->where(['status' => 1])->andWhere(['<>', 'template', 'index'])->all();
		foreach ($allContents as $content) {
			if (null !== $content->lang_parent_id)
				$allContentsByLang[$content->lang_parent_id][] = $content;
			else
				$allContentsByLang[$content->id][] = $content;
		}

    	if (null !== $allContentsByLang) {
    		
    		$xmlData = '<?xml version="1.0"?>'.PHP_EOL;
    		$xmlData .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

    		// Homepage
    		$homepages = Cms::find()->where(['status' => 1, 'template' => 'index'])->all();

    		foreach ($homepages as $home) {

				$xmlData .= static::tab(1).'<url>'.PHP_EOL;
				$xmlData .= static::tab(2).'<loc>'.Url::to(['site/index', 'language' => $home->lang], true).'</loc>'.PHP_EOL;

				$lastUpdate = Update::find()->where(['model_id' => $home->id])->orderBy(['date' => SORT_DESC])->one();
				if (null !== $lastUpdate)
					$xmlData .= static::tab(2).'<lastmod>'.date('Y-m-d', $lastUpdate->date).'</lastmod>'.PHP_EOL;

	    		foreach ($homepages as $alternate) {
					$xmlData .= static::tab(2).'<link rel="alternate" hreflang="'.$alternate->lang.'" href="'.Url::to(['site/index', 'language' => $alternate->lang], true).'" />'.PHP_EOL;
				}

				$xmlData .= static::tab(1).'</url>'.PHP_EOL;
    		}

    		foreach ($allContentsByLang as $contentLangs) {
    			foreach ($contentLangs as $content) {

	    			$xmlData .= static::tab(1).'<url>'.PHP_EOL;
	    			$xmlData .= static::tab(2).'<loc>'.Url::to(['site/content', 'url' => $content->url, 'language' => $content->lang], true).'</loc>'.PHP_EOL;

	    			$lastUpdate = Update::find()->where(['model_id' => $content->id])->orderBy(['date' => SORT_DESC])->one();
	    			if (null !== $lastUpdate)
	    				$xmlData .= static::tab(2).'<lastmod>'.date('Y-m-d', $lastUpdate->date).'</lastmod>'.PHP_EOL;

		    		foreach ($contentLangs as $alternate) {
						$xmlData .= static::tab(2).'<link rel="alternate" hreflang="'.$alternate->lang.'" href="'.Url::to(['site/content', 'url' => $alternate->url, 'language' => $alternate->lang], true).'" />'.PHP_EOL;
					}

	    			$xmlData .= static::tab(1).'</url>'.PHP_EOL;
	    		}
    		}
    		$xmlData .= '</urlset>';

    		file_put_contents(realpath(dirname(__FILE__).'/../../../').'/sitemap.xml', $xmlData);
    	}

    }

    public static function tab($nb) {
    	$tabs = '';
    	for ($idx = 0; $idx < $nb; $idx++) {
    		$tabs .= "\t";
    	}
    	return $tabs;
    }

    public function actionFaqImport() { // php yii cron/faq-import

    	$hotels = [
	    		'G' => 'general', 
	    		'H' => 3, // Zilwa
	    		'I' => 5, // Friday
	    		'J' => 7, // The Ravenala
	    		'K' => 9, // Lagoon
	    		'L' => 11, // Coin de Mire
	    		'M' => 13, // Tropical
	    		'N' => 15, // Récif
	    		'O' => 17 // Sunrise
	    	];

    	$categories = [
	    		'P' => 'most-asked', 
	    		'Q' => 'booking', 
	    		'R' => 'general',
	    		'S' => 'room',
	    		'T' => 'restaurant',
	    		'U' => 'activities',
	    		'V' => 'kids',
	    		'W' => 'mauritius'
	    	];

        $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load(realpath(dirname(__FILE__).'/../import/').'/faq-cdma.xlsx');
		$itemList = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		if (!empty($itemList)) {
			foreach ($itemList as $key => $item) {
				if ($item['A'] != null && $key > 2) {

		       		$faqFR = new Faq();
		       		$faqEN = new Faq();
		       		$faqDE = new Faq();
		       		$faqFR->status = $faqEN->status = $faqDE->status = 1;
		       		$faqFR->author = $faqEN->author = $faqDE->author = 4;
		       		$faqFR->created_at = $faqEN->created_at = $faqDE->created_at = time();
		       		$faqFR->lang = 'fr';
		       		$faqEN->lang = 'en';
		       		$faqDE->lang = 'de';

		       		$currentHotels = $currentCategories = [];

        			$faqFR->title = $item['A'];
        			$faqFR->url = MainHelper::cleanUrl($item['A']);
        			$faqFR->content = $item['B'];

        			$faqEN->title = $item['C'];
        			$faqEN->url = MainHelper::cleanUrl($item['C']);
        			$faqEN->content = $item['D'];

        			$faqDE->title = $item['E'];
        			$faqDE->url = MainHelper::cleanUrl($item['E']);
        			$faqDE->content = $item['F'];

					foreach (range('G', 'O') as $char) {
	        			if ($item[$char] == 'TRUE')
	        				$currentHotels[] = $hotels[$char];
					}
					foreach (range('P', 'W') as $char) {
	        			if ($item[$char] == 'TRUE')
	        				$currentCategories[] = $categories[$char];
					}
					$currentCategories = empty($currentCategories) ? null : $currentCategories;

		        	$currentHotels = JSON::encode($currentHotels);
		        	$faqFR->hotel = $faqEN->hotel = $faqDE->hotel = $currentHotels;
		        	$currentCategories = JSON::encode($currentCategories);
		        	$faqFR->category = $faqEN->category = $faqDE->category = $currentCategories;

		        	if ($faqFR->save()) {
		        		$faqEN->lang_parent_id = $faqFR->id;
		        		$faqEN->save();

		        		$faqDE->lang_parent_id = $faqFR->id;
		        		$faqDE->save();
		        	}
				}
			}
		}
    }
}