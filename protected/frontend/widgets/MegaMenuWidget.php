<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Option;
use common\components\MainHelper;

class MegaMenuWidget extends Widget
{
    public $name = null; # mega menu name
    public $menu = null; # menu id
    public $menuContent = null; # menu cms content
    public $title = null; # menu item title
    public $url = null; # menu item url

    public function init()
    {
        parent::init();

    }

    public function run()
    {
    	$params = [
                'title' => $this->title,
                'menuContent' => $this->menuContent,
                'url' => $this->url,
                'items' => $this->menu['children']
    		];
    	switch ($this->name) {
    		case 'communities':
    			break;
    		
    		default:
    			break;
    	}

    	$params['menu'] = $this->menu;
        
        return $this->render('megamenu/'.$this->name, $params);

    }

    public static function getBlocks()
    {
        return self::$blocks;
    }
}
