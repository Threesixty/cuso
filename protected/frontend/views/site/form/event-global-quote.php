<?php

use yii\helpers\Url;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use common\models\Media;
use frontend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($cms->title, '', true);
?>

		<section class="white-bg">
			<div class="get-a-quote-text lightgray-bg">
				<div class="flex center-aligned-hor">
					<div class="experience-in-mauritius flex-1 margin-auto-vert">
						<div class="prompt-para margin-auto-hor">
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
		        <?php $form = ActiveForm::begin(['id' => 'form-event-global-quote', 'options' => ['data-parsley-validate' => true]]); ?>
					<input type="hidden" name="newsletter-isMauritian" value="">
					<input type="hidden" name="newsletter-type" value="">
		        	<input type="hidden" name="event-global-quote" value="1">

					<div class="our-hotels-list get-a-quote-form flex pt-100 fs-14 lh-20 darkgray-text">
						<div class="flex-1">
							<div class="gallery-items-title mb-20 pb-5 bold-text"><?= Yii::t('app', "Informations de contact") ?></div>
							<div class="get-a-quote-2-cols flex mb-20 pb-10">
								<label class="flex-1">
									<span class="block mb-5"><?= Yii::t('app', "Prénom") ?> <span class="text-red">*</span></span>
									<input type="text" name="quote-firstname" placeholder="John" class="full-width border-1-light gray-text fs-15" required>
								</label>
								<label class="flex-1 pl-20">
									<span class="block mb-5"><?= Yii::t('app', "Nom") ?> <span class="text-red">*</span></span>
									<input type="text" name="quote-lastname" placeholder="Johnson" class="full-width border-1-light gray-text fs-15" required>
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
									<span class="block mb-5"><?= Yii::t('app', "Numéro de téléphone") ?> <span class="text-red">*</span></span>
									<input type="text" name="quote-phone" placeholder="+230 204 3820" class="full-width border-1-light gray-text fs-15" required>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Email") ?> <span class="text-red">*</span></span>
									<input type="email" name="quote-email" placeholder="john.johnson@mail.com" class="full-width border-1-light gray-text fs-15" required>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<span class="block mb-10 fs-15"><?= Yii::t('app', "Contact") ?></span>
								<div class="check-group flex fs-15">
									<label class="inline-flex center-aligned-vert">
										<input type="radio" name="quote-contact" id="part" value="Particulier" checked="">
										<span class="checkbox" checked></span>
										<span class="simplegray-text"><?= Yii::t('app', "Particulier") ?></span>
									</label>
									<label class="ml-40 inline-flex center-aligned-vert">
										<input type="radio" name="quote-contact" id="pro" value="Professionnel" class="required">
										<span class="checkbox"></span>										
										<span class="simplegray-text"><?= Yii::t('app', "Professionnel") ?></span>
									</label>
								</div>
							</div>
							<div>
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Société") ?> <span class="text-red hidden">*</span></span>
									<input type="text" name="quote-company" placeholder="<?= Yii::t('app', "Nom de la société") ?>" class="full-width border-1-light gray-text fs-15">
								</label>
							</div>
						</div>
						<div class="flex-1">
							<div class="gallery-items-title mb-20 pb-5 bold-text"><?= Yii::t('app', "Détail de l'événement") ?></div>
							<div class="mb-20 pb-10 relative">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Hôtel") ?> (<?= Yii::t('app', "facultatif") ?>)</span>
									<select size="1" name="quote-hotel" class="block full-width border-1-light gray-text fs-15 darkgray-text event-global-quote-hotel">
										<option value="all-hotels"><?= Yii::t('app', "Tous les hôtels") ?></option>
										<?php
										foreach ($hotelList as $hotel) { ?>
											<option value="<?= $hotel->name ?>" data-id="<?= $hotel->id ?>"><?= $hotel->name ?></option>
										<?php } ?>
									</select>
								</label>
							</div>
							<div class="get-a-quote-2-cols flex mb-20 pb-10">
								<label class="flex-1">
									<span class="block mb-5"><?= Yii::t('app', "Date de début") ?> <span class="text-red">*</span></span>
									<input type="text" id="datepicker-from-page" name="quote-start" placeholder="<?= Yii::t('app', "Ajouter dates") ?>" class="full-width border-1-light gray-text fs-15" required>
								</label>
								<label class="flex-1 pl-20">
									<span class="block mb-5"><?= Yii::t('app', "Date de fin") ?> <span class="text-red">*</span></span>
									<input type="text" id="datepicker-to-page" name="quote-end" placeholder="<?= Yii::t('app', "Ajouter dates") ?>" class="full-width border-1-light gray-text fs-15" required>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Type d'événement") ?></span>
									<select name="quote-event-type" size="1" class="block full-width border-1-light gray-text fs-15">
										<option value=""><?= Yii::t('app', "Sélectionner une catégorie") ?></option>
										<?php
										if (isset($events) && !empty($events)) {
											$noDoublon = [];
											foreach ($events as $event) {
												$doublon = false;
												if (!in_array($event->title, $noDoublon)) {
													$noDoublon[] = $event->title;
												} else {
													$doublon = true;
												} ?>
												<option value="<?= $event->title ?>" class="hotel-event event-<?= $event->hotel ?> <?= $doublon ? 'doublon' : '' ?>" <?= $doublon ? 'hidden' : '' ?>><?= $event->title ?></option>
											<?php }
										} ?>
										<option value="<?= Yii::t('app', "Mariage") ?>"><?= Yii::t('app', "Mariage") ?></option>
										<option value="<?= Yii::t('app', "Autre") ?>"><?= Yii::t('app', "Autre") ?></option>
									</select>
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Nombre de personnes") ?></span>
									<input type="number" name="quote-people" placeholder="<?= Yii::t('app', "Ajouter un nombre") ?>" class="full-width border-1-light gray-text fs-15">
								</label>
							</div>
							<div class="mb-20 pb-10">
								<label class="flex">
									<span class="left-aligned fs-15"><?= Yii::t('app', "Inclure l'hébergement pour mon événement") ?></span>
									<input type="checkbox" id="show-extra-input-blocks" name="quote-include-accomodation" value="Oui">
									<span class="checkbox"></span>
								</label>
							</div>
							
							<div class="extra-input-blocks display-none">
								<div class="mb-20 pb-10">
									<label>
										<span class="block mb-5"><?= Yii::t('app', "Nombre de chambres") ?></span>
										<input type="text" name="quote-rooms" placeholder="<?= Yii::t('app', "Ajouter un nombre") ?>" class="full-width border-1-light gray-text fs-15">
									</label>
								</div>
								<div class="mb-20 pb-10" style="display:none;">
									<label>
										<span class="block mb-5"><?= Yii::t('app', "Catégorie de chambre") ?></span>
										<select name="quote-room-type" size="1" class="block full-width border-1-light gray-text fs-15">
											<option value=""><?= Yii::t('app', "Sélectionner une catégorie") ?></option>
											<?php
											if (isset($rooms) && !empty($rooms)) {
												foreach ($rooms as $room) { ?>
													<option value="<?= $room->name ?>" class="hotel-room room-<?= $room->hotel_id ?>" hidden><?= $room->name ?></option>
												<?php }
											} ?>
										</select>
									</label>
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
								<div class="mb-20 pb-10">
									<label>
										<span class="block mb-5"><?= Yii::t('app', "Nombre de nuits") ?></span>
										<input type="text" name="quote-nights" placeholder="<?= Yii::t('app', "Ajouter un nombre") ?>" class="full-width border-1-light gray-text fs-15">
									</label>
								</div>
							</div>
							
							<div class="mb-20 pb-10">
								<label>
									<span class="block mb-5"><?= Yii::t('app', "Commentaires") ?> (<?= Yii::t('app', "facultatif") ?>)</span>
									<textarea name="quote-comments" class="full-width border-1-light gray-text fs-15"></textarea>
								</label>
							</div>
							<div>
								<label class="flex">
									<span class="left-aligned fs-15"><?= Yii::t('app', "Souhaitez-vous recevoir des actualités et des offres spéciales d'Attitude ?") ?></span>
									<input type="checkbox" name="quote-newsletter" value="Oui">
									<span class="checkbox"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="our-hotels-list get-a-quote-form flex mt-30">
						<a href="#newsletter-mauritian-citizen" class="ah-btn fs-15 border-rad-4 inline-flex center-aligned-vert center-aligned-hor right-aligned darkgray-bg white-text show-nl-modal"><?= Yii::t('app', "Valider") ?></a>
					</div>
					<div class="our-hotels-list flex mt-30">
						<div class="right-aligned">
							<span class="text-red">*</span> <?= Yii::t('app', "Champs requis") ?>
						</div>
					</div>

		        <?php ActiveForm::end(); ?>
		        <!--end::Form-->

			</div>
		</section>

		<?php
		if ($mailSent) {
			$p = Yii::$app->request->post();

			$isB2B = $p['quote-contact'] == 'Professionnel' ? 'b2b_quotation' : 'quotation';
			$nights = (strtotime(str_replace('/', '-', $p['quote-end'])) - strtotime(str_replace('/', '-', $p['quote-start']))) / 86400; ?>
			<span class="gtm-view" data-event="<?= $isB2B ?>" data-hotel_name="<?= $p['quote-hotel'] ?>" data-meal_plan="<?= $p['quote-meal-plan'] ?>" data-stay_duration="<?= $nights ?>" data-guest_number="<?= $p['quote-people'] ?>" data-company_name="<?= $p['quote-company'] ?>" data-event_type="<?= $p['quote-event-type'] ?>"></span>

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
