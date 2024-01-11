<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Forum;
use common\models\Media;
use common\models\Update;
use common\models\ModelRelations;
use common\components\MainHelper;

/**
 * Cms form
 */
class ForumForm extends Model
{
    public $title;
    public $content;
    public $parentId;
    public $status = 0;
    public $author;
    public $createdAt;

    // ModelRelations
    public $interests;
    public $products;
    public $communities;

    public function attributeLabels()
    {
        return [
            'title' => "Titre",
            'content' => "Sujet",
            'interests' => "Sujets abordés",
            'products' => "Produits concernés",
            'communities' => "Communautés concernées",
        ];
    }

    public function rules()
    {
        return [
            [['title', 'interests', 'products', 'communities', 'content'], 'required'],
            [['parentId', 'status'], 'safe'],
        ];
    }

    public function save($type = null) {

        if ($this->validate()) {

            $forum = new Forum();

            $modelRelations = [];
            $err = null;

            $update = 'update';
            if (!empty(Yii::$app->request->get('id'))) {
                $forum->id = intval(Yii::$app->request->get('id'));
                $forum->isNewRecord = false;
            } else {
                $forum->author = Yii::$app->user->identity->id;
                $forum->created_at = time();
                $update = 'new';
            }

            $forum->title = $this->title;
            $forum->content = $this->content;
            $forum->parent_id = 0;
            $forum->status = $this->status;

            if ($forum->save()) {
                // Delete model relations
                $delModelRelations = ModelRelations::deleteAll(['model_id' => $forum->id, 'model' => 'forum']);

                // Save model relations
                if (is_array($this->interests)) {
                    foreach ($this->interests as $value) {
                        $modelRelations['option'][] = [
                                'typeName' => 'interests',
                                'typeId' => $value
                            ];
                        $args = [
                                'model' => 'forum',
                                'modelId' => $forum->id,
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
                                'model' => 'forum',
                                'modelId' => $forum->id,
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
                                'model' => 'forum',
                                'modelId' => $forum->id,
                                'type' => 'community',
                                'typeName' => null,
                                'typeId' => $value
                            ];
                            
                        if (!ModelRelations::add($args)) {
                            $err = ['ModelRelations', $args];
                        }
                    }
                }

            } else {
                $err = ['Forum', $model];
            }

            return [
                'forum' => $forum,
                'modelRelations' => $modelRelations, 
                'error' => $err
            ];
        }
        
        return false;
    }

    public function find() {

        $forum = Forum::findOne(Yii::$app->request->get('id'));

        if (null !== $forum) {
            $this->title = $forum->title;
            $this->content = $forum->content;
            $this->parentId = $forum->parent_id;
            $this->status = $forum->status;

            if (isset($forum['modelRelations'])) {

                foreach ($forum['modelRelations'] as $modelRelation) {
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
