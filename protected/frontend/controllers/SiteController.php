<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Cms;
use common\models\Event;
use common\models\Participant;
use common\models\News;
use common\models\Company;
use common\models\Forum;
use common\models\Media;
use common\models\Option;
use common\models\User;
use frontend\models\LoginForm;
use frontend\models\RegisterForm;
use frontend\models\AccountForm;
use frontend\models\ContactForm;
use frontend\models\ForumForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\components\MainHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        	];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
    	if (!Yii::$app->request->isAjax) {

	        $this->view->params['cms'] = null !== Yii::$app->request->get('url') || $action->id == 'index' ? Cms::getContent(Yii::$app->request->get('url')) : false;
	        $this->view->params['menus'] = MainHelper::getMenus();
	        $this->view->params['lang'] = MainHelper::getLangSwitcher($action->id);
            $this->view->params['login'] = Cms::getCmsByTemplate('login', null, true);
            $this->view->params['myAccount'] = Cms::getCmsByTemplate('myAccount', null, true);
            $this->view->params['contact'] = Cms::getCmsByTemplate('contact', null, true);

	        // Open Graph
	        $content = $this->view->params['cms'];
			$this->view->params['og']['title'] = $content && $content->meta_title != '' ? $content->meta_title : Yii::t('app', "Bienvenue chez Hôtels Attitude");
			$this->view->params['og']['description'] =  $content && $content->meta_description != '' ? $content->meta_description : Yii::t('app', "Découvrez les hôtels Attitude à l'île Maurice");
			$this->view->params['og']['url'] = $content && $action->id != 'index' ? Url::to(['site/content', 'url' => $content->url]) : Yii::$app->request->BaseUrl;

			$this->view->params['og']['image'] = Yii::$app->request->BaseUrl.'/images/og-image.jpg';
	    }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
                'cms' => Cms::getContent(),
            ]);
    }

    /**
     * Displays cms contents.
     *
     * @return mixed
     */
    public function actionContent()
    {
        $currentContent = Event::getContent(Yii::$app->request->get('url'));
        if (!$currentContent) 
        	$currentContent = News::getContent(Yii::$app->request->get('url'));
        if (!$currentContent) 
        	$currentContent = Cms::getContent(Yii::$app->request->get('url'));
        
        if ($currentContent) {
	        $view = $currentContent->template != '' ? $currentContent->template : 'content';
            $view = $currentContent->type == 'event' ? 'event' : $view;

	        $args = [
	                'cms' => $currentContent,
	                'mailSent' => false,
	            ];

	        switch ($view) {

                case 'event':                    
                    if (!Yii::$app->user->isGuest) {
                        $currentParticipant = Participant::find()
                                                ->where([
                                                    'event_id' => $currentContent->id,
                                                    'user_id' => Yii::$app->user->identity->id
                                                ])
                                                ->one();

                        if (null !== Yii::$app->request->get('register')) {
                            $event = Event::getEvent($currentContent->id);

                            switch (Yii::$app->request->get('register')) {
                                case '0':
                                    $currentParticipant->updated_at = time();
                                    $currentParticipant->registered = 0;

                                    if ($currentParticipant->save()) {

                                        // To member
                                        $subject = Yii::t('app', "Confirmation de votre désinscription à ").$event->title;
                                        $title = Yii::t('app', "Confirmation de votre désinscription");
                                        $message = [
                                                "Bonjour ".Yii::$app->user->identity->firstname.' '.Yii::$app->user->identity->lastname.',',
                                                "Nous vous confirmons que votre désinscription à l'événement <strong>".$event->title."</strong> a bien été prise en compte.<br>Nous espérons vous voir lors de nos prochains événements et restons à votre disposition pour toute autre demande.",
                                                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                                            ];
                                        $res = MainHelper::sendMail($subject, Yii::$app->user->identity->email, ['title' => $title, 'message' => $message]);

                                        // To admin
                                        $subject = Yii::t('app', "Désinscription d'un utilisateur à ").$event->title;
                                        $title = Yii::t('app', "Désinscription d'un utilisateur");
                                        $message = [
                                                "<strong>".Yii::$app->user->identity->firstname." ".Yii::$app->user->identity->lastname."</strong> s'est désinscrit de l'évènement <strong>".$event->title."</strong>.",
                                            ];
                                        $res = MainHelper::sendMail($subject, null, ['title' => $title, 'message' => $message]);

                                        Yii::$app->session->setFlash('success', Yii::t('app', "Demande de désinscription enregistrée avec succès."));
                                    } else {
                                        Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible d'enregistrer la demande de désinscription.<br>Veuillez contacter l'administrateur du site."));
                                    }
                                    break;
                                case '1':
                                    if (null === $currentParticipant) {
                                        $currentParticipant = new Participant();
                                        $currentParticipant->event_id = $currentContent->id;
                                        $currentParticipant->user_id = Yii::$app->user->identity->id;
                                        $currentParticipant->created_at = time();
                                    } else {
                                        $currentParticipant->updated_at = time();
                                    }
                                    $currentParticipant->registered = 1;

                                    if ($currentParticipant->save()) {

                                        $subject = Yii::t('app', "Confirmation de votre inscription à ").$event->title;
                                        $title = Yii::t('app', "Confirmation de votre inscription");
                                        $message = [
                                                "Bonjour ".Yii::$app->user->identity->firstname.' '.Yii::$app->user->identity->lastname.',',
                                                "Nous avons le plaisir de confirmer votre inscription à l'événement <strong>".$event->title."</strong> qui aura lieu le <strong>".MainHelper::getPrettyEventDate($event['event']->start_datetime, $event['event']->end_datetime, false, 'date') ."</strong>. Nous vous remercions de votre intérêt pour ce nouveau rendez-vous et restons à votre disposition pour toute information complémentaire.",
                                                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                                            ];
                                        $res = MainHelper::sendMail($subject, Yii::$app->user->identity->email, ['title' => $title, 'message' => $message]);

                                        Yii::$app->session->setFlash('success', Yii::t('app', "Demande d'inscription enregistrée avec succès."));
                                    } else {
                                        Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible d'enregistrer la demande d'inscription.<br>Veuillez contacter l'administrateur du site."));
                                    }
                                    break;
                                
                                default:
                                    break;
                            }
                            return $this->redirect(Url::to(['site/content', 'url' => $args['cms']->url]));
                        }
                        
                        $args['currentParticipant'] = $currentParticipant;
                    }
                    $args['register'] = Cms::getCmsByTemplate('register', null, true);
                    break;

                case 'contact':
                    $model = new ContactForm();

                    if ($model->load(Yii::$app->request->post())) {
                        if ($model->send()) {
                            Yii::$app->session->setFlash('success', Yii::t('app', "Message envoyé avec succès."));
                            $model = new ContactForm();
                        } else {
                            Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible d'envoyer votre message.<br>Veuillez contacter l'administrateur du site."));
                        }
                    }
                    $args['model'] = $model;
                    break;

                case 'members':
                    if (Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }
                    $args['members'] = User::getActiveMembers();
                    $args['companies'] = Company::getActiveCompanies();
                    break;

                case 'forum':
                    if (Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }

                    $model = new ForumForm();
                    $model->parentId = 0;

                    if ($model->load(Yii::$app->request->post())) {
                        if ($model->save()) {
                            Yii::$app->session->setFlash('success', Yii::t('app', "Discussion publié avec succès."));

                            return $this->redirect(['site/content', 'url' => $args['cms']->url]);
                        } else {
                            Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible de publier votre discussion.<br>Veuillez contacter l'administrateur du site."));
                        }
                    }
                    if (null !== Yii::$app->request->get('del')) {
                        if (null !== $delForum = Forum::findOne(Yii::$app->request->get('del'))) {
                            if (Yii::$app->user->identity->id == $delForum->author) {
                                $children = Forum::getActiveForums($delForum->id);
                                if (!empty($children)) {
                                    Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible de supprimer votre discussion car elle déjà reçu des réponsess."));
                                } else {
                                    if (Forum::deleteItem($delForum->id)) {
                                        Yii::$app->session->setFlash('success', Yii::t('app', "Discussion supprimé avec succès."));
                                    }
                                }
                            } else {
                                Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible de supprimer un discussion dont vous n'êtes pas l'auteur."));
                            }
                            return $this->redirect(['site/content', 'url' => $args['cms']->url]);
                        } else {
                            Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible de supprimer votre discussion. Discussion introuvable.<br>Veuillez contacter l'administrateur du site."));
                        }

                    }
                    $args['model'] = $model;
                    $args['forums'] = Forum::getActiveForums();
                    break;

                case 'myAccount':
                    if (Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }
                    $model = new AccountForm();

                    $args['login'] = Cms::getCmsByTemplate('login', null, true);
                    if (!isset(Yii::$app->user->identity->id) || !$model->find())
                        return $this->redirect(Url::to(['site/content', 'url' => $args['login']->url]));

                    if ($model->load(Yii::$app->request->post())) {
                        if ($account = $model->save()) {
                            Yii::$app->session->setFlash('success', Yii::t('app', "Profil sauvegardé avec succès."));
                        } else {
                            Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible de mettre à jour le profil.<br>Veuillez contacter l'administrateur du site."));
                            $model->password = '';
                        }
                    }
                    $args['model'] = $model;
                    $args['login'] = Cms::getCmsByTemplate('login', null, true);
                    $args['companyList'] = Company::getCompanyList();
                    $args['interestList'] = Option::getOption('name', 'interests', 'select', true);
                    $args['productList'] = Option::getOption('name', 'products', 'select', true);
                    break;

                case 'register':
                    if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }
                    $model = new RegisterForm();
                    if ($model->load(Yii::$app->request->post())) {

                        if (null !== User::findOne(['username' => $model->email])) {
                            Yii::$app->session->setFlash('warning', "L'utilisateur avec l'email ".$model->email." existe déjà.");
                        } elseif ($registered = $model->register()) {
                            Yii::$app->session->setFlash('success', Yii::t('app', "Votre demande d'adhésion à bien été enregistrée.<br>Un membre de la délégation reviendra vers vous très prochainement."));

                            $res = $model->sendEmail();
                            if ($model->company != '')
                                $res = $model->sendEmailToMainContact($registered['company']);
                            
                            return $this->goBack();
                        } else {
                            Yii::$app->session->setFlash('error', Yii::t('app', "Impossible de sauvegarder le nouvel utilisateur. Veuillez contacter l'administrateur du site"));
                        }
                    } else {
                        $model->password = '';
                    }
                    $args['model'] = $model;
                    $args['cgi'] = Cms::getCmsByTag('cgi', true);
                    $args['login'] = Cms::getCmsByTemplate('login', null, true);
                    $args['companyList'] = Company::getCompanyList();
                    $args['interestList'] = Option::getOption('name', 'interests', 'select', true);
                    $args['productList'] = Option::getOption('name', 'products', 'select', true);
                    break;

                case 'login':
                    if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }
                    $model = new LoginForm();
                    if ($model->load(Yii::$app->request->post()) && $model->login()) {
                        return $this->goBack();
                    } else {
                        $model->password = '';
                    }
                    $args['model'] = $model;
                    $args['requestPasswordReset'] = Cms::getCmsByTemplate('requestPasswordResetToken', null, true);
                    $args['register'] = Cms::getCmsByTemplate('register', null, true);
                    break;

                case 'requestPasswordResetToken':
                    if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }
                    $model = new PasswordResetRequestForm();
                    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                        if ($model->sendEmail()) {
                            Yii::$app->session->setFlash('success', Yii::t('app', "Consultez vos emails et suivez les instructions."));

                            return $this->refresh();
                        } else {
                            Yii::$app->session->setFlash('error', Yii::t('app', "Désolé, Impossible de mettre à jour le mot de passe pour cet email."));
                        }
                    }
                    $args['model'] = $model;
                    $args['login'] = Cms::getCmsByTemplate('login', null, true);
                    break;

                case 'resetPassword':
                    if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                    }
                    try {
                        $model = new ResetPasswordForm(Yii::$app->request->get('token'));
                    } catch (InvalidArgumentException $e) {
                        Yii::$app->session->setFlash('error', "Jeton invalide. Veuillez réessayer.");
                        throw new BadRequestHttpException($e->getMessage());
                    }

                    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {

                        $res = $model->sendEmail();

                        Yii::$app->session->setFlash('success', 'Nouveau mot de passe sauvegardé.');

                        $login = Cms::getCmsByTemplate('login', null, true);
                        return $this->redirect(['site/content', 'url' => $login->url]);
                    }
                    $args['model'] = $model;
                    $args['login'] = Cms::getCmsByTemplate('login', null, true);
                    break;
	            
	            default:
	                break;
	        }

	        return $this->render($view, $args);
	    } else {

            if (Yii::$app->request->get('url') == 'logout') {
                Yii::$app->user->logout();
                return $this->goBack();
            } elseif (Yii::$app->request->isAjax) {
                if (Yii::$app->request->get('url') == 'memberDetails') {
                    $memberId = Yii::$app->request->post('memberId');
                    if (null !== $memberId) {

                        return Json::encode($this->renderPartial(
                                'ajax/memberDetails', [
                                    'member' => User::getMember($memberId),
                                ]
                            ));
                    }
                }
            } else {
                $redirect = Cms::getContentRedirect(Yii::$app->request->get('url'));
                if ($redirect)
                    return $this->redirect(['site/content', 'url' => $redirect->url]);

                return $this->render('error');
            }
	    }
    }

    /**
     * Error.
     *
     * @return mixed
     */
    public function actionError()
    {
	   	return $this->render('error');
    }
}
