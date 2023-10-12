<?php
namespace frontend\widgets;

use Yii;

/**
 * Alert widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap\Widget
{

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        
        foreach ($flashes as $type => $flash) {

            foreach ((array) $flash as $i => $message) { ?>

				<div class="cookie alert-widget mfp-hide">
					<div class="cookie-summary">
						<p><?= $message ?></p>
					</div>
					<div class="cookie-button">
						<a href="#" class="close-alert">Ok</a>
					</div>
				</div>

            <?php }

            $session->removeFlash($type);
        }
    }
}
