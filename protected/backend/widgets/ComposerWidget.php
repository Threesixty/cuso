<?php
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use common\components\MainHelper;

class ComposerWidget extends Widget
{
    public $blocks; # block list

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('composer-list', [
                'blocks' => $this->blocks,
            ]);

    }
}
