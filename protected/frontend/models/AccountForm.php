<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\UploadedFile;
use common\models\User;
use common\models\ModelRelations;
use common\models\Media;
use common\models\Update;
use common\components\MainHelper;

/**
 * Account form
 */
class AccountForm extends Model
{
    public $id;
    public $photo;
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $company;
    public $phone;
    public $mobile;
    public $department;
    public $function;
    public $decisionScope;
    public $createdAt;
    public $updatedAt;

    // ModelRelations
    public $interests;
    public $products;

    private $_user;

    public function attributeLabels()
    {
        return [
            'company' => 'Société',
            'lastname' => 'Nom',
            'firstname' => 'Prénom',
            'department' => 'Département / Service',
            'function' => 'Fonction',
            'decisionScope' => 'Périmètre décisionnel'
        ];
    }

    public function rules()
    {
        return [
            [['firstname', 'lastname', 'email', 'company', 'department', 'function', 'decisionScope'], 'required'],
            [['email'], 'trim'],
            [['phone', 'mobile'], 'safe'],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['password'], 'createRequired', 'skipOnEmpty' => false],
            [
                ['phone'],
                'required',
                'when' => function ($model) {
                    return ($model->mobile == '');
                },
                'whenClient' => 'function(attribute,value){
                    return ($("#userform-mobile").val()=="");
                }',
                'message' => Yii::t('app', "Au moins un numéro de téléphone fixe ou mobile doit être saisi"),
            ],
            [
                ['mobile'],
                'required',
                'when' => function ($model) {
                    return ($model->phone == '');
                },
                'whenClient' => 'function(attribute,value){
                    return ($("#userform-phone").val()=="");
                }',
                'message' => Yii::t('app', "Au moins un numéro de téléphone fixe ou mobile doit être saisi"),
            ],
            [['phone', 'mobile'], 'match', 'pattern' => '/^\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}$/', 'message' => Yii::t('app', "Ce n'est pas un numéro de téléphone valide")]
        ];
    }

    /**
     * required only at creation
     */
    public function createRequired($attributeName, $params)
    {
        if (empty(Yii::$app->user->identity->id) && empty($this->password)) {
            $this->addError($attributeName, 'Mot de passe ne peut être vide');

            return false;
        }

        return true;
    }

    public function save() {

        if ($this->validate()) {

            $modelRelations = [];
            $err = null;

            $user = User::findOne(Yii::$app->user->identity->id);

            $this->photo = UploadedFile::getInstance($this, 'photo');
            if (!empty($this->photo)) {
                $filename = $user->id.'_'.strtolower(MainHelper::cleanUrl($user->firstname.'_'.$user->lastname));
                if ($this->photo->saveAs(Yii::getAlias('@uploadFolder').'/'.$filename.'.'.$this->photo->extension)) {

                    $media = new Media();
                    $media->title = $filename;
                    $media->path = $filename.'.'.$this->photo->extension;
                    $media->author = $user->id;
                    $media->created_at = time();
                    if ($media->save()) {
                        $user->photo_id = '['.$media->id.']';
                    }
                }
            }
            $this->photo = $user->photo_id;

            if (!empty($this->password)) {
                $user->setPassword($this->password);
                $user->generateAuthKey();
            }

            $user->email = $this->email;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->phone = $this->phone;
            $user->mobile = $this->mobile;
            $user->department = $this->department;
            $user->function = $this->function;
            $user->decision_scope = $this->decisionScope;
            $user->updated_at = time();

            if ($user->save()) {

	            // Delete model relations
	            $delModelRelations = ModelRelations::deleteAll(['model_id' => $user->id, 'model' => 'user']);

	            // Save model relations
	            if (is_array($this->interests)) {
	                foreach ($this->interests as $value) {
	                    $modelRelations['option'][] = [
	                            'typeName' => 'interests',
	                            'typeId' => $value
	                        ];
	                    $args = [
	                            'model' => 'user',
	                            'modelId' => $user->id,
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
	                            'model' => 'user',
	                            'modelId' => $user->id,
	                            'type' => 'option',
	                            'typeName' => 'products',
	                            'typeId' => $value
	                        ];
	                        
	                    if (!ModelRelations::add($args)) {
	                        $err = ['ModelRelations', $args];
	                    }
	                }
	            }

                Update::add('user', $user->id, 'new');
            } else {
                $err = ['User', $user];
            }

            return [
                'user' => $user,
                'modelRelations' => $modelRelations, 
                'error' => $err
            ];
        }
        
        return false;
    }

    public function find() {

        $user = User::findOne(Yii::$app->user->identity->id);

        if (null !== $user) {
            $this->photo = $user->photo_id;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->firstname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->company = $user->company_id;
            $this->phone = $user->phone;
            $this->mobile = $user->mobile;
            $this->department = $user->department;
            $this->function = $user->function;
            $this->decisionScope = $user->decision_scope;

            if (isset($user['modelRelations'])) {

                foreach ($user['modelRelations'] as $modelRelation) {
                    if ($modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                        $this->interests[] = $modelRelation->type_id;
                    if ($modelRelation->type == 'option' && $modelRelation->type_name == 'products')
                        $this->products[] = $modelRelation->type_id;
                }
            }

            return true;
        } else {
            return false;
        }

    }
}
