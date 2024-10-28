<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\components\MainHelper;

/**
 * Contact form
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public function attributeLabels()
    {
        return [
            'name' => 'Nom',
            'phone' => 'Téléphone',
            'subject' => "Sujet",
            'message' => "Message"
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            [['email'], 'trim'],
            [['subject', 'message'], 'safe'],
            [['phone'], 'match', 'pattern' => '/^\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}$/', 'message' => Yii::t('app', "Ce n'est pas un numéro de téléphone valide")]
        ];
    }

    public function send() {

        $subject = Yii::t('app', 'Formulaire de contact');
        $message = "Nom : ".$this->name."<br>Email : ".$this->email."<br>Téléphone : ".$this->phone."<br>Sujet : ".$this->subject."<br>Message :<br>".$this->message;

        return MainHelper::sendMail($subject, null, ['title' => $subject, 'message' => [$message]]);
    }
}
