<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Json;
use common\models\Forum;
use common\models\User;
use common\models\Cms;
use common\models\ModelRelations;
use common\components\MainHelper;

/**
 * Contact form
 */
class ForumForm extends Model
{
    public $parentId;
    public $title;
    public $content;

    // ModelRelations
    public $interests;
    public $products;

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', "Titre"),
            'content' => Yii::t('app', "Contenu"),
            'interests' => "Sujets abordés",
            'products' => "Produits concernés",
        ];
    }

    public function rules()
    {
        return [
            [['parentId', 'content'], 'required'],
            [
                ['title'], 'required', 'when' => function ($model) {
                    return $model->parentId == 0;
                },
                'whenClient' => 'function(attribute,value){
                    return $("#' . \yii\helpers\Html::getInputId($this, 'parentId') . '").val() == 0;
                }',
            ],
            [
                ['interests'], 'required', 'when' => function ($model) {
                    return $model->parentId == 0;
                },
                'whenClient' => 'function(attribute,value){
                    return $("#' . \yii\helpers\Html::getInputId($this, 'parentId') . '").val() == 0;
                }',
            ],
            [
                ['products'], 'required', 'when' => function ($model) {
                    return $model->parentId == 0;
                },
                'whenClient' => 'function(attribute,value){
                    return $("#' . \yii\helpers\Html::getInputId($this, 'parentId') . '").val() == 0;
                }',
            ],
        ];
    }

    public function save() {

        if ($this->validate()) {

            $forum = new Forum();
            $forum->title = $this->title;
            $forum->content = $this->content;
            $forum->parent_id = $this->parentId;
            $forum->status = 1;
            $forum->author = Yii::$app->user->identity->id;
            $forum->created_at = time();

            if ($forum->save()) {

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

                // Mail to writer
                $subject = Yii::t('app', "Confirmation de soumission de votre question sur le forum");
                $title = Yii::t('app', "Votre question sur le forum");
                $message = [
                        "Bonjour ".Yii::$app->user->identity->firstname.' '.Yii::$app->user->identity->lastname.',',
                        "Nous vous confirmons que votre question a bien été soumise sur le forum du Club Utilisateurs de solutions Genesys & Interactions CX. Elle est déjà visible pour les autres membres du Club, qui seront informés par mail de la publication de votre question.<br>Merci de votre participation active !",
                        "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                    ];
                $res = MainHelper::sendMail($subject, Yii::$app->user->identity->email, ['title' => $title, 'message' => $message]);

                // Mails to inform members
                if ($this->parentId == 0) {
                    $members = User::getActiveMembers();
                    if (null !== $members) {
                        $subject = Yii::t('app', "Nouvelle question posée sur le forum");
                        foreach ($members as $member) {
                            if ($member->id != Yii::$app->user->identity->id) {
                                $forumPage = Cms::getCmsByTemplate('forum', null, true);
                                $message = [
                                        "Bonjour ".$member->firstname.' '.$member->lastname.',',
                                        "Une nouvelle question a été posée sur le forum du Club Utilisateurs de solutions Genesys & Interactions CX. Nous vous invitons à y répondre ou à participer à la discussion.<br>Vous pouvez consulter la question ici :",
                                        '<a href="'.Yii::$app->urlManager->createAbsoluteUrl(['site/content', 'url' => $forumPage->url, 'id' => $forum->id]).'">'.Html::encode($this->title).'</a>',
                                        "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                                    ];
                                $res = MainHelper::sendMail($subject, $member->email, ['title' => $subject, 'message' => $message]);
                            }
                        } 
                    }
                }

                return $forum;
            } else {
                $err = ['Forum', $forum];
            }

            return [
                'forum' => $forum, 
                'modelRelations' => $modelRelations, 
                'error' => $err
            ];
        }
        return false;

    }
}
