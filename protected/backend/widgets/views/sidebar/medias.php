<?php
use yii\helpers\Url;
use backend\widgets\UpdateWidget;
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
						<!--begin::Toolbar-->
						<div class="d-flex">
							<!--begin::Desktop Search-->
							<div class="quick-search quick-search-inline flex-grow-1" id="kt_quick_search_inline">
								<!--begin::Form-->
								<form method="get" class="quick-search-form">
									<div class="input-group rounded" style="background-color: #ffffff;">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<span class="svg-icon svg-icon-lg svg-icon-success">
													<!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg>
													<!--end::Svg Icon-->
												</span>
											</span>
										</div>
										<input type="text" class="form-control form-control-primary h-40px" placeholder="Rechercher un media..." data-url="<?= Url::to(['site/search-medias']) ?>" />
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="quick-search-close ki ki-close icon-sm text-primary"></i>
											</span>
										</div>
									</div>
								</form>
								<!--end::Form-->
								<!--begin::Search Toggle-->
								<div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,1px"></div>
								<!--end::Search Toggle-->
								<!--begin::Dropdown-->
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-anim-up">
									<div class="quick-search-wrapper scroll" data-scroll="true" data-height="350" data-mobile-height="200"></div>
								</div>
								<!--end::Dropdown-->
							</div>
							<!--end::Desktop Search-->
						</div>
						<!--end::Toolbar-->
					</div>
					<!--end::Aside Secondary Header-->
					<!--begin::Aside Secondary Content-->
					<div class="sidebar-content flex-column-fluid pb-10 pt-4 px-5 px-lg-10">

						<div class="card card-stretch gutter-b">
							<div class="card-body">

								<ul class="nav nav-tabs nav-tabs-line">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#tabMedia">Bibliothèque</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tabAddMedia">Ajouter des fichiers</a>
									</li>
								</ul>
								<div class="tab-content mt-5" id="mediaContent">
									<div class="tab-pane fade show active" id="tabMedia" role="tabpanel" aria-labelledby="tabMedia">
										<div class="scroll scroll-pull" data-scroll="true" style="height: 470px">
                        					<div class="row draggable-zone medias-evenodd" data-medialist-url="<?= Url::to(['site/media-list']) ?>" data-offset="<?= count($mediaList) ?>">
					                            <?php
					                            if (null !== $mediaList) { 
					                                foreach ($mediaList as $media) {
					                                	$pathInfo = pathinfo(Yii::getAlias('@uploadFolder').'/'.$media->path); ?>

					                                    <div class="col-md-6 mt-3 mb-3 draggable media<?= $media->id ?>" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="<?= $media->title ?>" data-id="<?= $media->id ?>">
					                                        <div class="action-btn">
					                                            <a href="" class="btn btn-icon btn-danger btn-circle btn-sm delete-media" data-toggle="modal" data-target="#deleteModal" data-media-id="<?= $media->id ?>">
					                                                <i class="flaticon2-trash"></i>
					                                            </a>
					                                            <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="<?= $media->id ?>">
					                                                <i class="flaticon2-trash"></i>
					                                            </a>
					                                            <a href="javascript:;" class="btn btn-icon btn-primary btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>" data-media-id="<?= $media->id ?>" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
					                                                <i class="flaticon2-edit"></i>
					                                            </a>
					                                        </div>
					                                        <div class="overflow-image rounded draggable-handle text-center">
                                                                <?php
                                                                $mimeType = mime_content_type(Yii::getAlias('@uploadFolder').'/'.$media->path);
                                                                $type = explode('/', $mimeType);
                                                                switch ($type[0]) {
                                                                    case 'image': ?>
                                                                        <img src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>">
                                                                        <?php break;

                                                                    case 'video': ?>
                                                                        <video class="rounded" muted autoplay>
                                                                            <source src="<?= Yii::getAlias('@uploadWeb').'/'.$media->path ?>">
                                                                        </video>
                                                                        <?php break;

				                                                    case 'application':
				                                                        $icon = ''; 
				                                                        switch ($type[1]) {
				                                                            case 'pdf':
				                                                                $icon = 'pdf';
				                                                                break;
				                                                            case 'msword':
				                                                            case 'vnd.openxmlformats-officedocument.wordprocessingml.document':
				                                                                $icon = 'word';
				                                                                break;
				                                                            case 'vnd.ms-excel':
				                                                            case 'vnd.openxmlformats-officedocument.spreadsheetml.sheet':
				                                                                $icon = 'excel';
				                                                                break;
				                                                            case 'vnd.ms-powerpoint':
				                                                            case 'vnd.openxmlformats-officedocument.presentationml.presentation':
				                                                                $icon = 'powerpoint';
				                                                                break;
				                                                             
				                                                             default:
				                                                                $icon = 'document';
				                                                                break;
				                                                        } ?>
				                                                        <img src="<?= Yii::$app->request->BaseUrl ?>/media/<?= $icon ?>.png">
				                                                        <?php break;
                                                                    
                                                                    default: ?>
                                                                        <img src="<?= Yii::$app->request->BaseUrl ?>/media/document.png">
                                                                        <?php break;
                                                                } ?>
					                                        </div>
					                                    </div>
					                                <?php } 
					                            } ?>

					                            <div class="col-md-6 mt-3 mb-3 draggable block-image" role="button" data-toggle="tooltip" data-placement="left" data-theme="dark" title="" data-id="" data-media-url="<?= Yii::getAlias('@uploadWeb').'/' ?>">
					                                <div class="action-btn">
			                                            <a href="" class="btn btn-icon btn-danger btn-circle btn-sm delete-media" data-toggle="modal" data-target="#deleteModal" data-media-id="">
			                                                <i class="flaticon2-trash"></i>
			                                            </a>
					                                    <a href="javascript:;" class="btn btn-icon btn-danger btn-circle btn-lg remove-media" data-media-id="">
					                                        <i class="flaticon2-trash"></i>
					                                    </a>
					                                    <a href="javascript:;" class="btn btn-icon btn-primary btn-circle btn-sm edit-media" data-toggle="modal" data-target="#modalEditMedia" data-media-src="" data-media-id="" data-getmedia-url="<?= Url::to(['site/get-media']) ?>">
					                                        <i class="flaticon2-edit"></i>
					                                    </a>
					                                </div>
					                                <div class="overflow-image rounded draggable-handle text-center">
					                                    <img src="" class="d-none">
			                                        	<video class="rounded d-none" muted autoplay>
			                                        		<source src="">
			                                        	</video>
					                                </div>
					                            </div>
											</div>
											<div class="spinner spinner-track spinner-success spinner-lg mt-5 text-center"></div>
										</div>
									</div>
									<div class="tab-pane fade" id="tabAddMedia" role="tabpanel" aria-labelledby="tabAddMedia">
										<div class="uppy" id="kt_uppy_2" data-upload-url="<?= Url::to(['site/new-media']) ?>">
											<div class="uppy-dashboard uppy-size--md"></div>
											<div class="uppy-progress"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

                		<?= UpdateWidget::widget() ?>

					</div>
					<!--end::Aside Secondary Content-->

					<?= PopinWidget::widget(['name' => 'edit-media']) ?>
				</div>
				<!--end::Aside Secondary-->