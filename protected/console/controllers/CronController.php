<?php
namespace console\controllers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\console\Controller;
use common\components\MainHelper;


require_once(realpath(dirname(__FILE__)).'/../../../../clubsoracle/wp-config.php');

/**
 * Test controller
 */
class CronController extends Controller {

    public function actionIndex() {

    }

    /**
     * Import Companies
     * 
     * cmd: php yii cron/import-company
     * **/
    public function actionImportCompany() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'company',
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$companyList = $query->posts;
    	
    	var_dump(count($companyList));
    }

    /**
     * Import Users
     * 
     * cmd: php yii cron/import-user
     * **/
    public function actionImportUser() {

    	global $wpdb;
    	$args = [
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_User_Query($args);
    	$userList = $query->get_results();
    	
    	var_dump(count($userList));
    }

    /**
     * Import Event
     * 
     * cmd: php yii cron/import-event
     * **/
    public function actionImportEvent() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'event',
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$eventList = $query->posts;
    	
    	var_dump(count($eventList));
    }

    /**
     * Import JU
     * 
     * cmd: php yii cron/import-ju
     * **/
    public function actionImportJu() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'ju',
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$juList = $query->posts;
    	
    	var_dump(count($juList));
    }

    /**
     * Import News
     * 
     * cmd: php yii cron/import-news
     * **/
    public function actionImportNews() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'post',
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$newsList = $query->posts;
    	
    	var_dump(count($newsList));
    }

    /**
     * Import Medias
     * 
     * cmd: php yii cron/import-media
     * **/
    public function actionImportMedia() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'attachment',
    			'post_parent' => null, // any parent
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$attachmentList = $query->posts;
    	
    	var_dump(count($attachmentList));
    }

    /**
     * Import Forum
     * 
     * cmd: php yii cron/import-forum
     * **/
    public function actionImportForum() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'faq',
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$forumList = $query->posts;
    	
    	var_dump(count($forumList));
    }

    /**
     * Import Job
     * 
     * cmd: php yii cron/import-job
     * **/
    public function actionImportJob() {

    	global $wpdb;
    	$args = [
    			'post_type' => 'job',
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Query($args);
    	$jobList = $query->posts;
    	
    	var_dump(count($jobList));
    }

    /**
     * Import Comments
     * 
     * cmd: php yii cron/import-comment
     * **/
    public function actionImportComment() {

    	global $wpdb;
    	$args = [
  				'post_status' => 'any',
    			'posts_per_page' => -1
    		];

    	$query = new \WP_Comment_Query($args);
    	$commentList = $query->comments;
    	
    	var_dump(count($commentList));
    }
}