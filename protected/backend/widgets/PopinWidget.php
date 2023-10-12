<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use common\components\MainHelper;

class PopinWidget extends Widget
{
    public $name; # view name
    public $type; # delete type

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('popin/'.$this->name, [
                'type' => $this->type,
            ]);

    }
}
