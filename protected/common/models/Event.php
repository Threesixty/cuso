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
    public static function getEventList() {

        return Cms::find()
            ->innerJoinWith('event')
            ->innerJoinWith('modelRelations')
            ->where([
                'Cms.type' => 'event',
            ])
            ->andWhere([
                'is', 'lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['created_at' => SORT_DESC])
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
                            'lang_parent_id' => Yii::$app->request->get('id'), 
                            'lang' => Yii::$app->request->get('lang')
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
}
