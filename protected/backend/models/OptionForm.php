<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\Option;
use common\models\Update;
use common\components\MainHelper;

/**
 * Login form
 */
class OptionForm extends Model
{
    public $title;
    public $name;
    public $description;
    public $options;
    public $optionsContents;
    public $lang;
    public $langParentId;
    public $author;
    public $createdAt;

    public function attributeLabels()
    {
        return [
            'title' => 'Titre',
            'name' => 'Nom',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'name'], 'required'],
            [['description', 'options', 'optionsContents', 'lang', 'langParentId'], 'safe'],
        ];
    }

    public function save() {

        if ($this->validate()) {

            $option = new Option();

            $update = 'update';
            if (!empty(Yii::$app->request->get('id')) && empty(Yii::$app->request->get('lang'))) {
                $option->id = intval(Yii::$app->request->get('id'));
                $option->isNewRecord = false;
            } elseif (!empty(Yii::$app->request->get('id')) && !empty(Yii::$app->request->get('lang'))) {
                $currentOption = Option::findOne(['lang_parent_id' => Yii::$app->request->get('id'), 'lang' => Yii::$app->request->get('lang')]);
                if (null !== $currentOption) {
                    $option->id = $currentOption->id;
                    $option->isNewRecord = false;
                } else {
                    $option->created_at = time();
                    $option->author = Yii::$app->user->identity->id;
                    $update = 'new';
                }
            } else {
                $option->created_at = time();
                $option->author = Yii::$app->user->identity->id;
                $update = 'new';
            }

            $option->title = $this->title;
            $option->name = MainHelper::cleanUrl($this->name);
            $option->description = $this->description;
            $option->options = $this->options;
            $option->options_contents = $this->optionsContents;
            $option->lang = !empty(Yii::$app->request->get('lang')) ? Yii::$app->request->get('lang') : 'fr';
            $option->lang_parent_id = !empty(Yii::$app->request->get('lang')) ? Yii::$app->request->get('id') : null;

            if ($option->save())
                Update::add('option', $option->id, $update);

            return $option;
        }
        
        return false;
    }

    public function find() {

        $option = null;
        if (!empty(Yii::$app->request->get('lang'))) {
            $option = Option::findOne(['lang_parent_id' => Yii::$app->request->get('id'), 'lang' => Yii::$app->request->get('lang')]);
            if (null === $option)
                $option = Option::findOne(['id' => Yii::$app->request->get('id')]);
        } else {
            $option = Option::findOne(['id' => Yii::$app->request->get('id')]);
        }

        if (null !== $option) {
            $this->title = $option->title;
            $this->name = $option->name;
            $this->description = $option->description;
            $this->options = $option->options;
            $this->optionsContents = $option->options_contents;
            $this->lang = $option->lang;
            $this->langParentId = $option->lang_parent_id;

            return true;
        } else {
            return false;
        }

    }
}
