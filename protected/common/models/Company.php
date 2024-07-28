<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\MainHelper;

/**
 * Company model
 *
 * @property integer $id
 * @property string $name
 * @property string $photo_id
 * @property string $address_line1
 * @property string $address_line2
 * @property string $postal_code
 * @property string $city
 * @property string $country
 * @property string $activity_area
 * @property integer $public
 * @property integer $size
 * @property integer $licenses_count
 * @property integer $membership_end
 * @property integer $is_sponsor
 * @property string $main_contact_name
 * @property string $main_contact_email
 * @property string $main_contact_phone
 * @property string $billing_contact_name
 * @property string $billing_contact_email
 * @property string $billing_contact_phone
 * @property string $billing_platform
 * @property integer $status
 * @property integer $author
 * @property integer $created_at
 */
class Company extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    const IS_SPONSOR = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_DRAFT],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_DRAFT]],
        ];
    }

    // BO
    public static function getCompanyList() {

        return static::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    // BO
    public static function getSponsorsNames()
    {
        $sponsors = static::find()
            ->where(['status' => self::STATUS_PUBLISHED, 'is_sponsor' => self::IS_SPONSOR])
            ->all();

        $sponsorList = array_column($sponsors, 'name', 'id');

        return $sponsorList;
    }

    //BO
    public static function deleteItem($itemId)
    {
        $delCompany = static::findOne($itemId);

        if (null !== $delCompany) {
            if ($delCompany->delete()) {

                Update::add('company', $delCompany->id, 'delete');
                Yii::$app->session->setFlash('success', 'Société supprimée avec succès');

                return true;
            } else {
                Yii::$app->session->setFlash('warning', 'Erreur lors de la suppression de la société. Veuillez contacter l‘administrateur');

                return false;
            }
        } else {
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return false;
        }
    }
}
