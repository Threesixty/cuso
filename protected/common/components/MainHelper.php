<?php
namespace common\components;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Cms;
use common\models\Hotel;
use common\models\Option;

class MainHelper
{
    const ONE_DAY_IN_SECONDS = 60*60*24;

    public static function pp($mixed) {

        echo '<pre class="debug">';
        var_dump($mixed);
        echo '</pre>';
    }

	public static function session($type, $name, $value = null, $destroy = false) {

		$session = Yii::$app->session;
		if ($type == 'set') {

			if (!$session->getIsActive()) {
		    	$session->open();
		    }
		    $session[$name] = $value;
		    $session->close();

		    return $session[$name];

		} else {

			if (isset($session[$name])) {
				$param = $session[$name];
				if ($destroy) {
					$session->remove($name);

					return null;
				}

		    	return $param;
		    }

		    return null;

		}
        
	}

    public static function getPageTitle($title, $alt = '', $page = false, $after = false) {
    	$sep = $page ? ' - ' : '';
    	$site = $page ? Yii::$app->name : '';
    	$title = $title != '' ? $title : $alt;

    	if ($after)
    		return $site.$sep.$title;
    	return $title.$sep.$site;
    }

    public static function isImage($url) {
    	
    	return explode('/', mime_content_type(Yii::getAlias('@uploadFolder').'/'.$url))[0] == 'video' ? false : true;
    }

    public static function getLangSwitcher($actionId) {

    	$langSwitchArr = [];
    	$languages = Yii::$app->components['urlManager']['languages'];

    	$currentContent = null;
    	switch ($actionId) {
    		case 'index':
    		case 'content':
    			$currentContent = Yii::$app->request->get('url') != '' ? Cms::getContent(Yii::$app->request->get('url')) : Cms::getContent();
    			break;
    		
    		default:
    			break;
    	}

    	if ($currentContent) {

	        $mainContentId = null !== $currentContent->lang_parent_id ? $currentContent->lang_parent_id : $currentContent->id;

	    	$localeContents = Cms::find()
	    						->where([
	    								'status' => 1,
	    							])
	    						->andWhere([
	    								'or',
								        ['lang_parent_id' => $mainContentId],
								        ['id' => $mainContentId],
	    							])
	    						->andWhere([
	    								'!=',
								        'id',
								        $currentContent->id,
	    							])
	    						->all();

	    	$localeContents = array_merge([$currentContent], $localeContents);

	    	foreach ($languages as $language) {
	    		$langContent = array_filter(
				    $localeContents,
				    function ($content) use (&$language) {
				        return $content->lang == $language;
				    }
				);

				$langLabels = [
						'fr' => 'Français',
						'en' => 'English',
					];

				if (!empty($langContent)) {
					$langContent = array_values($langContent)[0];
					$langSwitchArr[$langLabels[$language]] = [
							'url' => !isset($langContent['template']) || (isset($langContent['template']) && $currentContent->template != 'index') ? $langContent->url : null,
							'action' => isset($langContent['template']) && $langContent->template != 'index' ? 'content' : $actionId,
							'lang' => $langContent->lang,
						];
				} else {
					$langSwitchArr[$langLabels[$language]] = [
							'url' => !isset($currentContent['template']) || (isset($currentContent['template']) && $currentContent->template != 'index') ? $currentContent->url : null,
							'action' => isset($currentContent['template']) && $currentContent->template != 'index' ? 'content' : $actionId,
							'lang' => $currentContent->lang,
						];
				}
	    	}
	    } else {

			$langSwitchArr[Yii::$app->language] = [];
	    }

    	return $langSwitchArr;
    }

    public static function getMenus() {

    	$menus = [];
        $menusOpt = Option::findOne(['name' => '_menus_']);
        if (null !== $menusOpt) {
            $menusOpt = JSON::decode($menusOpt->options)[0]['children'];
            $menus = static::parseTreeOption($menusOpt);
        }

        return $menus;
    }

    public static function getSidebarMenu() {

        // Get menus list
        $menusList = $menusSync = [];
        $menusOption = Option::getOption('name', 'menus');
        if ($menusOption) {
            foreach ($menusOption as $menu) {
                $menusList[]['text'] = $menu['name'];
                $menusSync[] = $menu['name'];
            }
        }

        // Get saved menus and merge them with current menu list
        $menusOptChildren = null;
        $menus = Option::findOne(['name' => '_menus_']);
        if (null !== $menus) {
            $menusOptChildren = JSON::decode($menus->options)[0]['children'];

            foreach ($menusSync as $menu) {
                $found = false;
                foreach ($menusOptChildren as $key => $children) {
                    if ($children['text'] == $menu) {
                        $found = true;
                    }
                    if (!in_array($children['text'], $menusSync) && $children['type'] != 'file') {
                        unset($menusOptChildren[$key]);
                    }
                }
                if (!$found)
                    $menusOptChildren[]['text'] = $menu;
            }

            $menusOptChildren = JSON::encode($menusOptChildren);
        }

        return [
        		'menus' => $menus,
        		'menusOptChildren' => $menusOptChildren,
        		'menusList' => JSON::encode($menusList),
        	];

    }

