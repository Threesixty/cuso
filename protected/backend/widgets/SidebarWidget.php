<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use common\models\Media;
use common\models\Option;
use common\components\MainHelper;

class SidebarWidget extends Widget
{
    public $action; # sidebar content

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        switch ($this->action) {
            case 'index':
            case 'cms':
            case 'news':
            case 'event':
            case 'forum':
            case 'chatbot':
            case 'user':
            case 'company':
            case 'option':
            	$sidebarMenu = MainHelper::getSidebarMenu();
                return $this->render('sidebar/menus', [
                        'menus' => null !== $sidebarMenu['menus'] ? $sidebarMenu['menusOptChildren'] : $sidebarMenu['menusList'],
                    ]);
                break;
            case 'media':
                return $this->render('sidebar/upload');
                break;
            
            default:
                return $this->render('sidebar/medias', [
			            'mediaList' => Media::find()
		            						->where(['is', 'lang_parent_id', new \yii\db\Expression('null')])
			            					->orderBy(['created_at' => SORT_DESC])
				            				->limit(20)
			            					->all(),
                    ]);
                break;
        }

    }
}
