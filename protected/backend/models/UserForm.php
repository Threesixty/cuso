<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\User;
use common\models\Update;
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
    public $role = 0;
    public $status = 9;
    public $createdAt;
    public $updatedAt;

    private $_user;

    public function attributeLabels()
    {
        return [
            'gender' => 'Civilité',
            'lastname' => 'Nom',
            'firstname' => 'Prénom',
            'role' => 'Rôle',
        ];
    }

    public function rules()
    {
        return [
            [['gender', 'firstname', 'lastname', 'email', 'role'], 'required'],
            [['id', 'firstname', 'lastname', 'email', 'status'], 'trim'],
            [['password'], 'createRequired', 'skipOnEmpty' => false],
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
            $user->role = $this->role;
            $user->status = $this->status;
            
            if ($user->save())
                Update::add('user', $user->id, $update);

            return $user;
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
            $this->role = $user->role;
            $this->status = $user->status;

            return true;
        } else {
            return false;
        }

    }
}
