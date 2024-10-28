<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;
use common\components\MainHelper;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;

    public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', 'Mot de passe'),
        ];
    }

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }

    /**
     * Sends an email.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        $subject = Yii::t('app', "Confirmation de changement de mot de passe");
        $title = Yii::t('app', "Mot de passe modifé");
        $message = [
                "Bonjour ".$user->firstname.' '.$user->lastname.',',
                "Votre mot de passe a été modifié avec succès. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.<br>Si vous n'êtes pas à l'origine de cette modification, veuillez nous contacter immédiatement à l'adresse <a href=\"mailto:evenements@clubgenesys.org\">evenements@clubgenesys.org</a>.",
                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
            ];
            
        return MainHelper::sendMail($subject, $user->email, ['title' => $title, 'message' => $message]);
    }
}
