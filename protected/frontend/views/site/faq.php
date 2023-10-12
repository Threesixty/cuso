<?php

use yii\helpers\Url;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use common\models\Cms;
use common\models\Hotel;
use common\models\Faq;
use common\components\MainHelper;

#MainHelper::pp($cms->content);

$this->title = MainHelper::getPageTitle($cms->title, '', true);

$value = $cms->content[0]['value']; // Only one faq block
$currentHotel = $value['hotel'] != 'general' ? Hotel::getHotelById($value['hotel']) : Yii::t('app', "Informations générales");
$currentCmsHotelUrl = $generic->url;
?>

                <section class="faq">
                    <div class="container">
                        <header class="faq-header">
                            <h1 class="faq-title"><?= Yii::t('app', "Questions fréquemment posées") ?></h1>
                            <div class="faq-toolbar">
                                <div class="faq-dropdown">
                                    <div class="faq-dropdown--toggle" role="button" aria-expanded="false">
                                        <div class="faq-dropdown--text"><?= isset($currentHotel->name) ? $currentHotel->name : $currentHotel ?></div>
                                        <a href="<?= Url::to(['site/content', 'url' => $generic->url]) ?>" class="faq-dropdown--text is-expanded <?= $value['hotel'] == 'general' ? 'active' : '' ?>"><?= Yii::t('app', "Informations générales") ?></a>
                                        <div class="faq-dropdown--arrow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="currentColor">
                                                <path d="M7 8c-.2 0-.4-.1-.5-.2L.2 1.4C-.1 1.1-.1.6.2.3S1 0 1.3.3L7 6.1 12.7.3c.3-.3.8-.3 1.1 0s.3.8 0 1.1L7.6 7.8c-.2.1-.4.2-.6.2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="faq-dropdown--menu">
                                    	<?php
                                    	foreach ($hotelList as $hotelCat => $hotels) { ?>
	                                        <fieldset class="faq-dropdown--group">
	                                            <div class="faq-dropdown--legend"><?= $hotelCat ?></div>
		                                    	<?php
		                                    	foreach ($hotels as $hotel) {
		                                    		$currentCmsHotelUrl = $cms->id == $hotel['content']->id ? $hotel['content']->url : $currentCmsHotelUrl; ?>
                                            		<a href="<?= Url::to(['site/content', 'url' => $hotel['content']->url]) ?>" class="faq-dropdown--item <?= $cms->id == $hotel['content']->id ? 'active' : '' ?>" role="button"><?= $hotel['name'] ?></a>
                                    			<?php } ?>
                                        	</fieldset>
                                    	<?php } ?>
                                    </div>
                                </div>
                                <div class="faq-search">
							        <!--begin::Form-->
							        <?php $form = ActiveForm::begin([
							        		'id' => 'search-faq',
							        		'action' => Url::to(['site/content', 'url' => $currentCmsHotelUrl]),
							        		'method' => 'get'
							        	]); ?>

	                                    <input type="text" name="q" value="<?= Yii::$app->request->get('q') ?>" placeholder="<?= Yii::t('app', "Recherche") ?>" aria-label="<?= Yii::t('app', "Recherche") ?>">
	                                    <button type="submit" aria-label="<?= Yii::t('app', "Valider") ?>">
	                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
	                                            <path d="M7.2 14.4c-4 0-7.2-3.2-7.2-7.2S3.2 0 7.2 0c4 0 7.2 3.2 7.2 7.2S11.1 14.4 7.2 14.4z M7.2 1.3 c-3.3 0-5.9 2.7-5.9 5.9c0 3.3 2.7 5.9 5.9 5.9s5.9-2.7 5.9-5.9C13.1 3.9 10.4 1.3 7.2 1.3z"></path>
	                                            <path d="M15.4 16c-.2 0-.3-.1-.4-.2l-3.6-3.6c-.2-.2-.2-.6 0-.9.2-.2.6-.2.9 0l3.6 3.6c.2.2.2.6 0 .9-.2.1-.4.2-.5.2z"></path>
	                                        </svg>
	                                    </button>

							        <?php ActiveForm::end(); ?>
							        <!--end::Form-->
                                </div>
                            </div>
                            <div class="faq-category">
                                <ul>
                                	<?php
                                	if ($faqCategories) {
                                		foreach ($faqCategories as $key => $category) {
				            				$currentFaqCategory = Cms::getCmsByTemplate('faq', null, false, true);
				            				$currentFaqCategory = $currentFaqCategory
				            									->andWhere(['like', 'content', '"hotel":"'.$value['hotel'].'"'])
				            									->andWhere(['like', 'content', '"category":"'.$category['key'].'"'])
				            									->one();
				            				if (null !== $currentFaqCategory) { ?>

	                                    		<li>
	                                    			<a href="<?= Url::to(['site/content', 'url' => $currentFaqCategory->url]) ?>" class="<?= $value['category'] == $category['key'] ? 'active' : '' ?>"><?= $category['name'] ?></a>
	                                    		</li>
				            				<?php }
                                		}
                                	} ?>
                                </ul>
                            </div>
                        </header>
                        <div class="faq-body">

						    <?php 
						    if (isset($search)) {
						    	if (isset($noMatch)) { ?>

		                            <div class="faq-result"><?= Yii::t('app', "Désolé, il n'y a pas de résultat correspondant à") ?> &ldquo;<?= Yii::$app->request->get('q') ?>&rdquo;.</div>
		                            <!-- faq-result -->
		                            <section class="faq-suggestion">
		                                <h2 class="faq-suggestion--title"><?= Yii::t('app', "Questions les plus posées") ?></h2>
		                                <div class="faq-suggestion--body">
		                        <?php } ?>

											<div class="faq-accordion">

						                        <?php
											    foreach ($search as $key => $faq) { ?>

												    <div class="faq-accordion--item <?= $key == 0 ? 'expanded' : '' ?>">
												        <div class="faq-accordion--toggle" role="button" data-target="#faqP1" aria-controls="faqP1" aria-expanded="false">
												            <h2 class="faq-accordion--title" id="faqH<?= $key ?>"><?= $faq->title ?></h2>
												            <div class="faq-accordion--arrow">
												                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="currentColor">
												                    <path d="M7 8c-.2 0-.4-.1-.5-.2L.2 1.4C-.1 1.1-.1.6.2.3S1 0 1.3.3L7 6.1 12.7.3c.3-.3.8-.3 1.1 0s.3.8 0 1.1L7.6 7.8c-.2.1-.4.2-.6.2z"></path>
												                </svg>
												            </div>
												        </div>
												        <div class="faq-accordion--body" id="faqP<?= $key ?>" aria-labelledby="faqH<?= $key ?>"><?= $faq->content ?></div>
												    </div>

											    <?php } ?>

											</div>

								<?php
						    	if (isset($noMatch)) { ?>

								    	</div>
								    </section>
						    	<?php }

						    } else {

								$questions = JSON::decode($value['questions']);
								if (!empty($questions)) { ?>

									<div class="faq-accordion">
										<?php
									    foreach ($questions[0]['children'] as $key => $question) {
									    	$faq = Faq::getFaqById($question['data']['id']);
									    	if (null !== $faq) { ?>

											    <div class="faq-accordion--item <?= $key == 0 ? 'expanded' : '' ?>">
											        <div class="faq-accordion--toggle" role="button" data-target="#faqP1" aria-controls="faqP1" aria-expanded="false">
											            <h2 class="faq-accordion--title" id="faqH<?= $key ?>"><?= $faq->title ?></h2>
											            <div class="faq-accordion--arrow">
											                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="currentColor">
											                    <path d="M7 8c-.2 0-.4-.1-.5-.2L.2 1.4C-.1 1.1-.1.6.2.3S1 0 1.3.3L7 6.1 12.7.3c.3-.3.8-.3 1.1 0s.3.8 0 1.1L7.6 7.8c-.2.1-.4.2-.6.2z"></path>
											                </svg>
											            </div>
											        </div>
											        <div class="faq-accordion--body" id="faqP<?= $key ?>" aria-labelledby="faqH<?= $key ?>"><?= $faq->content ?></div>
											    </div>

									    	<?php }
									    } ?>
									</div>
								<?php }
						    } ?>
                        </div>
                    </div>
                </section>
                <!-- faq -->
