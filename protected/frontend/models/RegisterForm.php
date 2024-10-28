<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Company;
use common\models\ModelRelations;
use common\models\Update;
use common\components\MainHelper;

/**
 * Login form
 */
class RegisterForm extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $mobile;
    public $department;
    public $function;
    public $decisionScope;
    public $companyName;
    public $companyAddressLine1;
    public $companyAddressLine2;
    public $companyAddressZipcode;
    public $companyAddressCity;
    public $companyActivityArea;
    public $companySize;
    public $companyPublic;
    public $companyMainContactName;
    public $companyMainContactEmail;
    public $companyMainContactPhone;
    public $companyBillingContactName;
    public $companyBillingContactEmail;
    public $companyBillingContactPhone;
    public $company;
    public $interests;
    public $products;
    public $cgu;

    private $_user;

    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('app', 'Prénom'),
            'lastname' => Yii::t('app', 'Nom'),
            'password' => Yii::t('app', 'Mot de passe'),
            'department' => Yii::t('app', 'Département / Service'),
            'function' => Yii::t('app', 'Fonction'),
            'decisionScope' => Yii::t('app', 'Périmètre décisionnel'),
            'companyName' => Yii::t('app', 'Nom'),
            'companyAddressLine1' => Yii::t('app', 'Numéro et Voie'),
            'companyAddressZipcode' => Yii::t('app', "Code postal"),
            'companyAddressCity' => Yii::t('app', 'Ville'),
            'companyActivityArea' => Yii::t('app', "Secteur d'activités"),
            'companySize' => Yii::t('app', "Taille de l'entreprise"),
            'companyMainContactName' => Yii::t('app', 'Nom du contact principal'),
            'companyMainContactEmail' => Yii::t('app', 'Email du contact principal'),
            'companyMainContactPhone' => Yii::t('app', 'Téléphone du contact principal'),
            'companyBillingContactName' => Yii::t('app', 'Nom du contact facturation'),
            'companyBillingContactEmail' => Yii::t('app', 'Email du contact facturation'),
            'companyBillingContactPhone' => Yii::t('app', 'Téléphone du contact facturation'),
            'interests' => Yii::t('app', "Centres d'intérêts"),
            'products' => Yii::t('app', 'Produits utilisés'),
            'cgu' => Yii::t('app', "Conditions générales d'utilisation"),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['firstname', 'lastname', 'email', 'password', 'department', 'function', 'decisionScope'], 'required'],
            ['email', 'email', 'message' => "Format de l'email incorrect"],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            [['company', 'companyName', 'companyAddressLine1', 'companyAddressLine2', 'companyAddressZipcode', 'companyAddressCity', 'companyActivityArea', 'companySize', 'companyPublic', 'companyMainContactName', 'companyMainContactEmail', 'companyMainContactPhone', 'companyBillingContactName', 'companyBillingContactEmail', 'companyBillingContactPhone', 'interests', 'products'], 'safe'],
            [
                ['company'],
                'required',
                'when' => function ($model) {
                    return ($model->companyName == '');
                },
                'whenClient' => 'function(attribute,value){
                    return ($("#registerform-companyname").val()=="");
                }',
                'message' => 'Vous devez sélectionner un société ou en renseigner une en cliquant sur le bouton "Je ne trouve pas ma société".',
            ],
            [
                ['companyName', 'companyAddressLine1', 'companyAddressZipcode', 'companyAddressCity', 'companyActivityArea', 'companySize', 'companyMainContactName', 'companyMainContactEmail', 'companyMainContactPhone', 'companyBillingContactName', 'companyBillingContactEmail', 'companyBillingContactPhone'],
                'required',
                'when' => function ($model) {
                    return ($model->company == '');
                },
                'whenClient' => 'function(attribute,value){
                    return ($("#registerform-company").val()=="");
                }',
            ],
            [
                ['phone'],
                'required',
                'when' => function ($model) {
                    return ($model->mobile == '');
                },
                'whenClient' => 'function(attribute,value){
                    return ($("#registerform-mobile").val()=="");
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
                    return ($("#registerform-phone").val()=="");
                }',
                'message' => 'Au moins un numéro de téléphone fixe ou mobile doit être saisi',
            ],
            [['phone', 'mobile'], 'match', 'pattern' => '/^\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}$/', 'message' => "Ce n'est pas un numéro de téléphone valide"],
            [['cgu'], 'required', 'requiredValue' => 1, 'message' => Yii::t('app', "Vous devez accepter les conditions générales d'inscription.")],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        return true;
    }

    /**
     * Register a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $company = new Company();

            $modelRelations = [];
            $err = null;

            if ($this->company != '') {
                $company = Company::findOne($this->company);
                $user->company_id = $this->company;
            } else {
                $company->author = 1;
                $company->created_at = time();
                $company->name = $this->companyName;
                $company->address_line1 = $this->companyAddressLine1;
                $company->address_line2 = $this->companyAddressLine2;
                $company->postal_code = $this->companyAddressZipcode;
                $company->city = $this->companyAddressCity;
                $company->country = 'FR';
                $company->activity_area = $this->companyActivityArea;
                $company->size = $this->companySize;
                $company->main_contact_name = $this->companyMainContactName;
                $company->main_contact_email = $this->companyMainContactEmail;
                $company->main_contact_phone = $this->companyMainContactPhone;
                $company->billing_contact_name = $this->companyBillingContactName;
                $company->billing_contact_email = $this->companyBillingContactEmail;
                $company->billing_contact_phone = $this->companyBillingContactPhone;
                $company->status = 0;

                if ($company->save()) {
                    $user->company_id = $company->id;
                }
            }

            $user->created_at = time();
            $user->updated_at = time();
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->username = $this->email;
            $user->email = $this->email;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->phone = $this->phone;
            $user->mobile = $this->mobile;
            $user->department = $this->department;
            $user->function = $this->function;
            $user->decision_scope = $this->decisionScope;
            $user->role = 3;
            $user->status = 9;

            if ($user->save()) {
                // Update company author
                $company->author = $user->id;
                $company->save();
                Update::add('company', $company->id, 'new', $user->id);

                // Save model relations
                if (is_array($this->interests)) {
                    foreach ($this->interests as $value) {
                        if ($value) {
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
                }

                if (is_array($this->products)) {
                    foreach ($this->products as $value) {
                        if ($value) {
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
                }

                Update::add('user', $user->id, 'new', $user->id);
            } else {
                $err = ['User', $user];
            }

            return [
                'user' => $user,
                'company' => $company,
                'modelRelations' => $modelRelations, 
                'error' => $err
            ];
        }
        
        return false;
    }

    /**
     * Sends a validation email.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        $subject = Yii::t('app', "Confirmation de réception de votre demande d'adhésion au Club Utilisateurs");
        $title = Yii::t('app', "Réception de votre demande d'adhésion");
        $message = [
                "Bonjour ".$this->firstname.' '.$this->lastname.',',
                "Nous vous remercions pour votre demande d'adhésion au Club Utilisateurs de solutions Genesys & Interactions CX. Votre demande a bien été reçue et est en cours de traitement. Vous recevrez un mail de notification concernant l'état de votre demande par email une fois votre adhésion traitée par le contact principal de votre société, dans un délai d'environ 48h.<br>N'hésitez pas à nous contacter si vous avez des questions ou si vous avez besoin d'informations supplémentaires.",
                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
            ];

        return MainHelper::sendMail($subject, $this->email, ['title' => $title, 'message' => $message]);
    }

    /**
     * Sends an email to main contact.
     *
     * @return bool whether the email was send
     */
    public function sendEmailToMainContact($company)
    {
        $subject = Yii::t('app', "Demande de validation d’un nouveau contact pour ").$company->name;
        $title = Yii::t('app', "Demande de validation d’un nouveau contact");
        $message = [
                "Bonjour ".$company->main_contact_name.',',
                "Un nouveau contact, ".$this->firstname." ".$this->lastname.", a demandé à rejoindre le Club Utilisateurs de solutions Genesys & Interactions CX au nom de votre entreprise, ".$company->name.".<br>Merci d'indiquer par retour de mail à l'adresse <a href=\"mailto:evenements@clubgenesys.org\">evenements@clubgenesys.org</a> si vous souhaitez valider ou refuser cette demande de création de compte.",
                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
            ];

        return MainHelper::sendMail($subject, $company->main_contact_email, ['title' => $title, 'message' => $message]);
    }
}
