<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Event;
use common\models\ModelRelations;
use common\components\MainHelper;

/**
 * Cms model
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property string $url
 * @property string $url_rewrite
 * @property string $template
 * @property string $tags
 * @property string $photo_id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $summary
 * @property string $content
 * @property integer $status
 * @property integer $start_date
 * @property integer $end_date
 * @property string $lang
 * @property integer $lang_parent_id
 * @property integer $author
 * @property integer $created_at
 */
class Cms extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cms}}';
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
    public static function getCmsList() {

        return static::find()->where(['type' => 'cms'])
            ->andWhere([
                'is', 'lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }
    
    // BO
    public static function deleteItem($itemId)
    {
        $delCms = Cms::find()
                ->where(['lang_parent_id' => $itemId])
                ->orWhere(['id' => $itemId])
                ->orderBy(['lang_parent_id' => SORT_DESC])
                ->all();

        if (!empty($delCms)) {
            foreach ($delCms as $content) {
                if ($content->delete() && null === $content->lang_parent_id)
                    Update::add('cms', $content->id, 'delete');
            }
            Yii::$app->session->setFlash('success', 'Contenu supprimé avec succès');

            return true;
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    // BO
    public function getEvent() {
        return $this->hasOne(Event::className(), [
                'cms_id' => 'id'
            ]);
    }
    public function getModelRelations() {
        return $this->hasMany(ModelRelations::className(), [
                'model_id' => 'id'
            ]);
    }

    // FO
    public static function getContent($url = null) {

        $params = [
                'lang' => Yii::$app->language,
                'status' => 1,
            ];

        if (null !== $url) {
            $params['url'] = $url;
        } else {
            $params['template'] = 'index';
        }

        $content = static::find()
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

    // FO
    public static function getContentRedirect($url = null) {

        $params = [
                'lang' => Yii::$app->language,
            ];

        if (null !== $url) {
            $params['url'] = $url;
        } else {
            $params['template'] = 'index';
        }

        $content = static::find()
                        ->where($params)
                        ->one();

        if (null !== $content) {
            $redirectCms = static::getContent($content->url_redirect);
            if ($redirectCms)
                return $redirectCms;
            else
                return false;
        } else {
            return false;
        }
    }

    // FO
    public static function getContentById($id) {

        $params = [
        		'id' => $id,
                'lang' => Yii::$app->language,
                'status' => 1,
            ];

        $content = static::find()
                        ->where($params)
                        ->andWhere([
                                'or',
                                ['>', 'end_date', time()],
                                ['end_date' => 0],
                            ])
                        ->one();

        if (null === $content) {
        	unset($params['id']);

        	$params['lang_parent_id'] = $id;
	        $content = static::find()
	                        ->where($params)
	                        ->andWhere([
	                                'or',
	                                ['>', 'end_date', time()],
	                                ['end_date' => 0],
	                            ])
	                        ->one();
        }

        return $content;
    }

    // FO
    public static function getMenuContentById($id) {

        $params = [
                'lang' => Yii::$app->language,
                'status' => 1,
            ];
        if (Yii::$app->language == 'fr') {
            $params['id'] = $id;
        } else {
            $params['lang_parent_id'] = $id;
        }

        $content = static::find()
                        ->where($params)
                        ->andWhere([
                                'or',
                                ['>', 'end_date', time()],
                                ['end_date' => 0],
                            ])
                        ->one();
        if (null === $content && Yii::$app->language == 'fr') {

            $params['id'] = $id;
            $content = static::find()
                            ->where($params)
                            ->andWhere([
                                    'or',
                                    ['>', 'end_date', time()],
                                    ['end_date' => 0],
                                ])
                            ->one();
        }

        return $content;
    }

    // FO
    public static function getCmsByTemplate($template, $currentId = null, $one = false, $where = false) {

        $cmsByTpl = static::find()
            ->where([
                    'lang' => Yii::$app->language,
                    'status' => 1,
                    'template' => $template,
                ])
            ->andWhere([
                    'or',
                    ['>', 'end_date', time()],
                    ['end_date' => 0],
                ]);

        if (null !== $currentId) {
            $cmsByTpl = $cmsByTpl->andWhere([
                    '!=','id', $currentId
                ]);
        }

        if ($one) {
            $cmsByTpl = $cmsByTpl->one();
        } elseif (!$where) {
            $cmsByTpl = $cmsByTpl->all();
        }

        return $cmsByTpl;
    }

    // FO
    public static function getCmsByTag($tag, $one = false) {

        $cmsByTag = static::find()
            ->where([
                    'lang' => Yii::$app->language,
                    'status' => 1,
                ])
            ->andWhere([
                    'like', 
                    'tags', 
                    '%'.$tag.'%', 
                    false
                ]);

        $cmsByTag = $one ? $cmsByTag->one() : $cmsByTag->all();

        return $cmsByTag;
    }
}
