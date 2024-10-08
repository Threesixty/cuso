<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\User;
use common\models\Company;
use common\models\Cms;
use common\models\News;
use common\models\Event;
use common\models\Participant;
use common\models\Forum;
use common\models\Media;
use common\models\Option;
use common\models\Update;
use backend\models\LoginForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\UserForm;
use backend\models\CompanyForm;
use backend\models\CmsForm;
use backend\models\NewsForm;
use backend\models\EventForm;
use backend\models\ForumForm;
use backend\models\OptionForm;
use common\components\MainHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public function beforeAction($action)
    {
        if (in_array($action->id, ['new-media'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'error', 'logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	$args = [
            'activeUsers' => count(User::find()->where(['status' => 10])->all()),
            'pendingUsers' => User::find()->where(['status' => 9])->all(),
            'activeCompanies' => count(Company::find()->where(['status' => 3])->all()),
            'pendingCompanies' => count(Company::find()->where(['status' => 1])->all()),
            'publishedEvents' => count(Cms::find()->where(['type' => 'event', 'status' => 1])->all()),
            'draftEvents' => count(Cms::find()->where(['type' => 'event', 'status' => 0])->all()),
            'publishedCms' => count(Cms::find()->where(['type' => 'cms', 'status' => 1])->all()),
            'draftCms' => count(Cms::find()->where(['type' => 'cms', 'status' => 0])->all()),
            'publishedNews' => count(Cms::find()->where(['type' => 'news', 'status' => 1])->all()),
            'draftNews' => count(Cms::find()->where(['type' => 'news', 'status' => 0])->all()),
        ];

        if (Yii::$app->request->get('target') == 'user' && null !== Yii::$app->request->get('id') && null !== Yii::$app->request->get('status')) {
            if (User::updateStatus(Yii::$app->request->get('id'), Yii::$app->request->get('status'))) {
                return $this->redirect(Url::to(['site/index']));
            }
        }

        return $this->render('index', $args);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Consultez vos emails et suivez les instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Désolé, Impossible de mettre à jour le mot de passe pour ce mail.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Nouveau mot de passe sauvegardé.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * User list.
     *
     * @return mixed
     */
    public function actionUser()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            User::deleteItem($delId);
        }

        if (null !== Yii::$app->request->get('id') && null !== Yii::$app->request->get('status')) {
            if (User::updateStatus(Yii::$app->request->get('id'), Yii::$app->request->get('status')))
                return $this->redirect(Url::to(['site/user']));
        }

        return $this->render('user', [
            'userList' => User::find()->where(['!=', 'role', 0])->all(),
        ]);
    }

    /**
     * Edit user
     *
     * @return mixed
     */
    public function actionEditUser()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new UserForm();
        $model->photoId = '[]';

        if (!empty(Yii::$app->request->get('id')) && (!$model->find() || Yii::$app->user->identity->role < $model->role))
            return $this->redirect(Url::to(['site/edit-user']));


        if ($model->load(Yii::$app->request->post())) {

            if (empty(Yii::$app->request->get('id')) && null !== User::findOne(['username' => $model->email])) {
                Yii::$app->session->setFlash('warning', "L'utilisateur avec l'email ".$model->email." existe déjà.");
            } elseif ($user = $model->save()) {
                Yii::$app->session->setFlash('success', 'Utilisateur sauvegardé avec succès');

                $dest = MainHelper::getDestination('user', $user['user'], Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder l‘utilisateur.<br>Veuillez contacter l‘administrateur');
            }
        }

        return $this->render('edit/user', [
            'model' => $model,
        ]);
    }

    /**
     * Company list.
     *
     * @return mixed
     */
    public function actionCompany()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Company::deleteItem($delId);
        }

        if (null !== Yii::$app->request->get('id') && null !== Yii::$app->request->get('status')) {
            if (Company::updateStatus(Yii::$app->request->get('id'), Yii::$app->request->get('status')))
                return $this->redirect(Url::to(['site/company']));
        }

        return $this->render('company', [
            'companyList' => Company::getCompanyList(),
        ]);
    }

    /**
     * Edit company
     *
     * @return mixed
     */
    public function actionEditCompany()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $companyForm = new CompanyForm();
        $companyForm->photoId = '[]';

        if (!empty(Yii::$app->request->get('id')) && !$companyForm->find())
            return $this->redirect(Url::to(['site/edit-company']));

        if ($companyForm->load(Yii::$app->request->post())) {

            if ($company = $companyForm->save()) {
                Yii::$app->session->setFlash('success', 'Société sauvegardée avec succès');

                $dest = MainHelper::getDestination('company', $company, Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder la société.<br>Veuillez contacter l‘administrateur');
            }
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Media::deleteItem($delId);
        }

        return $this->render('edit/company', [
            'model' => $companyForm,
            'userCompanyList' => User::find()
                ->where(['!=', 'role', 0])
                ->andWhere(['company_id' => Yii::$app->request->get('id')])
                ->all(),
        ]);
    }

    /**
     * Cms list
     *
     * @return mixed
     */
    public function actionCms()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Cms::deleteItem($delId);
        }

        return $this->render('cms', [
            'cmsList' => Cms::getCmsList(),
        ]);
    }

    /**
     * Edit cms
     *
     * @return mixed
     */
    public function actionEditCms()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $cmsForm = new CmsForm();
        $cmsForm->photoId = '[]';

        if (!empty(Yii::$app->request->get('id')) && !$cmsForm->find())
            return $this->redirect(Url::to(['site/edit-cms']));

        if ($cmsForm->load(Yii::$app->request->post())) {

            if ($cms = $cmsForm->save('cms')) {
                Yii::$app->session->setFlash('success', 'Contenu sauvegardé avec succès');

                $dest = MainHelper::getDestination('cms', $cms, Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder le contenu.<br>Veuillez contacter l‘administrateur');
            }
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Media::deleteItem($delId);
        }

        return $this->render('edit/cms', [
            'model' => $cmsForm,
        ]);
    }

    /**
     * News list
     *
     * @return mixed
     */
    public function actionNews()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            News::deleteItem($delId);
        }

        return $this->render('news', [
            'newsList' => News::getNewsList(),
        ]);
    }

    /**
     * Edit news
     *
     * @return mixed
     */
    public function actionEditNews()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new NewsForm();
        $model->photoId = '[]';

        if (!empty(Yii::$app->request->get('id')) && !$model->find())
            return $this->redirect(Url::to(['site/edit-news']));

        if ($model->load(Yii::$app->request->post())) {

            if ($news = $model->save()) {
                Yii::$app->session->setFlash('success', 'Actualité sauvegardé avec succès');

                $dest = MainHelper::getDestination('news', $news['cms'], Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder l\'actualité.<br>Veuillez contacter l‘administrateur');
            }
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Media::deleteItem($delId);
        }

        return $this->render('edit/news', [
            'model' => $model,
        ]);
    }

    /**
     * Event list
     *
     * @return mixed
     */
    public function actionEvent()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Event::deleteItem($delId);
        }

        return $this->render('event', [
            'eventList' => Event::getEventList(),
        ]);
    }

    /**
     * Edit event
     *
     * @return mixed
     */
    public function actionEditEvent()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new EventForm();
        $model->photoId = '[]';
        $model->documents = '[]';

        if (!empty(Yii::$app->request->get('id')) && !$model->find())
            return $this->redirect(Url::to(['site/edit-event']));

        if ($model->load(Yii::$app->request->post())) {

            if ($event = $model->save()) {
                Yii::$app->session->setFlash('success', 'Evénement sauvegardé avec succès');

                $dest = MainHelper::getDestination('event', $event['cms'], Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder l\'événement.<br>Veuillez contacter l‘administrateur');
            }
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Media::deleteItem($delId);
        }

        return $this->render('edit/event', [
            'model' => $model,
        ]);
    }

    /**
     * Add participants.
     *
     * @return mixed
     */
    public function actionParticipants()
    {
        $eventId = Yii::$app->request->post('eventId');
        $participants = Json::decode(Yii::$app->request->post('participants'));

        if (null !== $participants) {

            $eventParticipantList = [];
            foreach ($participants as $participant) {

                $args = [
                        'eventId' => $eventId,
                        'userId' => $participant['id'],
                        'registered' => 1,
                    ];

                if ($newParticipant = Participant::add($args)) {
                    $eventParticipantList[] = $newParticipant;
                } else {
                    MainHelper::pp($newParticipant);
                }
            }

            return Json::encode($this->renderPartial(
                    'ajax/addParticipants', [
                        'eventParticipantList' => $eventParticipantList,
                    ]
                ));
        }

    }

    /**
     * Update participant.
     *
     * @return mixed
     */
    public function actionParticipantAction()
    {
        $action = Yii::$app->request->post('action');
        $participantId = Yii::$app->request->post('participantId');

        if (null !== $participantId) {

            $currentParticipant = Participant::findOne($participantId);
            if (null !== $currentParticipant) {
                $user = User::findOne($currentParticipant->user_id);
                $event = Event::getEvent($currentParticipant->event_id);

                switch ($action) {
                    case 'register':
                        $currentParticipant->registered = 1;
                        $currentParticipant->updated_at = time();

                        $subject = Yii::t('app', "Confirmation de votre inscription à ").$event->title;
                        $title = Yii::t('app', "Confirmation de votre inscription");
                        $message = [
                                "Bonjour ".$user->firstname.' '.$user->lastname.',',
                                "Nous avons le plaisir de confirmer votre inscription à l'événement <strong>".$event->title."</strong> qui aura lieu le <strong>".MainHelper::getPrettyEventDate($event['event']->start_datetime, $event['event']->end_datetime, false, 'date') ."</strong>. Nous vous remercions de votre intérêt pour ce nouveau rendez-vous et restons à votre disposition pour toute information complémentaire.",
                                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                            ];
                        break;
                    case 'refuse':
                        $currentParticipant->registered = 2;
                        $currentParticipant->updated_at = time();

                        $subject = Yii::t('app', "Refus de votre inscription à ").$event->title;
                        $title = Yii::t('app', "Refus de votre inscription");
                        $message = [
                                "Bonjour ".$user->firstname.' '.$user->lastname.',',
                                "Malheureusement, nous ne sommes pas en mesure de confirmer votre inscription à l'événement  <strong>".$event->title."</strong> car celui-ci est réservé aux utilisateurs de solutions Genesys & Interactions CX pour leur propre compte. Pour plus d'informations à ce sujet, n'hésitez pas à nous contacter à l'adresse <a href=\"mailto:evenements@clubgenesys.org\">evenements@clubgenesys.org</a>.<br>Nous vous prions de bien vouloir nous excuser pour ce désagrément et vous invitons à participer à nos prochains événements.",
                                "Cordialement,<br>La délégation du Club Utilisateurs de solutions Genesys & Interactions CX",
                            ];
                        break;
                    case 'came':
                        $currentParticipant->came = true;
                        break;
                    case 'notcame':
                        $currentParticipant->came = false;
                        break;
                    
                    default:
                        break;
                }

                if ($currentParticipant->save()) {

                    $res = MainHelper::sendMail($subject, $user->email, ['title' => $title, 'message' => $message]);

                    return Json::encode($currentParticipant);

                } else {
                    return false;
                }
            }
            return false;
        }

    }

    /**
     * Forum list.
     *
     * @return mixed
     */
    public function actionForum()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Forum::deleteItem($delId);
        }

        return $this->render('forum', [
            'forumList' => Forum::getForumList(),
        ]);
    }

    /**
     * Edit forum
     *
     * @return mixed
     */
    public function actionEditForum()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $forumForm = new ForumForm();

        if (!empty(Yii::$app->request->get('id')) && !$forumForm->find())
            return $this->redirect(Url::to(['site/edit-forum']));

        if ($forumForm->load(Yii::$app->request->post())) {

            if ($forum = $forumForm->save()) {
                Yii::$app->session->setFlash('success', 'Discussion sauvegardée avec succès');

                $dest = MainHelper::getDestination('forum', $forum['forum'], Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder la discussion.<br>Veuillez contacter l‘administrateur');
            }
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Media::deleteItem($delId);
        }

        return $this->render('edit/forum', [
            'model' => $forumForm,
        ]);
    }

    /**
     * Media list
     *
     * @return mixed
     */
    public function actionMedia()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Media::deleteItem($delId);
        }

        return $this->render('media', [
            'mediaList' => Media::find()
		            			->where(['is', 'lang_parent_id', new \yii\db\Expression('null')])
            					->orderBy(['created_at' => SORT_DESC])
            					->limit(50)
            					->all(),
        ]);
    }

    /**
     * Media list / AJAX
     *
     * @return mixed
     */
    public function actionMediaList()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $offset = Yii::$app->request->post('offset');
        if ($offset) {

        	$draggable = intval(Yii::$app->request->post('draggable'));
        	$limit = $draggable ? 20 : 50;
	        return JSON::encode($this->renderPartial('ajax/mediaList', [
	        		'draggable' => $draggable,
		            'mediaList' => Media::find()
		            				->orderBy(['created_at' => SORT_DESC])
		            				->where(['is', 'lang_parent_id', new \yii\db\Expression('null')])
		            				->offset($offset)
		            				->limit($limit)
		            				->all(),
		        ]));
        }

        return false;
    }

    /**
     * Add media / AJAX
     *
     * @return mixed
     */
    public function actionNewMedia()
    {
        if (Yii::$app->user->isGuest) {
        	return false;
        }

        $fileName = 'file';
        if (is_array($_FILES['file'])) {
            $file = UploadedFile::getInstanceByName($fileName);

            $tmpFilename = $file->baseName;
            $cleanFilename = MainHelper::cleanUrl($file->baseName);
            $file->name = time().'_'.$cleanFilename.'.'.$file->extension;

            if ($file->saveAs(Yii::getAlias('@uploadFolder').'/'.$file->name)) {

                $media = new Media();
                $media->title = $tmpFilename;
                $media->path = $file->name;
                $media->author = Yii::$app->user->identity->id;
                $media->created_at = time();
                if ($media->save())
                    Update::add('media', $media->id, 'new');

                return JSON::encode($media);
            } else {
            	MainHelper::pp($file->error);
                return false;
            }
        }

        return false;
    }

    /**
     * get media / AJAX
     *
     * @return mixed
     */
    public function actionGetMedia()
    {
        if (Yii::$app->user->isGuest) {
        	return false;
        }

        $mediaId = Yii::$app->request->post('id');
        if ($mediaId) {

        	$media = null;
        	if (null !== Yii::$app->request->post('lang')) {
            	$media = Media::findOne([
            				'lang' => Yii::$app->request->post('lang'),
            				'lang_parent_id' => $mediaId,
            			]);
        	} 

        	if (null === $media) {
            	$media = Media::findOne($mediaId);
        	}
            if (null !== $media) {
                return JSON::encode($media);
            }
        }

        return false;
    }

    /**
     * update media / AJAX
     *
     * @return mixed
     */
    public function actionUpdateMedia()
    {
        if (Yii::$app->user->isGuest) {
        	return false;
        }

    	$p = (object) Yii::$app->request->post();
        if (property_exists($p, 'media_id')) {

        	if ($p->media_lang != 'fr') {
	            $media = Media::findOne([
	            			'lang' => $p->media_lang,
	            			'lang_parent_id' => $p->media_id,
	            		]);
	            if (null === $media) {
	            	$media = new Media();
	            	$media->path = $p->media_path;
	            	$media->lang_parent_id = $p->media_id;
	                $media->author = Yii::$app->user->identity->id;
	                $media->created_at = time();
	            }
        	} else
	            $media = Media::findOne($p->media_id);

            if (null !== $media) {
            	$media->title = $p->media_title;
            	$media->alt = $p->media_alt;
            	$media->legend = $p->media_legend;
            	$media->tags = isset($p->media_tags) ? Json::encode($p->media_tags) : null;
            	$media->link = $p->media_link;
            	$media->lang = $p->media_lang;
            	if ($media->save())
                	return JSON::encode($media);
            }
        }

        return false;
    }

    /**
     * search media / AJAX
     *
     * @return mixed
     */
    public function actionSearchMedias()
    {
        if (Yii::$app->user->isGuest) {
        	return false;
        }

        $searchTerm = Yii::$app->request->post('term');
        $draggable = intval(Yii::$app->request->post('draggable'));

    	if ($searchTerm && strlen($searchTerm) > 1) {
    		$mediaList = Media::find()
				->where(['LIKE', 'title', $searchTerm])
				->orderBy(['created_at' => SORT_DESC])
				->all();
		} else {
    		$limit = $draggable ? 20 : 50;
    		$mediaList = Media::find()
				->orderBy(['created_at' => SORT_DESC])
				->limit($limit)
				->all();
		}

        return JSON::encode($this->renderPartial('ajax/mediaList', [
    		'draggable' => $draggable,
            'mediaList' => $mediaList,
        ]));
    }

    /**
     * Option list
     *
     * @return mixed
     */
    public function actionOption()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (null !== $delId = Yii::$app->request->post('delete-item')) {
            Option::deleteItem($delId);
        }

        return $this->render('option', [
            'optionList' => Option::getOptionList(),
        ]);
    }

    /**
     * Edit option
     *
     * @return mixed
     */
    public function actionEditOption()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new OptionForm();
        if (!empty(Yii::$app->request->get('id')) && !$model->find())
            return $this->redirect(Url::to(['site/edit-option']));

        if ($model->load(Yii::$app->request->post())) {

            if ($option = $model->save()) {
                Yii::$app->session->setFlash('success', 'Option sauvegardée avec succès');

                $dest = MainHelper::getDestination('option', $option, Yii::$app->request->post('main-submit'));
                return $this->redirect(Url::to($dest));

            } else {
                Yii::$app->session->setFlash('warning', 'Impossible de sauvegarder l‘option.<br>Veuillez contacter l‘administrateur');
            }
        }

        return $this->render('edit/option', [
            'model' => $model,
        ]);
    }

    /**
     * Save menus / AJAX
     *
     * @return mixed
     */
    public function actionSaveMenus()
    {
        $menus = Yii::$app->request->post('menus');
        if ($menus) {

            $option = Option::findOne(['name' => '_menus_']);
            if (null === $option) {
                $option = new Option();
                $option->name = '_menus_';
                $option->author = Yii::$app->user->identity->id;
                $option->created_at = time();
            }
            $option->title = 'Configuration des menus front-office';
            $option->description = 'SPECIAL';
            $option->options = str_replace("'", "‘", $menus);

            if ($option->save()) {
                Update::add('menus', $option->id, 'update');
                return JSON::encode($option);
            }

        }

        return false;
    }

    /**
     * Load more updates / AJAX
     *
     * @return mixed
     */
    public function actionLoadUpdates()
    {
        $model = Yii::$app->request->post('model');
        $modelId = Yii::$app->request->post('modelId');
        $offset = Yii::$app->request->post('offset');
        if ($model) {

	    	$updateList = Update::find()
	    					->where([
	    							'model' => $model,
	    							'model_id' => $modelId,
	    						])
	    					->limit(5)
	    					->offset($offset)
	    					->orderBy(['date' => SORT_DESC])
	    					->all();

			foreach ($updateList as $key => $update) {
				$user = User::findOne($update->author);
				$updateList[$key]->author = null !== $user ? $user : null;
			}

	        return JSON::encode($this->renderPartial('ajax/loadUpdates', [
		            'updateList' => $updateList,
		        ]));

        }

        return false;
    }
}
