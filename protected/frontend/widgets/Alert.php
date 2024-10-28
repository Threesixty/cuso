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

            foreach ((array) $flash as $i => $message) {
                $title = '';
                switch ($type) {
                     case 'success':
                         $title = "Succès";
                         break;
                     case 'warning':
                         $title = "Attention";
                         break;
                     case 'error':
                         $title = "Erreur";
                         break;
                     
                     default:
                         break;
                } ?>

                <!-- Modal -->
                <div class="modal modal-notification fade" id="notificationModal<?= $i ?>" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="notificationModalLabel"><?= $title ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Yii::t('app', "Fermer") ?>"></button>
                            </div>
                            <div class="modal-body"><?= $message ?></div>
                            <div class="modal-footer">
                                <button type="button" class="theme-btn btn-one" data-bs-dismiss="modal"><?= Yii::t('app', "Fermer") ?></button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }

            $session->removeFlash($type);
        }
    }
}
