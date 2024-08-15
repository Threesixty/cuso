<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\ModelRelations;
use common\components\MainHelper;

/**
 * Forum model
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $parent_id
 * @property integer $status
 * @property integer $author
 * @property integer $created_at
 */
class Forum extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%forum}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_DRAFT],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_DRAFT]],
        ];
    }

    // BO
    public function getModelRelations() {
        return $this->hasMany(ModelRelations::className(), [
                'model_id' => 'id',
            ])->andOnCondition(['model_relations.model' => 'forum']);
    }

    // BO
    public static function getForumList() {

        return static::find()
            ->innerJoinWith('modelRelations')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    //BO
    public static function deleteItem($itemId)
    {
        $delForum = static::find()
            ->select('id')
            ->where(['id' => $itemId])
            ->orWhere(['parent_id' => $itemId])
            ->all();

        if (null !== $delForum) {
            // Delete ModelRelations
            $delModelRelations = ModelRelations::deleteAll(['in', 'model_id', array_values($delForum)]);

            if ($delForum->deleteAll()) {

                Update::add('forum', $delForum->id, 'delete');
                Yii::$app->session->setFlash('success', "Discussion supprimée avec succès");

                return true;
            } else {
                Yii::$app->session->setFlash('warning', "Erreur lors de la suppression de la discussion. Veuillez contacter l‘administrateur");

                return false;
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    // FO
    public static function getActiveForums($parentId = 0, $sort = SORT_DESC) {

        return static::find()
            ->where(['forum.status' => 1, 'forum.parent_id' => $parentId])
            ->orderBy(['forum.created_at' => $sort])
            ->all();
    }
}
