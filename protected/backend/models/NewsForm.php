<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Media;
use common\models\Update;
use common\models\ModelRelations;
use backend\models\CmsForm;
use common\components\MainHelper;

/**
 * Cms form
 */
class NewsForm extends Model
{
    public $type;
    public $title;
    public $url;
    public $urlRedirect;
    public $tags;
    public $photoId;
    public $metaTitle;
    public $metaDescription;
    public $summary;
    public $content;
    public $status = 0;
    public $startDate;
    public $endDate;
    public $lang;
    public $langParentId;
    public $author;
    public $createdAt;

    // ModelRelations
    public $interests;
    public $products;
    public $communities;

    public function attributeLabels()
    {
        return [
            'title' => 'Titre',
            'url' => 'Url',
        ];
    }

    public function rules()
    {
        return [
            [['type', 'title', 'metaTitle'], 'required'],
            [['url', 'urlRedirect', 'status', 'photoId', 'metaDescription', 'summary', 'content', 'startDate', 'endDate', 'lang', 'interests', 'products', 'communities'], 'safe'],
        ];
    }

    public function save($type = null) {

        if ($this->validate()) {

            $model = new CmsForm();
            $model->photoId = '[]';

            $modelRelations = [];
            $err = null;

            if (isset($_POST['NewsForm'])) {
                $model->attributes = $_POST['NewsForm'];

                if ($cms = $model->save('news')) {

                    // Delete model relations
                    $delModelRelations = ModelRelations::deleteAll(['model_id' => $cms->id, 'model' => 'news']);

                    // Save model relations
                    if (is_array($this->interests)) {
                        foreach ($this->interests as $value) {
                            $modelRelations['option'][] = [
                                    'typeName' => 'interests',
                                    'typeId' => $value
                                ];
                            $args = [
                                    'model' => 'news',
                                    'modelId' => $cms->id,
                                    'type' => 'option',
                                    'typeName' => 'interests',
                                    'typeId' => $value
                                ];
                                
                            if (!ModelRelations::add($args)) {
                                $err = ['ModelRelations', $args];
                            }
                        }
                    }

                    if (is_array($this->products)) {
                        foreach ($this->products as $value) {
                            $modelRelations['option'][] = [
                                    'typeName' => 'products',
                                    'typeId' => $value
                                ];
                            $args = [
                                    'model' => 'news',
                                    'modelId' => $cms->id,
                                    'type' => 'option',
                                    'typeName' => 'products',
                                    'typeId' => $value
                                ];
                                
                            if (!ModelRelations::add($args)) {
                                $err = ['ModelRelations', $args];
                            }
                        }
                    }

                    if (is_array($this->communities)) {
                        foreach ($this->communities as $value) {
                            $modelRelations['communities'][] = [
                                    'typeName' => null,
                                    'typeId' => $value
                                ];
                            $args = [
                                    'model' => 'news',
                                    'modelId' => $cms->id,
                                    'type' => 'community',
                                    'typeName' => null,
                                    'typeId' => $value
                                ];
                                
                            if (!ModelRelations::add($args)) {
                                $err = ['ModelRelations', $args];
                            }
                        }
                    }

                    Update::add('news', $cms->id, $update);
                } else {
                    $err = ['Cms', $model];
                }

                return [
                    'cms' => $cms,
                    'modelRelations' => $modelRelations, 
                    'error' => $err
                ];
            }
        }
        
        return false;
    }

    public function find() {

        $cms = News::getNews();

        if (null !== $cms) {
            $this->type = $cms->type;
            $this->title = $cms->title;
            $this->url = $cms->url;
            $this->urlRedirect = $cms->url_redirect;
            $this->photoId = $cms->photo_id;
            $this->metaTitle = $cms->meta_title;
            $this->metaDescription = $cms->meta_description;
            $this->summary = $cms->summary;
            $this->content = $cms->content;
            $this->status = $cms->status;
            $this->startDate = date('d/m/Y', $cms->start_date);
            $this->endDate = $cms->end_date ? date('d/m/Y)', $cms->end_date) : '';
            $this->lang = $cms->lang;
            $this->langParentId = $cms->lang_parent_id;

            if (isset($cms['modelRelations'])) {

                foreach ($cms['modelRelations'] as $modelRelation) {
                    if ($modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                        $this->interests[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'option' && $modelRelation->type_name == 'products')
                        $this->products[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'community')
                        $this->communities[] = $modelRelation->type_id;
                }
            }

            return true;
        } else {
            return false;
        }

    }
}
