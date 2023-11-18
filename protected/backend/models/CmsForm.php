<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Media;
use common\models\Update;
use common\components\MainHelper;

/**
 * Cms form
 */
class CmsForm extends Model
{
    public $type;
    public $title;
    public $url;
    public $urlRedirect;
    public $template;
    public $tags;
    public $photoId;
    public $youtubeEmbed;
    public $youtubeOn = 0;
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
            [['tags'], 'default', 'value' => null],
            [['url', 'urlRedirect', 'status', 'photoId', 'template', 'metaDescription', 'summary', 'content', 'startDate', 'endDate', 'lang'], 'safe'],
        ];
    }

    public function save($type = null) {

        if ($this->validate()) {

            $cms = new Cms();

            $update = 'update';
            if (!empty(Yii::$app->request->get('id')) && empty(Yii::$app->request->get('lang'))) {
                $cms->id = intval(Yii::$app->request->get('id'));
                $cms->isNewRecord = false;
            } elseif (!empty(Yii::$app->request->get('id')) && !empty(Yii::$app->request->get('lang'))) {
                $currentCms = Cms::findOne(['lang_parent_id' => Yii::$app->request->get('id'), 'lang' => Yii::$app->request->get('lang')]);
                if (null !== $currentCms) {
                    $cms->id = $currentCms->id;
                    $cms->isNewRecord = false;
                } else {
                    $this->url = MainHelper::cleanUrl($this->title);
                    $cms->created_at = time();
                    $cms->author = Yii::$app->user->identity->id;
                    $update = 'new';
                }
            } else {
                $this->url = MainHelper::cleanUrl($this->title);
                $cms->created_at = time();
                $cms->author = Yii::$app->user->identity->id;
                $update = 'new';
            }

            $cms->type = $this->type;
            $cms->title = $this->title;
            $cms->url = $this->url != '' ? trim(MainHelper::cleanUrl($this->url), '/') : trim(MainHelper::cleanUrl($this->title), '/');
            $cms->url_redirect = $this->urlRedirect;
            $cms->template = $this->template;
            $cms->tags = Json::encode($this->tags);
            $cms->photo_id = $this->photoId;
            $cms->meta_title = $this->metaTitle;
            $cms->meta_description = $this->metaDescription;
            $cms->summary = $this->summary;
            $cms->content = $this->content;
            $cms->status = $this->status;
            $cms->start_date = $this->startDate != '' ? strtotime(str_replace('/', '-', $this->startDate)) : time();
            $cms->end_date = strtotime(str_replace('/', '-', $this->endDate));
            $cms->lang = !empty(Yii::$app->request->get('lang')) ? Yii::$app->request->get('lang') : 'fr';
            $cms->lang_parent_id = !empty(Yii::$app->request->get('lang')) ? Yii::$app->request->get('id') : null;

            $cms->url = MainHelper::uniqueUrl($cms, Yii::$app->request->get('id'));

            if ($cms->save() && null === $type)
                Update::add('cms', $cms->id, $update);

            return $cms;
        }
        
        return false;
    }

    public function find() {

        $cms = null;
        if (!empty(Yii::$app->request->get('lang'))) {
            $cms = Cms::findOne(['lang_parent_id' => Yii::$app->request->get('id'), 'lang' => Yii::$app->request->get('lang')]);
            if (null === $cms)
                $cms = Cms::findOne(['id' => Yii::$app->request->get('id')]);
        } else {
            $cms = Cms::findOne(['id' => Yii::$app->request->get('id')]);
        }

        if (null !== $cms) {
            $this->type = $cms->type;
            $this->title = $cms->title;
            $this->url = $cms->url;
            $this->urlRedirect = $cms->url_redirect;
            $this->template = $cms->template;
            $this->tags = Json::decode($cms->tags);
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

            return true;
        } else {
            return false;
        }

    }
}
