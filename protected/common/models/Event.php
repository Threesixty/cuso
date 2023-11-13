<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\components\MainHelper;

/**
 * Event model
 *
 * @property integer $id
 * @property string $lang
 */
class Event extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        ];
    }

    // BO
    public static function getEventList($type) {

        return Cms::find()
            ->innerJoinWith('event')
            ->where([
                'Cms.type' => $type,
            ])
            ->andWhere([
                'is', 'lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }
}
