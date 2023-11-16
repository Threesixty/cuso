<?php
namespace backend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Update;
use common\models\User;
use common\models\Cms;
use common\models\Option;
use common\models\Media;
use common\models\Hotel;
use common\models\Feature;
use common\models\FeatureKids;
use common\models\RoomCategory;
use common\components\MainHelper;

class UpdateWidget extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    {
    	$model = str_replace('edit-', '', Yii::$app->controller->action->id);
    	$subModel = explode('-', $model);
    	if (count($subModel) == 2)
    		$model = $subModel[0].ucfirst($subModel[1]);

    	$modelId = Yii::$app->request->get('id');
    	if (null !== Yii::$app->request->get('lang')) {

    		$contentLang = null;
			switch ($model) {
			 	case 'cms':
		    		$contentLang = Cms::findOne([
		    						'lang' => Yii::$app->request->get('lang'),
		    						'lang_parent_id' => $modelId,
		    					]);
			 		break;
			 	case 'event':
		    		$contentLang = Cms::findOne([
		    						'lang' => Yii::$app->request->get('lang'),
		    						'lang_parent_id' => $modelId,
		    					]);
			 		break;
			 	case 'option':
		    		$contentLang = Option::findOne([
		    						'lang' => Yii::$app->request->get('lang'),
		    						'lang_parent_id' => $modelId,
		    					]);
			 		break;
			 	case 'media':
		    		$contentLang = Media::findOne([
		    						'lang' => Yii::$app->request->get('lang'),
		    						'lang_parent_id' => $modelId,
		    					]);
			 		break;
			 	
			 	default:
			 		break;
			}

    		$modelId = null !== $contentLang ? $contentLang->id : 0;
    	}

    	$updateList = Update::find()
    					->where([
    							'model' => $model,
    							'model_id' => $modelId,
    						])
    					->limit(5)
    					->orderBy(['date' => SORT_DESC])
    					->all();

		foreach ($updateList as $key => $update) {
			$user = User::findOne($update->author);
			$updateList[$key]->author = null !== $user ? $user : null;
		}

        return $this->render('last-update', [
        		'updateList' => $updateList,
        		'model' => $model,
        		'modelId' => $modelId,
            ]);

    }
}
