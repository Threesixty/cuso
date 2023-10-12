<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use common\components\MainHelper;

class BlockWidget extends Widget
{
    public $type; # block type
    public $value = null; # block content
    public $show = false; # show block
    public $idx; # block idx

    public static $blocks = [
            'hero-pic' => 'Hero Pic',
        ];

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('block/'.$this->type, [
                'value' => $this->value,
                'show' => $this->show,
                'blocks' => $this->blocks,
                'idx' => $this->idx,
            ]);

    }

    public static function getBlocks()
    {
        return self::$blocks;
    }
}
