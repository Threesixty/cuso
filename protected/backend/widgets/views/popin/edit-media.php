<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\models\Option;
use common\components\MainHelper;

	$tags = Option::getOption('name', 'gallery-tags'); ?>

	<!--begin::modalEditMedia-->
	<div class="modal fade" id="modalEditMedia" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modalEditMedia">
    	<div class="modal-dialog modal-dialog-centered" role="document">
        	<div class="modal-content blockui_card">

    			<?php $form = ActiveForm::begin(['id' => 'form-edit-media']); ?>

					<input type="hidden" name="media_id">
					<input type="hidden" name="media_lang">
					<input type="hidden" name="media_path">
					<div class="modal-header">
						<h5 class="modal-title">Informations media</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<i aria-hidden="true" class="ki ki-close"></i>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="overflow-image rounded text-center p-0">
										<img class="d-none" src="">
										<video class="rounded d-none" controls></video> 
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Url du media :</label><br>
									<a href="" class="media-url" target="_blank"><code></code></a>
								</div>
								<div class="form-group">
									<label>Titre du media :</label>
									<input type="text" class="form-control" placeholder="Titre du media" name="media_title" />
								</div>

								<ul class="nav nav-tabs nav-tabs-line media-lang" data-url="<?= Url::to(['site/get-media']) ?>">
								    <li class="nav-item">
								        <a href="javascript:void(0)" class="nav-link active" data-toggle="tab" data-lang="fr">Français</a>
								    </li>
								    <li class="nav-item">
								        <a href="javascript:void(0)" class="nav-link" data-toggle="tab" data-lang="en">Anglais</a>
								    </li>
								    <li class="nav-item">
								        <a href="javascript:void(0)" class="nav-link" data-toggle="tab" data-lang="de">Allemand</a>
								    </li>
								</ul>
								<div class="tab-content p-5 bg-light blockui-media">
									<div class="form-group">
										<label>Balise <code>alt</code> :</label>
										<input type="text" class="form-control" placeholder="Balise alt" name="media_alt" />
									</div>
									<div class="form-group">
										<label>Légende :</label>
										<textarea class="form-control textarea-autosize" placeholder="Légende du média" name="media_legend" rows="3"></textarea>
									</div>
									<hr>
						            <div class="form-group">
						                <label class="d-block">Étiquettes galerie :</label>
										<div class="col-9 col-form-label">
											<div class="checkbox-list">
							                	<?php
		                    					if (!empty($tags)) {
								                    foreach ($tags as $tag) { ?>
														<label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success mb-1">
															<input type="checkbox" name="media_tags[]" value="<?= $tag['key'] ?>" data-value="<?= $tag['key'] ?>" />
															<span></span><?= $tag['name'] ?>
														</label>
									                	<?php
				                    					if (!empty($tag['children'])) {
										                    foreach ($tag['children'] as $child) { ?>
																<label class="checkbox checkbox-outline checkbox-outline-2x checkbox-success ml-8 mb-1">
																	<input type="checkbox" name="media_tags[]" value="<?= $child['key'] ?>" data-value="<?= $child['key'] ?>" />
																	<span></span><?= $child['name'] ?>
																</label>
										                    <?php }
										                }
										            }
								                } ?>
											</div>
										</div>
						            </div>
									<div class="form-group">
										<label>Lien galerie :</label>
										<input type="text" class="form-control" placeholder="Lien du media" name="media_link" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-success font-weight-bold" data-dismiss="modal">Annuler</button>
						<button type="button" class="btn btn-success font-weight-bold save-media-infos" data-update-url="<?= Url::to(['site/update-media']) ?>">Enregistrer</button>
					</div>

    			<?php ActiveForm::end(); ?>
			</div>
    	</div>
	</div>
	<!--end::modalEditMedia-->