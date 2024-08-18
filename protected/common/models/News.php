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
            ->innerJoinWith('modelRelations')
            ->where([
                'cms.type' => 'news',
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
    
    // BO
    public static function deleteItem($itemId)
    {
        $delCms = Cms::find()
                ->innerJoinWith('modelRelations')
                ->where(['cms.lang_parent_id' => $itemId])
                ->orWhere(['cms.id' => $itemId])
                ->orderBy(['lang_parent_id' => SORT_DESC])
                ->all();

        if (!empty($delCms)) {
            foreach ($delCms as $content) {
                foreach ($content['modelRelations'] as $modelRelation) {
                    $modelRelation->delete();
                }
                if ($content->delete() && null === $content->lang_parent_id)
                    Update::add('news', $content->id, 'delete');
            }
            Yii::$app->session->setFlash('success', 'Contenu supprimé avec succès');

            return true;
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    // FO
    public static function getContent($url = null) {

        $params = [
                'cms.type' => 'news',
                'cms.lang' => Yii::$app->language,
                'cms.status' => 1,
                'cms.url' => $url
            ];

        $content = Cms::find()
                        ->innerJoinWith('modelRelations')
                        ->where($params)
                        ->andWhere([
                                'or',
                                ['>', 'end_date', time()],
                                ['end_date' => 0],
                            ])
                        ->one();

        if (null !== $content) {
            $content->content = JSON::decode($content->content);
            return $content;
        } else {
            return false;
        }
    }

    // BO
    public static function getLastNews($limit = 10) {

        return Cms::find()
            ->innerJoinWith('modelRelations')
            ->where([
                'cms.type' => 'news',
                'cms.lang' => Yii::$app->language,
                'cms.status' => 1
            ])
            ->limit($limit)
            ->orderBy(['cms.start_date' => SORT_DESC])
            ->groupBy(['cms.start_date'])
            ->all();
    }
}
