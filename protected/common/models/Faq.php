<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\MainHelper;

/**
 * Faq model
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $content
 * @property integer $status
 * @property integer $hotel
 * @property string $category
 * @property string $lang
 * @property integer $lang_parent_id
 * @property integer $author
 * @property integer $created_at
 */
class Faq extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%faq}}';
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
    public static function getFaqList() {

        return static::find()->where([
                'is', 'lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }
    // BO
    public static function deleteItem($itemId)
    {
        $delFaq = Faq::find()
                ->where(['lang_parent_id' => $itemId])
                ->orWhere(['id' => $itemId])
                ->orderBy(['lang_parent_id' => SORT_DESC])
                ->all();

        if (!empty($delFaq)) {
            foreach ($delFaq as $content) {
                if ($content->delete() && null === $content->lang_parent_id)
                    Update::add('Faq', $content->id, 'delete');
            }
            Yii::$app->session->setFlash('success', 'Question supprimée avec succès');

            return true;
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    // BO
    public static function getFaqByHotelAndCategory($hotelId, $category, $lang) {

        return static::find()
            ->where([
                'lang' => $lang,
                'status' => 1
            ])
            ->andWhere([
                'like', 'hotel', $hotelId
            ])
            ->andWhere([
                'like', 'category', '"'.$category.'"'
            ])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    // FO
    public static function getFaqById($id) {

        $params = [
                'id' => $id,
                'lang' => Yii::$app->language,
                'status' => 1,
            ];

        $faq = static::find()
                        ->where($params)
                        ->one();

        if (null === $faq) {
            unset($params['id']);

            $params['lang_parent_id'] = $id;
            $faq = static::find()
                            ->where($params)
                            ->one();
        }

        return $faq;
    }

    // FO
    public static function searchFaq($hotel, $query) {

        $query = static::find()
            ->where([
                'lang' => Yii::$app->language,
                'status' => 1
            ])
            ->andWhere([
                'like', 'hotel', '"'.$hotel.'"'
            ])
            ->andWhere([
                'like', 'content', $query
            ])
            ->orderBy(['created_at' => SORT_DESC]);
        
        return $query->all();
    }

}
