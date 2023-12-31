<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * ModelRelations model
 *
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $type
 * @property string $type_name
 * @property integer $type_id
 * @property string $type_value
 */
class ModelRelations extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%model_relations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'model_id', 'type', 'type_name', 'type_id', 'type_value'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function add($args)
    {
        $modelRelations = new ModelRelations();
        $modelRelations->model = $args['model'];
        $modelRelations->model_id = $args['modelId'];
        $modelRelations->type = $args['type'];
        $modelRelations->type_name = $args['typeName'];
        $modelRelations->type_id = $args['typeId'];

        return $modelRelations->save();
    }
}
