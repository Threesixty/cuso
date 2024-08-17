<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Json;
use common\models\Company;
use common\models\Update;
use common\components\MainHelper;

/**
 * Login form
 */
class CompanyForm extends Model
{
    public $name;
    public $photoId;
    public $addressLine1;
    public $addressLine2;
    public $postalCode;
    public $city;
    public $country;
    public $activityArea;
    public $public;
    public $size;
    public $licensesCount;
    public $membershipEnd;
    public $isSponsor;
    public $mainContactName;
    public $mainContactEmail;
    public $mainContactPhone;
    public $billingContactName;
    public $billingContactEmail;
    public $billingContactPhone;
    public $billingPlatform;
    public $informations;
    public $status;
    public $author;
    public $createdAt;

    public function attributeLabels()
    {
        return [
            'name' => "Nom",
            'addressLine1' => "Ligne 1",
            'postalCode' => "Code postal",
            'city' => "Ville",
            'activityArea' => "Secteur d'activités",
            'size' => "Taille",
            'licensesCount' => "Nombre de licences",
            'membershipEnd' => "Date de fin d'adhésion",
            'mainContactName' => "Nom du contact principal",
            'mainContactEmail' => "Email du contact principal",
            'mainContactPhone' => "Téléphone du contact principal",
        ];
    }

    public function rules()
    {
        return [
            [['name', 'addressLine1', 'postalCode', 'city', 'activityArea', 'public', 'size', 'licensesCount', 'membershipEnd', 'isSponsor', 'mainContactName', 'mainContactEmail', 'mainContactPhone'], 'required'],
            [['photoId', 'addressLine2', 'country', 'billingContactName', 'billingContactEmail', 'billingContactPhone', 'billingPlatform', 'informations', 'status'], 'safe'],
        ];
    }

    public function save() {

        if ($this->validate()) {

            $company = new Company();

            $update = 'update';
            if (!empty(Yii::$app->request->get('id'))) {
                $company->id = intval(Yii::$app->request->get('id'));
                $company->isNewRecord = false;
            } else {
                $company->author = Yii::$app->user->identity->id;
                $company->created_at = time();
                $update = 'new';
            }

            $company->name = $this->name;
            $company->photo_id = $this->photoId;
            $company->address_line1 = $this->addressLine1;
            $company->address_line2 = $this->addressLine2;
            $company->postal_code = $this->postalCode;
            $company->city = $this->city;
            $company->country = 'FR';
            $company->activity_area = $this->activityArea;
            $company->public = $this->public;
            $company->size = $this->size;
            $company->licenses_count = $this->licensesCount;
            $company->membership_end = strtotime(str_replace('/', '-', $this->membershipEnd));
            $company->is_sponsor = $this->isSponsor;
            $company->main_contact_name = $this->mainContactName;
            $company->main_contact_email = $this->mainContactEmail;
            $company->main_contact_phone = $this->mainContactPhone;
            $company->billing_contact_name = $this->billingContactName;
            $company->billing_contact_email = $this->billingContactEmail;
            $company->billing_contact_phone = $this->billingContactPhone;
            $company->billing_platform = $this->billingPlatform;
            $company->informations = $this->informations;
            $company->status = $this->status;

            if ($company->save())
                Update::add('company', $company->id, $update);

            return $company;
        }
        
        return false;
    }

    public function find() {

        $company = Company::findOne(Yii::$app->request->get('id'));

        if (null !== $company) {
            $this->name = $company->name;
            $this->photoId = $company->photo_id;
            $this->addressLine1 = $company->address_line1;
            $this->addressLine2 = $company->address_line2;
            $this->postalCode = $company->postal_code;
            $this->city = $company->city;
            $this->country = $company->country;
            $this->activityArea = $company->activity_area;
            $this->public = $company->public;
            $this->size = $company->size;
            $this->licensesCount = $company->licenses_count;
            $this->membershipEnd = date('d/m/Y', $company->membership_end);
            $this->isSponsor = $company->is_sponsor;
            $this->mainContactName = $company->main_contact_name;
            $this->mainContactEmail = $company->main_contact_email;
            $this->mainContactPhone = $company->main_contact_phone;
            $this->billingContactName = $company->billing_contact_name;
            $this->billingContactEmail = $company->billing_contact_email;
            $this->billingContactPhone = $company->billing_contact_phone;
            $this->billingPlatform = $company->billing_platform;
            $this->informations = $company->informations;
            $this->status = $company->status;

            return true;
        } else {
            return false;
        }

    }
}
