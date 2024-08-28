<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\ModelRelations;
use common\components\MainHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $photo_id 
 * @property string $gender
 * @property string $firstname
 * @property string $lastname
 * @property integer $company_id 
 * @property integer $is_speaker
 * @property string $phone
 * @property string $mobile
 * @property string $department
 * @property string $decision_scope
 * @property string $presentation
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_REFUSED = 0;
    const STATUS_EX_MEMBER = 1;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const IS_SPEAKER = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_EX_MEMBER, self::STATUS_REFUSED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username, $operator = '>=', $role = 4)
    {
        return static::find()
            ->where(['username' => $username, 'status' => self::STATUS_ACTIVE])
            ->andWhere([$operator, 'role', $role])
            ->one();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    //BO
    public static function getUser() {

        $user = User::find()
                    ->innerJoinWith('modelRelations')
                    ->where([
                        'user.id' => Yii::$app->request->get('id')
                    ])
                    ->one();

        // Empty modelReltions
        if (null === $user) 
            $user = User::findOne(Yii::$app->request->get('id'));

        return $user;
    }

    //BO
    public static function deleteItem($itemId)
    {
        $delUser = User::find()
                    ->innerJoinWith('modelRelations')
                    ->where(['user.id' => $itemId])
                    ->one();
                    
        if (null !== $delUser) {
            foreach ($delUser['modelRelations'] as $modelRelation) {
                $modelRelation->delete();
            }
            if ($delUser->delete()) {
                Update::add('user', $delUser->id, 'delete');
                Yii::$app->session->setFlash('success', 'Utilisateur supprimé avec succès');

                return true;
            } else {
                Yii::$app->session->setFlash('warning', 'Erreur lors de la suppression de l‘utilisateur. Veuillez contacter l‘administrateur');

                return false;
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    //BO
    public static function updateStatus($id, $status)
    {
        $user = static::findOne($id);

        if (null !== $user) {
            $user->status = $status;
            if ($user->save()) {

                if ($status == 10) {
                    $subject = Yii::t('app', "Votre profil a été validé");
                    $message = [
                            "Bonjour ".$user->firstname.' '.$user->lastname.',',
                            "Nous avons le plaisir de vous informer que votre profil a été validé avec succès. Vous avez désormais accès à toutes les fonctionnalités du Club Utilisateurs de solutions Genesys & Interactions CX.<br>Nous vous invitons à explorer les différentes sections du site et à participer activement aux discussions et événements.",
                            "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                        ];
                    $res = MainHelper::sendMail($subject, $user->email, ['title' => $subject, 'message' => $message]);
                }
                if ($status == 0) {
                    $subject = Yii::t('app', "Votre demande d'adhésion n’a pas été retenue");
                    $message = [
                            "Bonjour ".$user->firstname.' '.$user->lastname.',',
                            "Après examen de votre demande, nous regrettons de vous informer que votre profil ne répond pas aux critères d'adhésion au Club Utilisateurs de solutions Genesys & Interactions CX.<br>Si vous souhaitez obtenir plus d'informations ou contester cette décision, n'hésitez pas à nous contacter à l'adresse <a href=\"mailto:evenements@clubgenesys.org\">evenements@clubgenesys.org</a>.",
                            "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                        ];
                    $res = MainHelper::sendMail($subject, $user->email, ['title' => $subject, 'message' => $message]);
                }

                Update::add('user', $user->id, 'status');
                Yii::$app->session->setFlash('success', "Statut de l'utilisateur modifié avec succès");

                return true;
            } else {
                Yii::$app->session->setFlash('warning', "Erreur lors de la modification du statut de l'utilisateur. Veuillez contacter l‘administrateur");

                return false;
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }

    // BO
    public function getModelRelations() {
        return $this->hasMany(ModelRelations::className(), [
                'model_id' => 'id'
            ]);
    }

    //BO
    public static function getSpeakers()
    {
        return static::find()
            ->where(['status' => self::STATUS_ACTIVE, 'is_speaker' => self::IS_SPEAKER])
            ->andWhere(['>=', 'role', 3])
            ->all();
    }

    //BO
    public static function getActiveUsers()
    {
        return static::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->all();
    }

    //BO
    public static function getRoles($roleId = null) {

    	$roles = [
    			1 => 'Contact Genesys',
    			2 => 'Prospect',
    			3 => 'Membre',
    			4 => 'Admin',
    			5 => 'Super Admin',
    		];

    	if (null !== $roleId)
    		return $roles[$roleId];
    	else {
            if (Yii::$app->user->identity->role < 5)
                unset($roles[5]);
    		return $roles;
        }
    }

    //BO 
    public static function getUserStatusName($status = null) {
    	$userStatus = [
			    self::STATUS_REFUSED => Yii::t('app', "Refusé"),
			    self::STATUS_EX_MEMBER => Yii::t('app', "Ex-membre"),
			    self::STATUS_INACTIVE => Yii::t('app', "En attente"),
			    self::STATUS_ACTIVE => Yii::t('app', "Actif")
    		];

    	return $status === null ? $userStatus : $userStatus[$status];
    }

    //BO 
    public static function getUserStatusColor($status) {
    	$userStatus = [
			    self::STATUS_REFUSED => 'danger',
			    self::STATUS_EX_MEMBER => 'info',
			    self::STATUS_INACTIVE => 'warning',
			    self::STATUS_ACTIVE => 'success'
    		];

    	return $userStatus[$status];
    }

    //FO 
    public static function getAuthorNicename($userId) {
        $author = static::findOne($userId);

        return null !== $author ? $author->firstname.' '.$author->lastname : false;
    }

    //FO
    public static function getActiveMembers()
    {
        return static::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->andWhere(['role' => 3])
            ->orderBy(['company_id' => SORT_ASC])
            ->all();
    }

    //FO
    public static function getMember($id) {

        $user = User::find()
                    ->innerJoinWith('modelRelations')
                    ->where([
                        'user.id' => $id
                    ])
                    ->one();

        // Empty modelReltions
        if (null === $user) 
            $user = User::findOne($id);

        return $user;
    }
}
