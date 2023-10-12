<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use common\components\MainHelper;

class MainWidget extends Widget
{
    public $name;
    public $selectId = 0;

    public function init()
    {
        parent::init();

    }

    public function run()
    {
    	$params = [
    		];

    	switch ($this->name) {
    		
    		default:
    			break;
    	}
        
        return $this->render('main/'.$this->name, $params);

    }
}
