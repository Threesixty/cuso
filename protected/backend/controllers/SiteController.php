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
    	$args = [];

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

            if ($user = $model->save()) {
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
            Cms::deleteItem($delId);
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
            //Event::deleteItem($delId);
            Cms::deleteItem($delId);
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
