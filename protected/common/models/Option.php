<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\helpers\Json;
use common\components\MainHelper;

/**
 * Option model
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $description
 * @property string $options
 * @property string $options_contents
 * @property string $lang
 * @property integer $lang_parent_id
 * @property integer $author
 * @property integer $created_at
 */
class Option extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%option}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'title', 'name', 'description', 'options', 'options_contents', 'author', 'created_at'], 'safe'],
        ];
    }

    // BO
    public static function getOptionList() {

        return static::find()->where([
                'is', 'lang_parent_id', new \yii\db\Expression('null')
            ])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }

    // BO
    public static function getOption($by, $value, $selectInput = null, $withChildren = false, $lang = false) {

        $args = [$by => $value];
        if ($lang)
            $args['lang'] = Yii::$app->language;
        
        $option = static::findOne($args);
        if (null !== $option) {

            $optionList = [];
            $options = JSON::decode($option->options);
            $optionsContents = JSON::decode($option->options_contents);
            if (!empty($options)) {
                foreach ($options[0]['children'] as $opt) {
					
					if (!empty($optionsContents)) {
						$keySearch = array_search($opt['id'], array_column($optionsContents, 'id'));
	                    $optionList[$opt['id']] = [
	                            'name' => $opt['text'],
	                            'key' => $optionsContents[$keySearch]['content'][0]['value'],
	                        ];
	                } else {
	                    $optionList[$opt['id']] = [
	                            'name' => $opt['text'],
	                        ];
	                }

                    if (!empty($opt['children'])) {
	                	foreach ($opt['children'] as $child) {

							$keySearch = array_search($child['id'], array_column($optionsContents, 'id'));
	                    	$optionList[$opt['id']]['children'][$child['id']] = [
	                    		'name' => $child['text'],
                            	'key' => $optionsContents[$keySearch]['content'][0]['value'],
	                    	];
	                    }
	                }
                }
            }

            if (null !== $selectInput) {
                if ($optionList) {
                    $format = [];
                    foreach ($optionList as $opt) {
                    	
                    	if (isset($opt['name']))
                        	$format[$opt['key']] = $opt['name'];

                    	if (isset($opt['children']) && $withChildren) {
		                    foreach ($opt['children'] as $child) {
                        		$format[$child['key']] = $child['name'];
		                    }
		                }
		            }
                    $optionList = $format;
                }
            }

            return $optionList;
        }
        return false;
    }

    // BO
    public static function getOptionLabel($name, $values) {

		$values = is_array($values) ? $values : [$values];
        $option = static::findOne(['name' => $name]);
        if (null !== $option) {

            $optionsContents = JSON::decode($option->options_contents);

            foreach ($values as $key => $value) {
	            $currentOptionsContent[] = array_filter(
	                $optionsContents,
	                function ($option) use (&$value) {
	                    return $option['content'][0]['value'] == $value;
	                }
	            );
            }
            $optionLabels = [];
            foreach ($currentOptionsContent as $currentOptionContent) {
            	if (!empty($currentOptionContent)) {
            		$optionLabels[] = array_values($currentOptionContent)[0]['name'];
            	}
            }
            if (!empty($optionLabels))
                return implode(',<br>', $optionLabels);

        }

        return false;
    }

    //BO
    public static function deleteItem($itemId)
    {
        $delOption = Option::find()
                ->where(['lang_parent_id' => $itemId])
                ->orWhere(['id' => $itemId])
                ->orderBy(['lang_parent_id' => SORT_DESC])
                ->all();

        $notifications = [];
        if (!empty($delOption)) {
            foreach ($delOption as $option) {
                if ($option->delete() && null === $option->lang_parent_id)
                    Update::add('option', $option->id, 'delete');
            }
            Yii::$app->session->setFlash('success', 'Option supprimée avec succès');

            return true;
        } else {
            $notifications[] = [
                    'icon' => 'warning',
                    'title' => 'Élément introuvable.'
                ];
            Yii::$app->session->setFlash('warning', 'Élément introuvable');

            return true;
        }
    }
}
