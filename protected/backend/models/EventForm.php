<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Event;
use common\models\Media;
use common\models\Update;
use common\models\ModelRelations;
use backend\models\CmsForm;
use common\components\MainHelper;

/**
 * Cms form
 */
class EventForm extends Model
{
    // Cms
    public $type;
    public $title;
    public $url;
    public $urlRedirect;
    public $template;
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

    // Event
    public $startDatetime;
    public $endDatetime;
    public $eventType;
    public $address;
    public $streetNumber;
    public $route;
    public $postalCode;
    public $locality;
    public $addressDetail;
    public $presentation;
    public $program;
    public $synthesis;
    public $presential;
    public $distance;
    public $prospect;
    public $registerable;
    public $documents;

    // ModelRelations
    public $interests;
    public $products;
    public $communities;
    public $speakers;
    public $sponsors;

    public function attributeLabels()
    {
        return [
            'title' => 'Titre',
            'url' => 'Url',
            'interests' => "Sujets abordés",
            'products' => "Produits concernés",
            'communities' => "Communautés concernées",
            'speakers' => "Intervenants",
            'sponsors' => "Sponsors",
        ];
    }

    public function rules()
    {
        return [
            [['type', 'title', 'metaTitle', 'interests', 'products', 'communities'], 'required'],
            [['tags'], 'default', 'value' => null],
            [['url', 'urlRedirect', 'status', 'photoId', 'metaDescription', 'summary', 'content', 'startDate', 'endDate', 'lang', 'startDatetime', 'endDatetime', 'eventType', 'address', 'streetNumber', 'route', 'postalCode', 'locality', 'addressDetail', 'presentation', 'program', 'synthesis', 'presential', 'distance', 'prospect', 'registerable', 'documents', 'speakers', 'sponsors'], 'safe'],
        ];
    }

    public function save() {

        if ($this->validate()) {

            $model = new CmsForm();
            $model->photoId = '[]';

            $event;
            $modelRelations = [];
            $err = null;

            if (isset($_POST['EventForm'])) {
                $model->attributes = $_POST['EventForm'];

                if ($cms = $model->save('event')) {
                    $event = Event::findOne(['cms_id' => $cms->id]);

                    // Save event
                    $update = 'update';
                    if (null === $event) {
                        $event = new Event();
                        $event->cms_id = $cms->id;
                        $update = 'new';
                    }

                    $event->event_type = $this->eventType;
                    $event->start_datetime = $this->startDatetime != '' ? strtotime(str_replace('/', '-', $this->startDatetime)) : null;
                    $event->end_datetime = $this->endDatetime != '' ? strtotime(str_replace('/', '-', $this->endDatetime)) : null;
                    $event->address = $this->address;
                    $event->street_number = $this->streetNumber;
                    $event->route = $this->route;
                    $event->postal_code = $this->postalCode;
                    $event->locality = $this->locality;
                    $event->address_detail = $this->addressDetail;
                    $event->presentation = $this->presentation;
                    $event->program = $this->program;
                    $event->synthesis = $this->synthesis;
                    $event->presential = $this->presential;
                    $event->distance = $this->distance;
                    $event->prospect = $this->prospect;
                    $event->registerable = $this->registerable;
                    $event->documents = $this->documents;

                    if ($event->save()) {

                        // Delete model relations
                        $delModelRelations = ModelRelations::deleteAll(['model_id' => $cms->id, 'model' => 'event']);

                        // Save model relations
                        if (is_array($this->interests)) {
                            foreach ($this->interests as $value) {
                                $modelRelations['option'][] = [
                                        'typeName' => 'interests',
                                        'typeId' => $value
                                    ];
                                $args = [
                                        'model' => 'event',
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
                                        'model' => 'event',
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
                                        'model' => 'event',
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

                        if (is_array($this->speakers)) {
                            foreach ($this->speakers as $value) {
                                $modelRelations['speakers'][] = [
                                        'typeName' => null,
                                        'typeId' => $value
                                    ];
                                $args = [
                                        'model' => 'event',
                                        'modelId' => $cms->id,
                                        'type' => 'speakers',
                                        'typeName' => null,
                                        'typeId' => $value
                                    ];

                                if (!ModelRelations::add($args)) {
                                    $err = ['ModelRelations', $args];
                                }
                            }
                        }

                        if (is_array($this->sponsors)) {
                            foreach ($this->sponsors as $value) {
                                $modelRelations['sponsors'][] = [
                                        'typeName' => null,
                                        'typeId' => $value
                                    ];
                                $args = [
                                        'model' => 'event',
                                        'modelId' => $cms->id,
                                        'type' => 'sponsors',
                                        'typeName' => null,
                                        'typeId' => $value
                                    ];

                                if (!ModelRelations::add($args)) {
                                    $err = ['ModelRelations', $args];
                                }
                            }
                        }

                        Update::add('event', $cms->id, $update);
                    } else {
                        $err = ['Event', $model];
                    }
                } else {
                    $err = ['Cms', $model];
                }

                return [
                    'cms' => $cms, 
                    'event' => $event, 
                    'modelRelations' => $modelRelations, 
                    'error' => $err
                ];
            }
        }
        
        return false;
    }

    public function find() {

        $cms = Event::getEvent();

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

            if (isset($cms['event'])) {
                $event = $cms['event'];

                $this->eventType = $event->event_type;
                $this->startDatetime = date('d/m/Y H:i', $event->start_datetime);
                $this->endDatetime = date('d/m/Y H:i', $event->end_datetime);
                $this->address = $event->address;
                $this->streetNumber = $event->street_number;
                $this->route = $event->route;
                $this->postalCode = $event->postal_code;
                $this->locality = $event->locality;
                $this->addressDetail = $event->address_detail;
                $this->presentation = $event->presentation;
                $this->program = $event->program;
                $this->synthesis = $event->synthesis;
                $this->presential = $event->presential;
                $this->distance = $event->distance;
                $this->prospect = $event->prospect;
                $this->registerable = $event->registerable;
                $this->documents = $event->documents;
            }

            if (isset($cms['modelRelations'])) {

                foreach ($cms['modelRelations'] as $modelRelation) {
                    if ($modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                        $this->interests[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'option' && $modelRelation->type_name == 'products')
                        $this->products[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'community')
                        $this->communities[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'speakers')
                        $this->speakers[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'sponsors')
                        $this->sponsors[] = $modelRelation->type_id;
                }
            }

            return true;
        } else {
            return false;
        }

    }
}
