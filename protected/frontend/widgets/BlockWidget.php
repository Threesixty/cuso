<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use common\models\Hotel;
use common\components\MainHelper;

class BlockWidget extends Widget
{
    public $type; # block type
    public $value = null; # block content
    public $position = 0; # block position

    public function init()
    {
        parent::init();

    }

    public function run()
    {

    	$params = [
                'value' => $this->value,
                'position' => $this->position,
            ];
        
        return $this->render('block/'.$this->type, $params);

    }

    public static function getBlocks()
    {
        return self::$blocks;
    }
}
