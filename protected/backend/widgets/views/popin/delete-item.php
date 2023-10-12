<?php
use yii\bootstrap\ActiveForm;
?>

    <!-- Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer un élément</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Veuillez confirmer la suppression de l'élément sélectionné.</p>
                </div>
                <div class="modal-footer <?= $type == 'media' ? 'pt-2' : '' ?>">
                    <?php 
                    if ($type == 'media') { ?>
                        <small class="mb-3"><strong>Attention :</strong> La suppression du média rechargera la page, veillez à enregistrer vos modifications avant d'effectuer cette opération.</small>
                    <?php } ?>
                    <?php $form = ActiveForm::begin(['id' => 'form-delete-item']); ?>

                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Annuler</button>
                        <button type="submit" name="delete-item" class="btn btn-primary font-weight-bold ml-2" value="">Supprimer</button>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>