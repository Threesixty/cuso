<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Update model
 *
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $action
 * @property integer $date
 * @property integer $author
 */
class Update extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%update}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'model_id', 'action', 'date', 'author'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function add($model, $modelId, $action, $authorId = null)
    {
        $update = new Update();
        $update->model = $model;
        $update->model_id = $modelId;
        $update->action = $action;
        $update->date = time();
        $update->author = null === $authorId ? Yii::$app->user->identity->id : $authorId;

        return $update->save();
    }

    public static function getLastUpdate($model, $modelId) {
        return static::find()
                ->where([
                    'model' => $model,
                    'model_id' => $modelId
                ])
                ->orderBy(['date' => SORT_DESC])
                ->one();
    }
}
