<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use common\components\MainHelper;

class MemberWidget extends Widget
{

    public function init()
    {
        parent::init();

    }

    public function run()
    { ?>

        <!-- Modal Members -->
        <div class="modal modal-member fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="memberModalLabel">Détail du membre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= Yii::t('app', "Fermer") ?>"></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="theme-btn btn-one" data-bs-dismiss="modal"><?= Yii::t('app', "Fermer") ?></button>
                    </div>
                </div>
            </div>
        </div>

    <?php }
}
