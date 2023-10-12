<?php

use yii\helpers\Url;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use common\models\Media;
use common\models\Option;
use frontend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($cms->title, '', true);
?>

			<div class="get-a-quote-text lightgray-bg">
				<div class="flex center-aligned-hor">
					<div class="experience-in-mauritius flex-1 margin-auto-vert">
						<div class="prompt-para margin-auto-hor relative">
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/get-a-quote.png" alt="" class="absolute">
							<h3 class="selected-room-title mb-10 pb-5 bold-text"><?= $cms->title ?></h3>
							<?= $cms->summary ?>
						</div>
					</div>
					<div class="flex-1">
			            <?php
			            if (null !== $cms->photo_id) {
			                foreach (JSON::decode($cms->photo_id) as $photoId) {
			                    $photo = Media::findOne($photoId);
			                    if (null !== $photo) { ?>
			                        <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" class="get-a-quote-img block" alt="<?= $photo->alt ?>">
			                    <?php }
			                }
			            } ?>
					</div>
				</div>
			</div>
			
			<div class="container pb-100">

		        <!--begin::Form-->
		        <?php $form = ActiveForm::begin(['id' => 'form-global-quote', 'options' => ['data-parsley-validate' => true]]); ?>
					<input type="hidden" name="newsletter-isMauritian" value="">
					<input type="hidden" name="newsletter-type" value="">

					<div class="our-hotels-list get-a-quote-form flex pt-100 fs-14 lh-20 darkgray-text">
						<div class="flex-1">
							<div class="gallery-items-title mb-20 pb-5 bold-text"><?= Yii::t('app', "Détails du séjour") ?></div>

							<div class="mb-20 pb-10 relative">
								<span class="block mb-5"><?= Yii::t('app', "Hôtel") ?> (<?= Yii::t('app', "facultatif") ?>)</span>
								<div class="ah-filter-hotels ah-filter-hotels-global-quote flex flex-2 relative">
									<input type="checkbox" class="ah-filter-item-checkbox" id="ah-filter-item-checkbox-global-quote">
									<label class="border-1-light full-width" for="ah-filter-item-checkbox-global-quote">
										<div class="ah-filter-item full-width border-rad-4 flex flex-col center-aligned-hor relative">
											<span class="ah-filter-selection fs-15 lh-20 darkgray-text hotel-selection"><?= Yii::t('app', "Tous les hôtels") ?></span>
										</div>
									</label>
									<div class="ah-filter-menu hidden absolute border-1-default white-bg fs-15" data-max-msg="<?= Yii::t('app', "3 hôtels max.") ?>">
										<div class="ah-filter-menu-header">
											<label class="flex center-aligned-vert">
												<input type="checkbox" class="first" name="quote-hotel[]" value="<?= Yii::t('app', "Tous les hôtels") ?>" checked>
												<span class="ah-filter-menu-checkbox flex"></span>
												<span class="ah-filter-menu-label"><?= Yii::t('app', "Tous les hôtels") ?></span>
											</label>
										</div>
										<div class="ah-filter-menu-body flex">
											<?php
											foreach ($hotelsByCat as $cat => $hotels) { ?>

												<ul class="flex-1">
													<li class="mb-20">
														<label class="flex center-aligned-vert">
															<input type="checkbox" name="quote-hotel[]" value="<?= $optionNames[$cat] ?>">
															<span class="ah-filter-menu-checkbox flex"></span>
															<span class="ah-filter-menu-label bold-text"><?= $optionNames[$cat] ?></span>
														</label>
													</li>

													<?php
													foreach ($hotels as $hotel) { ?>

														<li class="mb-20">
															<label class="flex center-aligned-vert">
																<input type="checkbox" name="quote-hotel[]" value="<?= $hotel->name ?>">
																<span class="ah-filter-menu-checkbox flex"></span>
																<span class="ah-filter-menu-label"><?= $hotel->name ?></span>
															</label>
														</li>
													<?php } ?>
												</ul>

											<?php } ?>
										</div>
										<div class="ah-filter-menu-footer flex center-aligned-vert">
											<a href="javascript:void(0)" class="gallery-items-link inline-block fs-15 right-aligned clear-hotel" data-unit="<?= Yii::t('app', "Tous les hôtels") ?>"><?= Yii::t('app', "Effacer") ?></a>
											<button type="button" class="ah-btn small-ah-btn fs-14 border-rad-4 flex center-aligned-vert white-text darkgray-bg submit-option" data-target="hotel-selection"><?= Yii::t('app', "Valider") ?></button>
										</div>
									</div>
								</div>
								<span class="block mb-5 fs-12"><?= Yii::t('app', "Choisissez le ou les hôtels de votre choix (3 hôtels max.) ou une catégorie d'hôtels si vous n'avez pas encore fait votre choix !") ?></span>
							</div>
							<div class="get-a-quote-2-cols flex mb-20 pb-10">
								<label class="flex-1">
									<span class="block mb-5"><?= Yii::t('app', "Arrivée") ?> <span class="text-red">*</span></span>
									<input type="text" id="datepicker-from-page" name="quote-arrive" placeholder="<?= Yii::t('app', "Ajouter dates") ?>" class="full-width border-1-light darkgray-text fs-15" required>
								</label>
								<label class="flex-1 pl-20">
									<span class="block mb-5"><?= Yii::t('app', "Départ") ?> <span class="text-red">*</span></span>
									<input type="text" id="datepicker-to-page" name="quote-departure" placeholder="<?= Yii::t('app', "Ajouter dates") ?>" class="full-width border-1-light darkgray-text fs-15" required>
								</label>
							</div>
							<div class="mb-20 pb-10 relative ah-filter-form-guests">
								<input type="checkbox" class="ah-filter-item-checkbox" id="ah-filter-item-checkbox-2">
								<label for="ah-filter-item-checkbox-2">
									<span class="block mb-5"><?= Yii::t('app', "Voyageurs") ?> <span class="text-red">*</span></span>
									<input type="text" name="quote-guests" placeholder="<?= Yii::t('app', "Ajouter voyageurs") ?>" class="full-width border-1-light darkgray-text fs-15 relative form-guests-selection" style="z-index:-1;" required>
								</label>
								<div class="ah-filter-menu hidden absolute border-1-light white-bg fs-14">
									<div class="ah-filter-menu-body">
										<strong class="block bold-text fs-15"><?= Yii::t('app', "Adultes") ?></strong>
										<ul class="ah-filter-guests-age-counter mb-20">
											<li class="flex center-aligned-vert mt-5">
												<span class="gray-text"><?= Yii::t('app', "À partir de 18 ans") ?></span>
												<div>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert passive-ah-btn btn-minus">-</button>
													<input type="text" class="ah-filter-guests-age guests is-adult" name="quote-adult" value="0" readonly>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert btn-plus">+</button>
												</div>
											</li>
										</ul>
										<strong class="block bold-text fs-15"><?= Yii::t('app', "Ados") ?></strong>
										<ul class="ah-filter-guests-age-counter mb-20">
											<li class="flex center-aligned-vert mt-5">
												<span class="gray-text">13 - 17 <?= Yii::t('app', "ans") ?></span>
												<div>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert passive-ah-btn btn-minus">-</button>
													<input type="text" class="ah-filter-guests-age guests is-teen" name="quote-teen" value="0" readonly>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert btn-plus">+</button>
												</div>
											</li>
										</ul>
										<strong class="block bold-text fs-15"><?= Yii::t('app', "Enfants") ?></strong>
										<ul class="ah-filter-guests-age-counter">
											<li class="flex center-aligned-vert mt-10 pb-5">
												<span class="gray-text">7 - 12 <?= Yii::t('app', "ans") ?></span>
												<div>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert passive-ah-btn btn-minus">-</button>
													<input type="text" class="ah-filter-guests-age guests" name="quote-children-12" value="0" readonly>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert btn-plus">+</button>
												</div>
											</li>
											<li class="flex center-aligned-vert mt-10 pb-5">
												<span class="gray-text">0 - 6 <?= Yii::t('app', "ans") ?></span>
												<div>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert passive-ah-btn btn-minus">-</button>
													<input type="text" class="ah-filter-guests-age guests" name="quote-children-6" value="0" readonly>
													<button type="button"  class="border-1 border-rad-full inline-flex center-aligned-hor center-aligned-vert btn-plus">+</button>
												</div>
											</li>
										</ul>
									</div>
									<div class="ah-filter-menu-footer flex center-aligned-vert">
										<a href="javascript:void(0)" class="gallery-items-link inline-block bold-text fs-15 right-aligned clear-guests" data-unit="<?= Yii::t('app', "Ajouter voyageurs") ?>"><?= Yii::t('app', "Effacer") ?></a>
										<button type="button" class="ah-btn small-ah-btn fs-14 border-rad-4 flex center-aligned-vert center-aligned-vert white-text darkgray-bg submit-option" data-target="form-guests-selection" data-unit-adults="<?= strtolower(Yii::t('app', "Adulte(s)")) ?>" data-unit-teens="<?= strtolower(Yii::t('app', "Ado(s)")) ?>" data-unit-children="<?= strtolower(Yii::t('app', "Enfant(s)")) ?>"><?= Yii::t('app', "Valider") ?></button>
									</div>
								</div>
							</div>
							<div class="mb-20 pb-10">
								<label class="flex">
									<span class="left-aligned fs-15"><?= Yii::t('app', "Souhaitez-vous inclure un service de transfert aéroport ?") ?></span>
									<input type="checkbox" id="show-extra-input-blocks" name="quote-transfer" value="<?= Yii::t('app', "Oui") ?>">
									<span class="checkbox"></span>
								</label>
								<div class="extra-input-blocks display-none mt-10 pt-5">
									<textarea name="quote-transfer-details" class="full-width border-1-light gray-text fs-15" placeholder="<?= Yii::t('app', "Veuillez indiquer les détails de votre vol ici") ?> (<?= Yii::t('app', "facultatif") ?>)"></textarea>
								</div>
							</div>
							<div class="mb-20 pb-10">
								<span class="block mb-10 fs-15"><?= Yii::t('app', "Souhaitez-vous inclure des repas ?") ?></span>
								<div class="check-group flex fs-15">
									<label class="inline-flex center-aligned-vert">
										<input type="radio" name="quote-meal-plan" id="bb" value="<?= Yii::t('app', "Petit déjeuner") ?>" checked="">
										<span class="checkbox" checked></span>
										<span class="simplegray-text"><?= Yii::t('app', "Petit déjeuner") ?></span>
									</label>
									<label class="ml-40 inline-flex center-aligned-vert">
										<input type="radio" name="quote-meal-plan" id="halfboard" value="<?= Yii::t('app', "Demi-pension") ?>">
										<span class="checkbox"></span>										
										<span class="simplegray-text"><?= Yii::t('app', "Demi-pension") ?></span>
									</label>
								</div>
								<div class="check-group flex fs-15 mt-20">
									<label class="inline-flex center-aligned-vert">
										<input type="radio" name="quote-meal-plan" id="fullboard" value="<?= Yii::t('app', "Pension complète") ?>">
										<span class="checkbox"></span>
										<span class="simplegray-text"><?= Yii::t('app', "Pension complète") ?></span>
									</label>
									<label class="ml-40 inline-flex center-aligned-vert">
										<input type="radio" name="quote-meal-plan" id="allinallout" value="<?= Yii::t('app', "Forfait All-in All-out") ?>">
										<span class="checkbox"></span>
										<span class="simplegray-text"><?= Yii::t('app', "Forfait All-in All-out") ?></span>
									</label>
								</div>
							</div>
							<div class="">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Commentaires") ?> (<?= Yii::t('app', "facultatif") ?>)</span>
									<textarea name="quote-comments" class="full-width border-1-light gray-text fs-15"></textarea>
								</label>
							</div>
						</div>
						<div class="flex-1">
							<div class="gallery-items-title mb-20 pb-5 bold-text"><?= Yii::t('app', "Informations de contact") ?></div>
							<div class="get-a-quote-2-cols flex mb-20 pb-10">
								<label class="flex-1">
									<span class="block mb-5"><?= Yii::t('app', "Prénom") ?> <span class="text-red">*</span></span>
									<input type="text" name="quote-firstname" placeholder="John" class="full-width border-1-light darkgray-text fs-15" required>
								</label>
								<label class="flex-1 pl-20">
									<span class="block mb-5"><?= Yii::t('app', "Nom") ?> <span class="text-red">*</span></span>
									<input type="text" name="quote-lastname" placeholder="Johnson" class="full-width border-1-light darkgray-text fs-15" required>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Pays de résidence") ?> <span class="text-red">*</span></span>
									<select name="quote-country" size="1" class="block full-width border-1-light fs-15 darkgray-text" required>
										<option value=""><?= Yii::t('app', "Sélectionner un pays") ?></option>
										<?php
										$countries = MainHelper::getCountryList();
										foreach ($countries as $country) { ?>
											<option value="<?= $country ?>"><?= $country ?></option>
										<?php } ?> 
									</select>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Email") ?> <span class="text-red">*</span></span>
									<input type="email" name="quote-email" placeholder="john.johnson@mail.com" class="full-width border-1-light darkgray-text fs-15" required>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Numéro de téléphone") ?> (<?= Yii::t('app', "facultatif") ?>)</span>
									<input type="text" name="quote-phone" placeholder="+230 204 3820" class="full-width border-1-light gray-text fs-15">
								</label>
							</div>
							<div>
								<label class="flex">
									<span class="left-aligned fs-15"><?= Yii::t('app', "Souhaitez-vous recevoir des actualités et des offres spéciales d'Attitude ?") ?></span>
									<input type="checkbox" name="quote-newsletter" value="<?= Yii::t('app', "Oui") ?>">
									<span class="checkbox"></span>
								</label>
							</div>
							<div class="flex mt-30">
								<a href="#newsletter-mauritian-citizen" class="ah-btn fs-15 border-rad-4 inline-flex center-aligned-vert center-aligned-hor right-aligned darkgray-bg white-text show-nl-modal"><?= Yii::t('app', "Valider") ?></a>
							</div>
							<div class="flex mt-30">
								<div class="right-aligned">
									<span class="text-red">*</span> <?= Yii::t('app', "Champs requis") ?>
								</div>
							</div>
						</div>
					</div>

		        <?php ActiveForm::end(); ?>
		        <!--end::Form-->

			</div>

			<?php
			if ($mailSent) {

				$p = Yii::$app->request->post();
				$nights = (strtotime(str_replace('/', '-', $p['quote-departure'])) - strtotime(str_replace('/', '-', $p['quote-arrive']))) / 86400;
				$guests = $p['quote-adult'] + $p['quote-teen'] + $p['quote-children-12'] + $p['quote-children-6']; ?>
				<span class="gtm-view" data-event="quotation" data-hotel_name="<?= implode(', ', $p['quote-hotel']) ?>" data-meal_plan="<?= $p['quote-meal-plan'] ?>" data-stay_duration="<?= $nights ?>" data-guest_number="<?= $guests ?>"></span>

				<div class="ah-popup-layer absolute flex center-aligned-hor center-aligned-vert modal cover-body">
					<div class="ah-popup-content call-up-popup get-quote-popup white-bg relative centered-text full-width">
						<div class="ah-popup-top">
							<a href="#" class="ah-popup-close block absolute"></a>
						</div>
						<div class="ah-popup-inner">
							<div>
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/get-a-quote-popup.png" alt="" class="block margin-auto-hor">
								<span class="block mt-10 mb-20 fs-18 darkgray-text"><?= $popinTitle ?></span>
								<span class="fs-14 lh-20"><?= $popinContent ?></span>
							</div>
							<div class="flex mt-30 center-aligned-hor">
								<a href="#" class="ah-btn small-ah-btn fs-14 border-rad-4 flex center-aligned-vert center-aligned-hor border-1 darkgray-text popup-close">OK</a>
							</div>
						</div>
					</div>
				</div>

			<?php } ?>