    public static function parseTreeOption($treeMenu) {

    	$menus = [];
        foreach ($treeMenu as $key => $menu) {
        	if (!empty($menu['data'])) {
	        	$currentContent = Cms::getMenuContentById($menu['data']['id']);
	        	if (null !== $currentContent) {
	        		$menus[$menu['text']]['id'] = $currentContent->id;
	        		$menus[$menu['text']]['url'] = $currentContent->url;
	        		$menus[$menu['text']]['type'] = isset($currentContent->name) ? 'hotel' : 'cms';
	        		$menus[$menu['text']]['template'] = isset($currentContent->name) ? null : $currentContent->template;
	        	}
	        } else {
	        	$menus[$menu['text']] = [];
	        }

        	if (!empty($menu['children'])) {
        		$menus[$menu['text']]['children'] = static::parseTreeOption($menu['children']);
        	}
        }
        return $menus;
    }

    public static function getMenuLink($content) {

    	return isset($content['template']) && $content['template'] != 'index' ? Url::to(['site/content', 'url' => $content['url']]) : '';
    }

    public static function isMenuActive($currentMenu) {

    	return isset($currentMenu['url']) && $currentMenu['url'] == Yii::$app->request->get('url') ? 'bold-text' : '';
    }

    public static function getBlockLink($url) {

    	if (substr($url, 0, 4) == 'http')
    		$blockLink = $url;
    	elseif ($url == '')
    		$blockLink = 'javascript:void(0)';
    	else
    		$blockLink = Url::to(['site/content', 'url' => $url]);

		return $blockLink;
    }

    public static function getDestination($type, $object, $destination) {

        $dest = ['site/'.$type];
        switch ($destination) {
            case 'stay':
                $dest = ['site/edit-'.$type, 'id' => $object->id];
                if (!empty(Yii::$app->request->get('lang'))) {
                    $dest['id'] = $object->lang_parent_id;
                    $dest['lang'] = $object->lang;
                }
                break;
            case 'new':
                $dest = ['site/edit-'.$type];
                break;
            case 'quit':
                $dest = ['site/'.$type];
                break;

            default:
                $dest = ['site/edit-'.$type, 'id' => $object->id];
                if (!empty(Yii::$app->request->get('lang'))) {
                    $dest['id'] = $object->lang_parent_id;
                    $dest['lang'] = $object->lang;
                }
                break;
        }

        return $dest;
    }

    public static function sendMail($subject, $to = null, $args = [], $template = 'main') { // $args['message'] for default main templates

    	if (null === $to) {
    		$to = 'evenements@clubgenesys.org';
    	}

# Tests
$members = User::find()->where(['company_id' => 2])->all();
$to = array_column($members, 'email');

    	$templates = ['html' => $template.'-html', 'text' => $template.'-text'];

        return Yii::$app
            ->mailer
            ->compose(
                $templates,
                $args
            )
            ->setFrom(['contact@clubgenesysetinteractionscx.org' => Yii::$app->name])
            ->setTo($to)
            ->setSubject($subject)
            ->send();

    }

