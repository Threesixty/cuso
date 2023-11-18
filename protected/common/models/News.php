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
class News extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
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
    public static function getNewsList() {

        return Cms::find()
            ->where([
                'Cms.type' => 'news',
            ])
            ->andWhere([
                'is', 'lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    // BO
    public static function getNews() {

        $news = null;
        if (!empty(Yii::$app->request->get('lang'))) {
            $news = Cms::find()
                        ->innerJoinWith('modelRelations')
                        ->where([
                            'lang_parent_id' => Yii::$app->request->get('id'), 
                            'lang' => Yii::$app->request->get('lang')
                        ])
                        ->one();

            if (null === $news) {
                $news = Cms::find()
                            ->innerJoinWith('modelRelations')
                            ->where([
                                'cms.id' => Yii::$app->request->get('id')
                            ])
                            ->one();

                // Empty modelReltions
                if (null === $news) 
                    $news = Cms::find()
                                ->where([
                                    'cms.id' => Yii::$app->request->get('id')
                                ])->one();
            }
        } else {
            $news = Cms::find()
                        ->innerJoinWith('modelRelations')
                        ->where([
                            'cms.id' => Yii::$app->request->get('id')
                        ])->one();

            // Empty modelReltions
            if (null === $news) 
                $news = Cms::find()
                            ->where([
                                'cms.id' => Yii::$app->request->get('id')
                            ])->one();
        }

        return $news;
    }
}
