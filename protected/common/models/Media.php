<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Media model
 *
 * @property integer $id
 * @property string $title
 * @property string $alt
 * @property string $legend
 * @property string $path
 * @property string $tags
 * @property string $link
 * @property string $lang
 * @property integer $lang_parent_id
 * @property integer $author
 * @property integer $created_at
 */
class Media extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'alt', 'legend', 'path', 'legend', 'tags', 'link', 'lang', 'lang_parent_id', 'created_at'], 'safe'],
        ];
    }

    // BO
    public static function deleteItem($itemId)
    {
        $delMedia = static::findOne($itemId);

        if (null !== $delMedia) {
            if (unlink(Yii::getAlias('@uploadFolder').'/'.$delMedia->path) && $delMedia->delete()) {
                
                $delLangMedia = static::find()
                                ->where(['lang_parent_id' => $itemId])
                                ->all();
                $res = array_map(function($langMedia) { return $langMedia->delete();}, $delLangMedia);

                Update::add('media', $delMedia->id, 'delete');
                Yii::$app->session->setFlash('success', 'Media supprimé avec succès');

                return true;
            } else {
                Yii::$app->session->setFlash('warning', 'Erreur lors de la suppression du média. Veuillez contacter l‘administrateur');

                return false;
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    // BO
    public static function findByLang($photoId)
    {

        $params = [
                'lang' => Yii::$app->language,
            ];
        if (Yii::$app->language == 'fr') {
            $params['id'] = $photoId;
        } else {
            $params['lang_parent_id'] = $photoId;
        }

        $media = static::find()
                        ->where($params)
                        ->one();

        if (null === $media) {
            $media = static::find()
                        ->where(['id' => $photoId])
                        ->one();
        }

        return $media;
    }
}