	public static function getCountryList() {
		return [Yii::t('app', "Afghanistan"), Yii::t('app', "Afrique du Sud"), Yii::t('app', "Albanie"), Yii::t('app', "Algérie"), Yii::t('app', "Allemagne"), Yii::t('app', "Andorre"), Yii::t('app', "Angola"), Yii::t('app', "Anguilla"), Yii::t('app', "Antigua-et-Barbuda"), Yii::t('app', "Antilles Néerlandaises"), Yii::t('app', "Arabie Saoudite"), Yii::t('app', "Argentine"), Yii::t('app', "Arménie"), Yii::t('app', "Aruba"), Yii::t('app', "Australie"), Yii::t('app', "Autriche"), Yii::t('app', "Azerbaïdjan"), Yii::t('app', "Bahamas"), Yii::t('app', "Bahreïn"), Yii::t('app', "Bangladesh"), Yii::t('app', "Barbade"), Yii::t('app', "Belgique"), Yii::t('app', "Belize"), Yii::t('app', "Bénin"), Yii::t('app', "Bermudes"), Yii::t('app', "Bhoutan"), Yii::t('app', "Biélorussie"), Yii::t('app', "Birmanie (Myanmar)"), Yii::t('app', "Bolivie"), Yii::t('app', "Bosnie-Herzégovine"), Yii::t('app', "Botswana"), Yii::t('app', "Brésil"), Yii::t('app', "Brunei"), Yii::t('app', "Bulgarie"), Yii::t('app', "Burkina Faso"), Yii::t('app', "Burundi"), Yii::t('app', "Cambodge"), Yii::t('app', "Cameroun"), Yii::t('app', "Canada"), Yii::t('app', "Cap-vert"), Yii::t('app', "Chili"), Yii::t('app', "Chine"), Yii::t('app', "Chypre"), Yii::t('app', "Colombie"), Yii::t('app', "Comores"), Yii::t('app', "Corée du Nord"), Yii::t('app', "Corée du Sud"), Yii::t('app', "Costa Rica"), Yii::t('app', "Côte d\'Ivoire"), Yii::t('app', "Croatie"), Yii::t('app', "Cuba"), Yii::t('app', "Danemark"), Yii::t('app', "Djibouti"), Yii::t('app', "Dominique"), Yii::t('app', "Égypte"), Yii::t('app', "Émirats Arabes Unis"), Yii::t('app', "Équateur"), Yii::t('app', "Érythrée"), Yii::t('app', "Espagne"), Yii::t('app', "Estonie"), Yii::t('app', "États Fédérés de Micronésie"), Yii::t('app', "États-Unis"), Yii::t('app', "Éthiopie"), Yii::t('app', "Fidji"), Yii::t('app', "Finlande"), Yii::t('app', "France"), Yii::t('app', "Gabon"), Yii::t('app', "Gambie"), Yii::t('app', "Géorgie"), Yii::t('app', "Géorgie du Sud et les Îles Sandwich du Sud"), Yii::t('app', "Ghana"), Yii::t('app', "Gibraltar"), Yii::t('app', "Grèce"), Yii::t('app', "Grenade"), Yii::t('app', "Groenland"), Yii::t('app', "Guadeloupe"), Yii::t('app', "Guam"), Yii::t('app', "Guatemala"), Yii::t('app', "Guinée"), Yii::t('app', "Guinée-Bissau"), Yii::t('app', "Guinée Équatoriale"), Yii::t('app', "Guyana"), Yii::t('app', "Guyane Française"), Yii::t('app', "Haïti"), Yii::t('app', "Honduras"), Yii::t('app', "Hong-Kong"), Yii::t('app', "Hongrie"), Yii::t('app', "Île Christmas"), Yii::t('app', "Île de Man"), Yii::t('app', "Île Norfolk"), Yii::t('app', "Îles Åland"), Yii::t('app', "Îles Caïmanes"), Yii::t('app', "Îles Cocos (Keeling)"), Yii::t('app', "Îles Cook"), Yii::t('app', "Îles Féroé"), Yii::t('app', "Îles Malouines"), Yii::t('app', "Îles Mariannes du Nord"), Yii::t('app', "Îles Marshall"), Yii::t('app', "Îles Pitcairn"), Yii::t('app', "Îles Salomon"), Yii::t('app', "Îles Turks et Caïques"), Yii::t('app', "Îles Vierges Britanniques"), Yii::t('app', "Îles Vierges des États-Unis"), Yii::t('app', "Inde"), Yii::t('app', "Indonésie"), Yii::t('app', "Iran"), Yii::t('app', "Iraq"), Yii::t('app', "Irlande"), Yii::t('app', "Islande"), Yii::t('app', "Israël"), Yii::t('app', "Italie"), Yii::t('app', "Jamaïque"), Yii::t('app', "Japon"), Yii::t('app', "Jordanie"), Yii::t('app', "Kazakhstan"), Yii::t('app', "Kenya"), Yii::t('app', "Kirghizistan"), Yii::t('app', "Kiribati"), Yii::t('app', "Koweït"), Yii::t('app', "Laos"), Yii::t('app', "Le Vatican"), Yii::t('app', "Lesotho"), Yii::t('app', "Lettonie"), Yii::t('app', "Liban"), Yii::t('app', "Libéria"), Yii::t('app', "Libye"), Yii::t('app', "Liechtenstein"), Yii::t('app', "Lituanie"), Yii::t('app', "Luxembourg"), Yii::t('app', "Macao"), Yii::t('app', "Madagascar"), Yii::t('app', "Malaisie"), Yii::t('app', "Malawi"), Yii::t('app', "Maldives"), Yii::t('app', "Mali"), Yii::t('app', "Malte"), Yii::t('app', "Maroc"), Yii::t('app', "Martinique"), Yii::t('app', "Maurice"), Yii::t('app', "Mauritanie"), Yii::t('app', "Mayotte"), Yii::t('app', "Mexique"), Yii::t('app', "Moldavie"), Yii::t('app', "Monaco"), Yii::t('app', "Mongolie"), Yii::t('app', "Monténégro"), Yii::t('app', "Montserrat"), Yii::t('app', "Mozambique"), Yii::t('app', "Namibie"), Yii::t('app', "Nauru"), Yii::t('app', "Népal"), Yii::t('app', "Nicaragua"), Yii::t('app', "Niger"), Yii::t('app', "Nigéria"), Yii::t('app', "Niué"), Yii::t('app', "Norvège"), Yii::t('app', "Nouvelle-Calédonie"), Yii::t('app', "Nouvelle-Zélande"), Yii::t('app', "Oman"), Yii::t('app', "Ouganda"), Yii::t('app', "Ouzbékistan"), Yii::t('app', "Pakistan"), Yii::t('app', "Palaos"), Yii::t('app', "Panama"), Yii::t('app', "Papouasie-Nouvelle-Guinée"), Yii::t('app', "Paraguay"), Yii::t('app', "Pays-Bas"), Yii::t('app', "Pérou"), Yii::t('app', "Philippines"), Yii::t('app', "Pologne"), Yii::t('app', "Polynésie Française"), Yii::t('app', "Porto Rico"), Yii::t('app', "Portugal"), Yii::t('app', "Qatar"), Yii::t('app', "République Centrafricaine"), Yii::t('app', "République de Macédoine"), Yii::t('app', "République Démocratique du Congo"), Yii::t('app', "République Dominicaine"), Yii::t('app', "République du Congo"), Yii::t('app', "République Tchèque"), Yii::t('app', "Réunion"), Yii::t('app', "Roumanie"), Yii::t('app', "Royaume-Uni"), Yii::t('app', "Russie"), Yii::t('app', "Rwanda"), Yii::t('app', "Saint-Kitts-et-Nevis"), Yii::t('app', "Saint-Marin"), Yii::t('app', "Saint-Pierre-et-Miquelon"), Yii::t('app', "Saint-Vincent-et-les Grenadines"), Yii::t('app', "Sainte-Hélène"), Yii::t('app', "Sainte-Lucie"), Yii::t('app', "Salvador"), Yii::t('app', "Samoa"), Yii::t('app', "Samoa Américaines"), Yii::t('app', "Sao Tomé-et-Principe"), Yii::t('app', "Sénégal"), Yii::t('app', "Serbie"), Yii::t('app', "Seychelles"), Yii::t('app', "Sierra Leone"), Yii::t('app', "Singapour"), Yii::t('app', "Slovaquie"), Yii::t('app', "Slovénie"), Yii::t('app', "Somalie"), Yii::t('app', "Soudan"), Yii::t('app', "Sri Lanka"), Yii::t('app', "Suède"), Yii::t('app', "Suisse"), Yii::t('app', "Suriname"), Yii::t('app', "Svalbard et Jan Mayen"), Yii::t('app', "Swaziland"), Yii::t('app', "Syrie"), Yii::t('app', "Tadjikistan"), Yii::t('app', "Taïwan"), Yii::t('app', "Tanzanie"), Yii::t('app', "Tchad"), Yii::t('app', "Terres Australes Françaises"), Yii::t('app', "Thaïlande"), Yii::t('app', "Timor Oriental"), Yii::t('app', "Togo"), Yii::t('app', "Tonga"), Yii::t('app', "Trinité-et-Tobago"), Yii::t('app', "Tunisie"), Yii::t('app', "Turkménistan"), Yii::t('app', "Turquie"), Yii::t('app', "Tuvalu"), Yii::t('app', "Ukraine"), Yii::t('app', "Uruguay"), Yii::t('app', "Vanuatu"), Yii::t('app', "Venezuela"), Yii::t('app', "Viet Nam"), Yii::t('app', "Wallis et Futuna"), Yii::t('app', "Yémen"), Yii::t('app', "Zambie"), Yii::t('app', "Zimbabwe")];
    }

