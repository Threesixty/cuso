<?php
use yii\helpers\Url;
use common\components\MainHelper;

#MainHelper::pp($updateList); ?>

						<div class="card card-custom card-shadowless bg-white gutter-b blockui-updates">
							<div class="card-header align-items-center border-0 mt-4">
								<h3 class="card-title align-items-start flex-column">
									<span class="font-weight-bolder text-dark">Historique des modifications</span>
								</h3>
							</div>
							<div class="card-body pt-4">
								<div class="timeline timeline-6 mt-3">

									<?php
									foreach ($updateList as $update) {
										$type = "le contenu";
										switch ($update->model) {
										 	case 'option':
										 		$type = "l'option";
										 		break;
										 	case 'media':
										 		$type = "le fichier";
										 		break;
										 	case 'user':
										 		$type = "l'utilisateur";
										 		break;
										 	case 'hotel':
										 		$type = "l'hôtel";
										 		break;
										 	case 'feature':
										 		$type = "la caractéristique";
										 		break;
										 	case 'featureKids':
										 		$type = "la caractéristique enfant";
										 		break;
										 	case 'roomCategory':
										 		$type = "la catégorie de chambre";
										 		break;
										 	
										 	default:
										 		break;
										} ?>

										<div class="timeline-item align-items-start">
											<div class="timeline-label font-weight-bolder text-dark-75 font-size-lg"><?= strftime('%e %b %Y', $update->date) ?> <span><?= strftime('%k:%M', $update->date) ?></span></div>
											<div class="timeline-badge">
												<i class="fa fa-genderless text-<?= $update->action == 'new' ? 'danger' : 'success' ?> icon-xl"></i>
											</div>
											<div class="timeline-content d-flex">
												<span class="text-dark-75 pl-3 font-size-md"><strong class="font-weight-bolder"><?= null !== $update->author ? $update->author->firstname.' '.$update->author->lastname : 'Utilisateur supprimé' ?></strong> a <?= $update->action == 'new' ? 'créé' : 'modifié' ?> <?= $type ?></span>
											</div>
										</div>
										
									<?php } ?>
								</div>
								<?php
								if (count($updateList) == 5) { ?>
									<button type="button" class="btn btn-primary mt-5 w-100 load-updates" data-model="<?= $model ?>" data-id="<?= $modelId ?>" data-offset="5" data-url="<?= Url::to(['site/load-updates']) ?>">Afficher plus</button>
								<?php } ?>
							</div>
						</div>