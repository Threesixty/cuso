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
            '3-blocks-cta' => '3 pictos + CTA',
            'big-title' => 'Gros titre',
            'next-news' => 'Prochaines actualités',
            'next-events' => 'Prochains événements',
            'all-news' => 'Toutes les actualités',
            'all-events' => 'Tous les événements',
            'partners' => 'Partenaires',
            'photos' => 'Photos',
            'simple-text' => 'Texte simple',
            'title-subtitle-cta' => 'Titre, sous-titre & bouton',
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