	public static function HTMLToRGB($htmlCode) {

	    if($htmlCode[0] == '#')
			$htmlCode = substr($htmlCode, 1);

	    if (strlen($htmlCode) == 3)
			$htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];

	    $r = hexdec($htmlCode[0] . $htmlCode[1]);
	    $g = hexdec($htmlCode[2] . $htmlCode[3]);
	    $b = hexdec($htmlCode[4] . $htmlCode[5]);

	    return $b + ($g << 0x8) + ($r << 0x10);
	}

	public static function RGBToHSL($RGB) {

	    $r = 0xFF & ($RGB >> 0x10);
	    $g = 0xFF & ($RGB >> 0x8);
	    $b = 0xFF & $RGB;

	    $r = ((float)$r) / 255.0;
	    $g = ((float)$g) / 255.0;
	    $b = ((float)$b) / 255.0;

	    $maxC = max($r, $g, $b);
	    $minC = min($r, $g, $b);

	    $l = ($maxC + $minC) / 2.0;

	    if($maxC == $minC) {
			$s = 0;
			$h = 0;
	    } else {

			if($l < .5)
				$s = ($maxC - $minC) / ($maxC + $minC);
			else
				$s = ($maxC - $minC) / (2.0 - $maxC - $minC);

			if($r == $maxC)
				$h = ($g - $b) / ($maxC - $minC);
			if($g == $maxC)
				$h = 2.0 + ($b - $r) / ($maxC - $minC);
			if($b == $maxC)
				$h = 4.0 + ($r - $g) / ($maxC - $minC);

			$h = $h / 6.0; 
	    }

	    $h = (int)round(255.0 * $h);
	    $s = (int)round(255.0 * $s);
	    $l = (int)round(255.0 * $l);

	    return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
	}

    public static function isDarkBg($color) {

		$rgb = MainHelper::HTMLToRGB(trim($color));
		$hsl = MainHelper::RGBToHSL($rgb);
		
		return $hsl->lightness < 150 ? true : false;
	}

	public static function getPrettyEventDate($start, $end, $small = false, $format = 'all') {
		$date = '';
		switch ($format) {
			case 'date':
				if ($end - $start < self::ONE_DAY_IN_SECONDS) {
					$date = strftime("%d %B %Y", $start);
				} else {
					$date = $small ? strftime("%d %B %Y", $start).' - '.strftime("%d %B %Y", $end) : "Du ".strftime("%d %B %Y", $start).' '.Yii::t('app', "au").' '.strftime("%d %B %Y", $end);
				}
				break;
			case 'time':
				$date = $small ? date('G\hi', $start).' - '.date('G\hi', $end) : Yii::t('app', "De").' '.date('G\hi', $start).' '.Yii::t('app', "à").' '.date('G\hi', $end);
				break;
			
			default:
				if ($end - $start < self::ONE_DAY_IN_SECONDS) {
					$date = $small ? strftime("%d %B %Y", $start).' | '.date('G\hi', $start).' - '.date('G\hi', $end) : strftime("%d %B %Y", $start).' '.Yii::t('app', "de").' '.date('G\hi', $start).' '.Yii::t('app', "à").' '.date('G\hi', $end);
				} else {
					$date = $small ? strftime("%d %B %Y", $start).' | '.date('G\hi', $start) : "Du ".strftime("%d %B %Y", $start).' '.Yii::t('app', "à").' '.date('G\hi', $start).' '.Yii::t('app', "au").' '.strftime("%d %B %Y", $end).' '.Yii::t('app', "à").' '.date('G\hi', $end);
				}
				break;
		}
		return $date;
	}

    public static function uniqueUrl($cms, $cmsId, $idx = 1, $text = '') {

        $params = [
                'lang' => $cms->lang,
                'status' => 1,
                'url' => $cms->url.$text,
            ];

        $sameUrls = Cms::find()
                        ->where($params)
                        ->andWhere([
                                'or',
                                ['>', 'end_date', time()],
                                ['end_date' => 0],
                            ]);
        if (null != $cmsId) {
            $sameUrls = $sameUrls->andWhere([
            		'<>',
            		'id',
            		$cmsId
            	]);
            $sameUrls = $sameUrls->andWhere([
            		'<>',
            		'lang_parent_id',
            		$cmsId
            	]);
        }

        $sameUrls = $sameUrls->all();

    	if (!empty($sameUrls)) {

    		$text .= '-'.$idx;
    		static::uniqueUrl($cms, $cmsId, $idx++, $text);
    	}
    	return $cms->url.$text;
    }

    public static function cleanUrl($string) {

		if (static::seems_utf8($string)) {
			$chars = array(
			// Decompositions for Latin-1 Supplement
			',' => '-',
			'%' => '_', '&' => 'and',
			'ª' => 'a', 'º' => 'o',
			'À' => 'A', 'Á' => 'A',
			'Â' => 'A', 'Ã' => 'A',
			'Ä' => 'A', 'Å' => 'A',
			'Æ' => 'AE','Ç' => 'C',
			'È' => 'E', 'É' => 'E',
			'Ê' => 'E', 'Ë' => 'E',
			'Ì' => 'I', 'Í' => 'I',
			'Î' => 'I', 'Ï' => 'I',
			'Ð' => 'D', 'Ñ' => 'N',
			'Ò' => 'O', 'Ó' => 'O',
			'Ô' => 'O', 'Õ' => 'O',
			'Ö' => 'O', 'Ù' => 'U',
			'Ú' => 'U', 'Û' => 'U',
			'Ü' => 'U', 'Ý' => 'Y',
			'Þ' => 'TH','ß' => 's',
			'à' => 'a', 'á' => 'a',
			'â' => 'a', 'ã' => 'a',
			'ä' => 'a', 'å' => 'a',
			'æ' => 'ae','ç' => 'c',
			'è' => 'e', 'é' => 'e',
			'ê' => 'e', 'ë' => 'e',
			'ì' => 'i', 'í' => 'i',
			'î' => 'i', 'ï' => 'i',
			'ð' => 'd', 'ñ' => 'n',
			'ò' => 'o', 'ó' => 'o',
			'ô' => 'o', 'õ' => 'o',
			'ö' => 'o', 'ø' => 'o',
			'ù' => 'u', 'ú' => 'u',
			'û' => 'u', 'ü' => 'u',
			'ý' => 'y', 'þ' => 'th',
			'ÿ' => 'y', 'Ø' => 'O',
			// Decompositions for Latin Extended-A
			'Ā' => 'A', 'ā' => 'a',
			'Ă' => 'A', 'ă' => 'a',
			'Ą' => 'A', 'ą' => 'a',
			'Ć' => 'C', 'ć' => 'c',
			'Ĉ' => 'C', 'ĉ' => 'c',
			'Ċ' => 'C', 'ċ' => 'c',
			'Č' => 'C', 'č' => 'c',
			'Ď' => 'D', 'ď' => 'd',
			'Đ' => 'D', 'đ' => 'd',
			'Ē' => 'E', 'ē' => 'e',
			'Ĕ' => 'E', 'ĕ' => 'e',
			'Ė' => 'E', 'ė' => 'e',
			'Ę' => 'E', 'ę' => 'e',
			'Ě' => 'E', 'ě' => 'e',
			'Ĝ' => 'G', 'ĝ' => 'g',
			'Ğ' => 'G', 'ğ' => 'g',
			'Ġ' => 'G', 'ġ' => 'g',
			'Ģ' => 'G', 'ģ' => 'g',
			'Ĥ' => 'H', 'ĥ' => 'h',
			'Ħ' => 'H', 'ħ' => 'h',
			'Ĩ' => 'I', 'ĩ' => 'i',
			'Ī' => 'I', 'ī' => 'i',
			'Ĭ' => 'I', 'ĭ' => 'i',
			'Į' => 'I', 'į' => 'i',
			'İ' => 'I', 'ı' => 'i',
			'Ĳ' => 'IJ','ĳ' => 'ij',
			'Ĵ' => 'J', 'ĵ' => 'j',
			'Ķ' => 'K', 'ķ' => 'k',
			'ĸ' => 'k', 'Ĺ' => 'L',
			'ĺ' => 'l', 'Ļ' => 'L',
			'ļ' => 'l', 'Ľ' => 'L',
			'ľ' => 'l', 'Ŀ' => 'L',
			'ŀ' => 'l', 'Ł' => 'L',
			'ł' => 'l', 'Ń' => 'N',
			'ń' => 'n', 'Ņ' => 'N',
			'ņ' => 'n', 'Ň' => 'N',
			'ň' => 'n', 'ŉ' => 'n',
			'Ŋ' => 'N', 'ŋ' => 'n',
			'Ō' => 'O', 'ō' => 'o',
			'Ŏ' => 'O', 'ŏ' => 'o',
			'Ő' => 'O', 'ő' => 'o',
			'Œ' => 'OE','œ' => 'oe',
			'Ŕ' => 'R','ŕ' => 'r',
			'Ŗ' => 'R','ŗ' => 'r',
			'Ř' => 'R','ř' => 'r',
			'Ś' => 'S','ś' => 's',
			'Ŝ' => 'S','ŝ' => 's',
			'Ş' => 'S','ş' => 's',
			'Š' => 'S', 'š' => 's',
			'Ţ' => 'T', 'ţ' => 't',
			'Ť' => 'T', 'ť' => 't',
			'Ŧ' => 'T', 'ŧ' => 't',
			'Ũ' => 'U', 'ũ' => 'u',
			'Ū' => 'U', 'ū' => 'u',
			'Ŭ' => 'U', 'ŭ' => 'u',
			'Ů' => 'U', 'ů' => 'u',
			'Ű' => 'U', 'ű' => 'u',
			'Ų' => 'U', 'ų' => 'u',
			'Ŵ' => 'W', 'ŵ' => 'w',
			'Ŷ' => 'Y', 'ŷ' => 'y',
			'Ÿ' => 'Y', 'Ź' => 'Z',
			'ź' => 'z', 'Ż' => 'Z',
			'ż' => 'z', 'Ž' => 'Z',
			'ž' => 'z', 'ſ' => 's',
			// Decompositions for Latin Extended-B
			'Ș' => 'S', 'ș' => 's',
			'Ț' => 'T', 'ț' => 't',
			// Euro Sign
			'€' => 'E',
			// GBP (Pound) Sign
			'£' => '',
			// Vowels with diacritic (Vietnamese)
			// unmarked
			'Ơ' => 'O', 'ơ' => 'o',
			'Ư' => 'U', 'ư' => 'u',
			// grave accent
			'Ầ' => 'A', 'ầ' => 'a',
			'Ằ' => 'A', 'ằ' => 'a',
			'Ề' => 'E', 'ề' => 'e',
			'Ồ' => 'O', 'ồ' => 'o',
			'Ờ' => 'O', 'ờ' => 'o',
			'Ừ' => 'U', 'ừ' => 'u',
			'Ỳ' => 'Y', 'ỳ' => 'y',
			// hook
			'Ả' => 'A', 'ả' => 'a',
			'Ẩ' => 'A', 'ẩ' => 'a',
			'Ẳ' => 'A', 'ẳ' => 'a',
			'Ẻ' => 'E', 'ẻ' => 'e',
			'Ể' => 'E', 'ể' => 'e',
			'Ỉ' => 'I', 'ỉ' => 'i',
			'Ỏ' => 'O', 'ỏ' => 'o',
			'Ổ' => 'O', 'ổ' => 'o',
			'Ở' => 'O', 'ở' => 'o',
			'Ủ' => 'U', 'ủ' => 'u',
			'Ử' => 'U', 'ử' => 'u',
			'Ỷ' => 'Y', 'ỷ' => 'y',
			// tilde
			'Ẫ' => 'A', 'ẫ' => 'a',
			'Ẵ' => 'A', 'ẵ' => 'a',
			'Ẽ' => 'E', 'ẽ' => 'e',
			'Ễ' => 'E', 'ễ' => 'e',
			'Ỗ' => 'O', 'ỗ' => 'o',
			'Ỡ' => 'O', 'ỡ' => 'o',
			'Ữ' => 'U', 'ữ' => 'u',
			'Ỹ' => 'Y', 'ỹ' => 'y',
			// acute accent
			'Ấ' => 'A', 'ấ' => 'a',
			'Ắ' => 'A', 'ắ' => 'a',
			'Ế' => 'E', 'ế' => 'e',
			'Ố' => 'O', 'ố' => 'o',
			'Ớ' => 'O', 'ớ' => 'o',
			'Ứ' => 'U', 'ứ' => 'u',
			// dot below
			'Ạ' => 'A', 'ạ' => 'a',
			'Ậ' => 'A', 'ậ' => 'a',
			'Ặ' => 'A', 'ặ' => 'a',
			'Ẹ' => 'E', 'ẹ' => 'e',
			'Ệ' => 'E', 'ệ' => 'e',
			'Ị' => 'I', 'ị' => 'i',
			'Ọ' => 'O', 'ọ' => 'o',
			'Ộ' => 'O', 'ộ' => 'o',
			'Ợ' => 'O', 'ợ' => 'o',
			'Ụ' => 'U', 'ụ' => 'u',
			'Ự' => 'U', 'ự' => 'u',
			'Ỵ' => 'Y', 'ỵ' => 'y',
			// Vowels with diacritic (Chinese, Hanyu Pinyin)
			'ɑ' => 'a',
			// macron
			'Ǖ' => 'U', 'ǖ' => 'u',
			// acute accent
			'Ǘ' => 'U', 'ǘ' => 'u',
			// caron
			'Ǎ' => 'A', 'ǎ' => 'a',
			'Ǐ' => 'I', 'ǐ' => 'i',
			'Ǒ' => 'O', 'ǒ' => 'o',
			'Ǔ' => 'U', 'ǔ' => 'u',
			'Ǚ' => 'U', 'ǚ' => 'u',
			// grave accent
			'Ǜ' => 'U', 'ǜ' => 'u',
			);

			// Used for locale-specific rules
			$locale = 'fr_FR';

			if ( 'de_DE' == $locale || 'de_DE_formal' == $locale || 'de_CH' == $locale || 'de_CH_informal' == $locale ) {
				$chars[ 'Ä' ] = 'Ae';
				$chars[ 'ä' ] = 'ae';
				$chars[ 'Ö' ] = 'Oe';
				$chars[ 'ö' ] = 'oe';
				$chars[ 'Ü' ] = 'Ue';
				$chars[ 'ü' ] = 'ue';
				$chars[ 'ß' ] = 'ss';
			} elseif ( 'da_DK' === $locale ) {
				$chars[ 'Æ' ] = 'Ae';
	 			$chars[ 'æ' ] = 'ae';
				$chars[ 'Ø' ] = 'Oe';
				$chars[ 'ø' ] = 'oe';
				$chars[ 'Å' ] = 'Aa';
				$chars[ 'å' ] = 'aa';
			} elseif ( 'ca' === $locale ) {
				$chars[ 'l·l' ] = 'll';
			} elseif ( 'sr_RS' === $locale || 'bs_BA' === $locale ) {
				$chars[ 'Đ' ] = 'DJ';
				$chars[ 'đ' ] = 'dj';
			}

			$string = strtr($string, $chars);
		} else {
			$chars = array();
			// Assume ISO-8859-1 if not UTF-8
			$chars['in'] = "\x80\x83\x8a\x8e\x9a\x9e"
				."\x9f\xa2\xa5\xb5\xc0\xc1\xc2"
				."\xc3\xc4\xc5\xc7\xc8\xc9\xca"
				."\xcb\xcc\xcd\xce\xcf\xd1\xd2"
				."\xd3\xd4\xd5\xd6\xd8\xd9\xda"
				."\xdb\xdc\xdd\xe0\xe1\xe2\xe3"
				."\xe4\xe5\xe7\xe8\xe9\xea\xeb"
				."\xec\xed\xee\xef\xf1\xf2\xf3"
				."\xf4\xf5\xf6\xf8\xf9\xfa\xfb"
				."\xfc\xfd\xff";

			$chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

			$string = strtr($string, $chars['in'], $chars['out']);
			$double_chars = array();
			$double_chars['in'] = array("\x8c", "\x9c", "\xc6", "\xd0", "\xde", "\xdf", "\xe6", "\xf0", "\xfe");
			$double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
			$string = str_replace($double_chars['in'], $double_chars['out'], $string);
		}

    	$string = str_replace(str_split(' \'\\:.;*<>|'), "-", $string);
    	$string = str_replace(str_split('"!?'), "", $string);
        return trim(strtolower(filter_var($string, FILTER_SANITIZE_URL)), '-');

	}


	public static function seems_utf8( $str ) {
		static::mbstring_binary_safe_encoding();
		$length = strlen($str);
		static::mbstring_binary_safe_encoding(true);
		for ($i=0; $i < $length; $i++) {
			$c = ord($str[$i]);
			if ($c < 0x80) $n = 0; // 0bbbbbbb
			elseif (($c & 0xE0) == 0xC0) $n=1; // 110bbbbb
			elseif (($c & 0xF0) == 0xE0) $n=2; // 1110bbbb
			elseif (($c & 0xF8) == 0xF0) $n=3; // 11110bbb
			elseif (($c & 0xFC) == 0xF8) $n=4; // 111110bb
			elseif (($c & 0xFE) == 0xFC) $n=5; // 1111110b
			else return false; // Does not match any model
			for ($j=0; $j<$n; $j++) { // n bytes matching 10bbbbbb follow ?
				if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
					return false;
			}
		}
		return true;
	}

	public static function mbstring_binary_safe_encoding( $reset = false ) {
		static $encodings = array();
		static $overloaded = null;

		if ( is_null( $overloaded ) )
			$overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 );

		if ( false === $overloaded )
			return;

		if ( ! $reset ) {
			$encoding = mb_internal_encoding();
			array_push( $encodings, $encoding );
			mb_internal_encoding( 'ISO-8859-1' );
		}

		if ( $reset && $encodings ) {
			$encoding = array_pop( $encodings );
			mb_internal_encoding( $encoding );
		}
	}


	/**
	Truncate fct
	*
	* Truncates text.
	*
	* Cuts a string to the length of $length and replaces the last characters
	* with the ending if the text is longer than length.
	*
	* @param string  $text String to truncate.
	* @param integer $length Length of returned string, including ellipsis.
	* @param string  $ending Ending to be appended to the trimmed string.
	* @param boolean $exact If false, $text will not be cut mid-word
	* @param boolean $considerHtml If true, HTML tags would be handled correctly
	* @return string Trimmed string.
	*/
	public static function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {

	    if ($considerHtml) {
	        // if the plain text is shorter than the maximum length, return the whole text
	        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
	            return $text;
	        }
	 
	        // splits all html-tags to scanable lines
	        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
	 
	            $total_length = strlen($ending);
	            $open_tags = array();
	            $truncate = '';
	 
	        foreach ($lines as $line_matchings) {
	            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
	            if (!empty($line_matchings[1])) {
	                // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
	                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
	                    // do nothing
	                // if tag is a closing tag (f.e. </b>)
	                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
	                    // delete tag from $open_tags list
	                    $pos = array_search($tag_matchings[1], $open_tags);
	                    if ($pos !== false) {
	                        unset($open_tags[$pos]);
	                    }
	                // if tag is an opening tag (f.e. <b>)
	                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
	                    // add tag to the beginning of $open_tags list
	                    array_unshift($open_tags, strtolower($tag_matchings[1]));
	                }
	                // add html-tag to $truncate'd text
	                $truncate .= $line_matchings[1];
	            }
	 
	            // calculate the length of the plain text part of the line; handle entities as one character
	            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
	            if ($total_length+$content_length> $length) {
	                // the number of characters which are left
	                $left = $length - $total_length;
	                $entities_length = 0;
	                // search for html entities
	                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
	                    // calculate the real length of all entities in the legal range
	                    foreach ($entities[0] as $entity) {
	                        if ($entity[1]+1-$entities_length <= $left) {
	                            $left--;
	                            $entities_length += strlen($entity[0]);
	                        } else {
	                            // no more characters left
	                            break;
	                        }
	                    }
	                }
	                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
	                // maximum lenght is reached, so get off the loop
	                break;
	            } else {
	                $truncate .= $line_matchings[2];
	                $total_length += $content_length;
	            }
	 
	            // if the maximum length is reached, get off the loop
	            if($total_length>= $length) {
	                break;
	            }
	        }
	    } else {
	        if (strlen($text) <= $length) {
	            return $text;
	        } else {
	            $truncate = substr($text, 0, $length - strlen($ending));
	        }
	    }
	 
	    // if the words shouldn't be cut in the middle...
	    if (!$exact) {
	        // ...search the last occurance of a space...
	        $spacepos = strrpos($truncate, ' ');
	        if (isset($spacepos)) {
	            // ...and cut the text in this position
	            $truncate = substr($truncate, 0, $spacepos);
	        }
	    }
	 
	    // add the defined ending to the text
	    $truncate .= $ending;
	 
	    if($considerHtml) {
	        // close all unclosed html-tags
	        foreach ($open_tags as $tag) {
	            $truncate .= '</' . $tag . '>';
	        }
	    }
	 
	    return $truncate;
	 
	}
}