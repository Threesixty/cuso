<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use common\components\MainHelper;

/**
 * Participant model
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $user_id
 * @property integer $registered
 * @property integer $came
 * @property integer $created_at
 * @property integer $updated_at
 */
class Participant extends ActiveRecord
{
    const REGISTER_STATUS_UNREGITERED = 0;
    const REGISTER_STATUS_REGITERED = 1;
    const REGISTER_STATUS_NOT_CAME = 0;
    const REGISTER_STATUS_CAME = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%participant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id', 'created_at'], 'required'],
            [['registered', 'came', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function add($args)
    {
        $participant = Participant::findOne([
                'event_id' => $args['eventId'],
                'user_id' => $args['userId']
            ]);
        if (null !== $participant) {
            $participant->updated_at = time();
        } else {
            $participant = new Participant();
            $participant->created_at = time();
            $participant->event_id = $args['eventId'];
            $participant->user_id = $args['userId'];
        }

        $participant->registered = isset($args['registered']) ? $args['registered'] : $participant->registered;
        $participant->came = isset($args['came']) ? $args['came'] : $participant->came;

        return $participant->save() ? $participant : false;
    }

    //BO 
    public static function getRegisterStatusName($registered) {
        $registerStatusNames = [
                self::REGISTER_STATUS_UNREGITERED => Yii::t('app', "Désinscrit"),
                self::REGISTER_STATUS_REGITERED => Yii::t('app', "Inscrit")
            ];

        return $registered === null ? '' : $registerStatusNames[$registered];
    }

    //BO 
    public static function getRegisterStatusColor($registered) {
        $registerStatusColors = [
                self::REGISTER_STATUS_UNREGITERED => 'warning',
                self::REGISTER_STATUS_REGITERED => 'info',
            ];

        return  $registered === null ? '' : $registerStatusColors[$registered];
    }

    //BO 
    public static function getCameStatusName($came) {
        $registerStatusNames = [
                self::REGISTER_STATUS_UNREGITERED => Yii::t('app', "Absent"),
                self::REGISTER_STATUS_REGITERED => Yii::t('app', "Présent")
            ];

        return $came === null ? 'Non définie' : $registerStatusNames[$came];
    }

    //BO 
    public static function getCameStatusColor($came) {
        $registerStatusColors = [
                self::REGISTER_STATUS_NOT_CAME => 'danger',
                self::REGISTER_STATUS_CAME => 'success',
            ];

        return  $came === null ? '' : $registerStatusColors[$came];
    }
}
