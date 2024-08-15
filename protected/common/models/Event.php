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
    public static function getEventList() {

        return Cms::find()
            ->innerJoinWith('event')
            ->innerJoinWith('modelRelations')
            ->where([
                'cms.type' => 'event',
            ])
            ->andWhere([
                'is', 'cms.lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['cms.created_at' => SORT_DESC])
            ->all();
    }

    // BO
    public static function getEvent() {

        $event = null;
        if (!empty(Yii::$app->request->get('lang'))) {
            $event = Cms::find()
                        ->innerJoinWith('event')
                        ->innerJoinWith('modelRelations')
                        ->where([
                            'cms.lang_parent_id' => Yii::$app->request->get('id'), 
                            'cms.lang' => Yii::$app->request->get('lang')
                        ])
                        ->one();

            if (null === $event) {
                $event = Cms::find()
                            ->innerJoinWith('event')
                            ->innerJoinWith('modelRelations')
                            ->where([
                                'cms.id' => Yii::$app->request->get('id')
                            ])
                            ->one();

                // Empty modelReltions
                if (null === $event) 
                    $event = Cms::find()
                                ->innerJoinWith('event')
                                ->where([
                                    'cms.id' => Yii::$app->request->get('id')
                                ])->one();
            }
        } else {
            $event = Cms::find()
                        ->innerJoinWith('event')
                        ->innerJoinWith('modelRelations')
                        ->where([
                            'cms.id' => Yii::$app->request->get('id')
                        ])->one();

            // Empty modelReltions
            if (null === $event) 
                $event = Cms::find()
                            ->innerJoinWith('event')
                            ->where([
                                'cms.id' => Yii::$app->request->get('id')
                            ])->one();
        }

        return $event;
    }

    // FO
    public static function getNextEventList($limit = 10) {

        $toComeUpEvents = Cms::find()
            ->innerJoinWith('event')
            ->innerJoinWith('modelRelations')
            ->where([
                'cms.type' => 'event',
                'cms.status' => 1,
                'cms.lang' => Yii::$app->language,
            ])
            ->andWhere(['>', 'event.start_datetime', time()])
            ->limit($limit)
            ->orderBy(['event.start_datetime' => SORT_ASC])
            ->groupBy('event.start_datetime')
            ->all();

        if (count($toComeUpEvents) < 4) {
            $pastEvents = Cms::find()
                ->innerJoinWith('event')
                ->innerJoinWith('modelRelations')
                ->where([
                    'cms.type' => 'event',
                    'cms.status' => 1,
                    'cms.lang' => Yii::$app->language,
                ])
                ->andWhere(['<', 'event.start_datetime', time()])
                ->limit($limit - count($toComeUpEvents))
                ->orderBy(['event.start_datetime' => SORT_DESC])
                ->groupBy('event.start_datetime')
                ->all();

            $toComeUpEvents = array_merge($toComeUpEvents, $pastEvents);
        }

        return $toComeUpEvents;
    }

    // FO
    public static function getContent($url = null) {

        $params = [
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
}
