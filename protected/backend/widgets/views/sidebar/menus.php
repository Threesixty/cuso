<?php
use yii\helpers\Url;
use yii\helpers\Json;
?>

				<!--begin::Aside Secondary-->
				<div class="sidebar sidebar-left d-flex flex-row-auto flex-column bg-light-success" id="kt_sidebar">

					<a href="javascript:;" id="kt_sidebar_mobile_close" class="close-sidebar">
						<i class="text-success flaticon2-delete"></i>
					</a>
					<!--begin::Aside Secondary Content-->
					<div class="sidebar-content flex-column-fluid pb-10 pt-10 px-5 px-lg-10">

						<!--begin::List Widget 9-->
						<div class="card card-custom card-shadowless bg-white gutter-b blockui_card">
							<!--begin::Header-->
							<div class="card-header align-items-center border-0 mt-4">
								<h3 class="card-title align-items-start flex-column">
									<span class="font-weight-bolder text-dark">Menus de navigation</span>
								</h3>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-4">
								<div class="row">
									<div class="col-12">
										<input type="hidden" name="menus" value='<?= $menus ?>' data-url="<?= Url::to(['site/save-menus']) ?>">
										<div id="menusTree" class="tree-content" data-name="Menus"></div>
									</div>
								</div>
								<div class="row mt-5">
									<div class="col-12">
                                    	<button type="button" class="btn btn-success float-right save-menus">Enregistrer</button>
                                    </div>
								</div>
								<div class="row">
									<div class="col-12" style="white-space: pre-wrap;"><code id="code"></code></div>
								</div>
							</div>
							<!--end: Card Body-->
						</div>
						<!--end: List Widget 9-->
					</div>
					<!--end::Aside Secondary Content-->
				</div>
				<!--end::Aside Secondary-->