<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\User;
use common\models\Update;
use common\models\ModelRelations;
use common\components\MainHelper;

/**
 * Login form
 */
class UserForm extends Model
{
    public $id;
    public $username;
    public $gender;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $photoId;
    public $companyId;
    public $isSpeaker;
    public $phone;
    public $mobile;
    public $department;
    public $function;
    public $decisionScope;
    public $presentation;
    public $role = 0;
    public $status = 9;
    public $createdAt;
    public $updatedAt;

    // ModelRelations
    public $interests;
    public $products;
    public $communities;

    private $_user;

    public function attributeLabels()
    {
        return [
            'companyId' => 'Société',
            'gender' => 'Civilité',
            'lastname' => 'Nom',
            'firstname' => 'Prénom',
            'role' => 'Rôle',
            'department' => 'Département / Service',
            'function' => 'Fonction',
            'decisionScope' => 'Périmètre décisionnel',
            'interests' => "Sujets abordés",
            'products' => "Produits utilisés",
            'communities' => "Communautés concernées",
        ];
    }

    public function rules()
    {
        return [
            [['gender', 'firstname', 'lastname', 'email', 'role', 'companyId', 'department', 'function', 'decisionScope', 'interests', 'products', 'communities'], 'required'],
            [['email'], 'trim'],
            [['photoId', 'isSpeaker', 'phone', 'mobile', 'presentation', 'status'], 'safe'],
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
                'message' => 'Au moins un numéro de téléphone fixe ou mobile doit être saisi',
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
                'message' => 'Au moins un numéro de téléphone fixe ou mobile doit être saisi',
            ],
            [['phone', 'mobile'], 'match', 'pattern' => '/^\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}$/', 'message' => "Ce n'est pas un numéro de téléphone valide"]
        ];
    }

    /**
     * required only at creation
     */
    public function createRequired($attributeName, $params)
    {
        if (empty(Yii::$app->request->get('id')) && empty($this->password)) {
            $this->addError($attributeName, 'Mot de passe ne peut être vide');

            return false;
        }

        return true;
    }

    public function save() {

        if ($this->validate()) {

            $user = new User();

            $modelRelations = [];
            $err = null;

            $update = 'update';
            if (!empty(Yii::$app->request->get('id'))) {
                $user->id = intval(Yii::$app->request->get('id'));
                $user->isNewRecord = false;
                $user->updated_at = time();
            } else {
                $user->created_at = time();
                $user->updated_at = time();
                $update = 'new';
            }

            if (!empty($this->password)) {
                $user->setPassword($this->password);
                $user->generateAuthKey();
            }

            $user->username = $this->email;
            $user->email = $this->email;
            $user->gender = $this->gender;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->photo_id = $this->photoId;
            $user->company_id = $this->companyId;
            $user->is_speaker = $this->isSpeaker;
            $user->phone = $this->phone;
            $user->mobile = $this->mobile;
            $user->department = $this->department;
            $user->function = $this->function;
            $user->decision_scope = $this->decisionScope;
            $user->presentation = $this->presentation;
            $user->role = $this->role;
            $user->status = $this->status;

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

	            if (is_array($this->communities)) {
	                foreach ($this->communities as $value) {
	                    $modelRelations['communities'][] = [
	                            'typeName' => null,
	                            'typeId' => $value
	                        ];
	                    $args = [
	                            'model' => 'user',
	                            'modelId' => $user->id,
	                            'type' => 'community',
	                            'typeName' => null,
	                            'typeId' => $value
	                        ];
	                        
	                    if (!ModelRelations::add($args)) {
	                        $err = ['ModelRelations', $args];
	                    }
	                }
	            } 

                Update::add('user', $user->id, $update);
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

        $user = User::findOne(Yii::$app->request->get('id'));

        if (null !== $user) {
            $this->username = $user->username;
            $this->email = $user->email;
            $this->gender = $user->gender;
            $this->firstname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->photoId = $user->photo_id;
            $this->companyId = $user->company_id;
            $this->isSpeaker = $user->is_speaker;
            $this->phone = $user->phone;
            $this->mobile = $user->mobile;
            $this->department = $user->department;
            $this->function = $user->function;
            $this->decisionScope = $user->decision_scope;
            $this->presentation = $user->presentation;
            $this->role = $user->role;
            $this->status = $user->status;

            if (isset($user['modelRelations'])) {

                foreach ($user['modelRelations'] as $modelRelation) {
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
