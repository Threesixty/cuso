<?php
use yii\helpers\Url;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

?>
				<!--begin::Aside Secondary-->
				<div class="sidebar sidebar-left d-flex flex-row-auto flex-column bg-light-success" id="kt_sidebar">
					<a href="javascript:;" id="kt_sidebar_mobile_close" class="close-sidebar">
						<i class="text-success flaticon2-delete"></i>
					</a>
					<!--begin::Aside Secondary Header-->
					<div class="sidebar-header flex-column-auto pt-5 px-5 px-lg-10 mt-4">

						<div class="card card-stretch gutter-b">
							<div class="card-body">

								<ul class="nav nav-tabs nav-tabs-line">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tabAddMedia">Ajouter des fichiers</a>
									</li>
								</ul>
								<div class="tab-content mt-5" id="mediaContent">
									<div class="tab-pane fade show active" id="tabAddMedia" role="tabpanel" aria-labelledby="tabAddMedia">
										<div class="uppy" id="kt_uppy_2" data-upload-url="<?= Url::to(['site/new-media']) ?>">
											<div class="uppy-dashboard uppy-size--md"></div>
											<div class="uppy-progress"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!--end::Aside Secondary Content-->

					<?= PopinWidget::widget(['name' => 'edit-media']) ?>
				</div>
				<!--end::Aside Secondary-->