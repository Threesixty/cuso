<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Media;
use common\widgets\Alert;
use backend\widgets\SidebarWidget;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

AppAsset::register($this);

$actionId = Yii::$app->controller->action->id;
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?= Yii::$app->request->BaseUrl ?>/favicon.png">

        <?php $this->head() ?>
    </head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading">

        <?php $this->beginBody() ?>

        <!--begin::Header Mobile-->
        <div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
            <!--begin::Logo-->
            <a href="<?= Yii::$app->homeUrl ?>">
                <!--begin::Logo-->
                <?php
                $avatar = Yii::$app->request->BaseUrl.'/media/boy.svg';
                $userAvatarArr = JSON::decode(Yii::$app->user->identity->photo_id);
                if (null !== $userAvatarArr) {
                    foreach ($userAvatarArr as $userPhotoId) {
                        $photo = Media::findOne($userPhotoId);
                        if (null !== $photo)
                            $avatar = Yii::getAlias('@uploadWeb').'/'.$photo->path;
                    }
                } ?>
                <img alt="Avatar" src="<?= $avatar ?>" class="logo-default max-h-30px rounded" />
                <!--end::Logo-->
            </a>
            <!--end::Logo-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <button class="btn p-0 burger-icon burger-icon-left rounded-0" id="kt_header_mobile_toggle">
                    <span></span>
                </button>
                <button class="btn btn-hover-icon-primary p-0 ml-5" id="kt_sidebar_mobile_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Substract.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero" />
                                <path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </button>
                <button class="btn btn-hover-icon-primary p-0 ml-2" id="kt_aside_mobile_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
                </button>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header Mobile-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="d-flex flex-row flex-column-fluid page">
                <!--begin::Aside-->
                <div class="aside aside-left d-flex flex-column" id="kt_aside">
                    <!--begin::Brand-->
                    <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-9">
                        <!--begin::Logo-->
                        <?php
                        $avatar = Yii::$app->request->BaseUrl.'/media/boy.svg';
                        $userAvatarArr = JSON::decode(Yii::$app->user->identity->photo_id);
                        if (null !== $userAvatarArr) {
                            foreach ($userAvatarArr as $userPhotoId) {
                                $photo = Media::findOne($userPhotoId);
                                if (null !== $photo)
                                    $avatar = Yii::getAlias('@uploadWeb').'/'.$photo->path;
                            }
                        } ?>
                        <a href="<?= Url::to(['site/edit-user', 'id' => Yii::$app->user->identity->id]) ?>" class="btn p-0 symbol symbol-55 symbol-success">
                            <div class="symbol-label">
                                <img alt="Avatar" src="<?= $avatar ?>" class="h-100 align-self-end rounded" />
                            </div>
                        </a>
                        <!--end::Logo-->
                    </div>
                    <!--end::Brand-->
                    <!--begin::Nav Wrapper-->
                    <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid pb-10">
                        <!--begin::Nav-->
                        <ul class="nav flex-column">
                            <!--begin::Item-->
                            <!--li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="CRM">
                                <a href="<?= Url::to(['site/crm']) ?>" class="nav-link btn btn-icon btn-lg btn-borderless <?= strpos($actionId, 'crm') !== false ? 'active' : '' ?>">
                                    <span class="svg-icon svg-icon-xxl">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                                                <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                                                <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                                                <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </li-->
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Utilisateurs">
                                <a href="<?= Url::to(['site/user']) ?>" class="nav-link btn btn-icon btn-lg btn-borderless <?= strpos($actionId, 'user') !== false ? 'active' : '' ?>">
                                    <span class="svg-icon svg-icon-xxl">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Sociétés">
                                <a href="<?= Url::to(['site/company']) ?>" class="nav-link btn btn-icon btn-lg btn-borderless <?= strpos($actionId, 'company') !== false ? 'active' : '' ?>">
                                    <span class="svg-icon svg-icon-xxl">
                                    	<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Home\Building.svg-->
                                    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										        <rect x="0" y="0" width="24" height="24"/>
										        <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
										        <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
										        <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
										    </g>
										</svg>
										<!--end::Svg Icon-->
									</span>
                                </a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Médias">
                                <a href="<?= Url::to(['site/media']) ?>" class="nav-link btn btn-icon btn-lg btn-borderless <?= strpos($actionId, 'media') !== false ? 'active' : '' ?>">
                                    <span class="svg-icon svg-icon-xxl"><!--begin::Svg Icon | path:assets/media/svg/icons\Files\Pictures1.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                                <polygon fill="#000000" opacity="0.3" points="4 19 10 11 16 19"/>
                                                <polygon fill="#000000" points="11 19 15 14 19 19"/>
                                                <path d="M18,12 C18.8284271,12 19.5,11.3284271 19.5,10.5 C19.5,9.67157288 18.8284271,9 18,9 C17.1715729,9 16.5,9.67157288 16.5,10.5 C16.5,11.3284271 17.1715729,12 18,12 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </a>
                            </li>
                            <!--end::Item-->
                            <?php
                            if (Yii::$app->user->identity->role == 5) { ?>

                                <!--begin::Item-->
                                <li class="nav-item mb-2" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Options">
                                    <a href="<?= Url::to(['site/option']) ?>" class="nav-link btn btn-icon btn-lg btn-borderless <?= strpos($actionId, 'option') !== false ? 'active' : '' ?>">
                                        <span class="svg-icon svg-icon-xxl">
                                        	<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Code\Git4.svg-->
                                        	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											        <rect x="0" y="0" width="24" height="24"/>
											        <path d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z" fill="#000000" fill-rule="nonzero"/>
											        <path d="M7,11.4648712 L7,17 C7,18.1045695 7.8954305,19 9,19 L15,19 L15,21 L9,21 C6.790861,21 5,19.209139 5,17 L5,8 L5,7 L7,7 L7,8 C7,9.1045695 7.8954305,10 9,10 L15,10 L15,12 L9,12 C8.27142571,12 7.58834673,11.8052114 7,11.4648712 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
											        <path d="M18,22 C19.1045695,22 20,21.1045695 20,20 C20,18.8954305 19.1045695,18 18,18 C16.8954305,18 16,18.8954305 16,20 C16,21.1045695 16.8954305,22 18,22 Z M18,24 C15.790861,24 14,22.209139 14,20 C14,17.790861 15.790861,16 18,16 C20.209139,16 22,17.790861 22,20 C22,22.209139 20.209139,24 18,24 Z" fill="#000000" fill-rule="nonzero"/>
											        <path d="M18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 Z M18,15 C15.790861,15 14,13.209139 14,11 C14,8.790861 15.790861,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 Z" fill="#000000" fill-rule="nonzero"/>
											    </g>
											</svg>
											<!--end::Svg Icon-->
										</span>
                                    </a>
                                </li>
                                <!--end::Item-->

                            <?php } ?>
                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--end::Nav Wrapper-->
                    <!--begin::Footer-->
                    <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-8">
                        <!--begin::Notifications-->
                        <a href="#" class="btn btn-icon btn-lg btn-borderless mb-1 position-relative" id="kt_quick_notifications_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Notifications">
                            <span class="svg-icon svg-icon-xxl">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <!--span class="label label-sm label-light-danger label-rounded font-weight-bolder position-absolute top-0 right-0 mt-1 mr-1">2</span-->
                        </a>
                        <!--end::Notifications-->
                        <!--begin::Quick Actions-->
                        <a href="<?= Url::to(['site/logout']) ?>" class="btn btn-icon btn-lg btn-borderless mb-1" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Déconnection">
                            <span class="svg-icon svg-icon-xxl">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Lock-overturning.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </a>
                        <!--end::Quick Actions-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Aside-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                    <!--begin::Header-->
                    <div id="kt_header" class="header header-fixed">
                        <!--begin::Header Wrapper-->
                        <div class="header-wrapper rounded-top-xl d-flex flex-grow-1 align-items-center">
                            <!--begin::Container-->
                            <div class="container-fluid d-flex align-items-center justify-content-end justify-content-lg-between flex-wrap">
                                <!--begin::Menu Wrapper-->
                                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                    <!--begin::Menu-->
                                    <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                        <!--begin::Nav-->
                                        <ul class="menu-nav">
                                            <li class="menu-item <?= strpos($actionId, 'index') !== false ? 'menu-item-here' : '' ?>">
                                                <a href="<?= Url::to(['site/index']) ?>" class="menu-link">
                                                    <span class="menu-text">Tableau de bord</span>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= strpos($actionId, 'cms') !== false ? 'menu-item-here' : '' ?>">
                                                <a href="<?= Url::to(['site/cms']) ?>" class="menu-link">
                                                    <span class="menu-text">Pages</span>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= strpos($actionId, 'news') !== false ? 'menu-item-here' : '' ?>">
                                                <a href="<?= Url::to(['site/news']) ?>" class="menu-link">
                                                    <span class="menu-text">Actualités</span>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= strpos($actionId, 'event') !== false ? 'menu-item-here' : '' ?>">
                                                <a href="<?= Url::to(['site/event']) ?>" class="menu-link">
                                                    <span class="menu-text">Evénements</span>
                                                </a>
                                            </li>
                                            <li class="menu-item <?= strpos($actionId, 'forum') !== false ? 'menu-item-here' : '' ?>">
                                                <a href="<?= Url::to(['site/forum']) ?>" class="menu-link">
                                                    <span class="menu-text">Forum</span>
                                                </a>
                                            </li>
                                            <!--li class="menu-item <?= strpos($actionId, 'chatbot') !== false ? 'menu-item-here' : '' ?>">
                                                <a href="<?= Url::to(['site/chatbot']) ?>" class="menu-link">
                                                    <span class="menu-text">Chatbot</span>
                                                </a>
                                            </li-->
                                        </ul>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                                <!--end::Menu Wrapper-->
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center py-3 py-lg-2 add-wrapper">
                                    <!--begin::Dropdown-->
                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Actions rapide" data-placement="left">
                                        <a href="#" class="h-40px w-40px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="svg-icon svg-icon-success svg-icon-3x">
                                                <!--begin::Svg Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                        <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>

                                        </a>
                                        <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-md dropdown-menu-right">
                                            <!--begin::Naviigation-->
                                            <ul class="navi">
                                                <li class="navi-header font-weight-bold py-5">
                                                    <span class="font-size-lg text-uppercase">Ajouter</span>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-cms']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-soft-icons"></i>
                                                        </span>
                                                        <span class="navi-text">Page</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-news']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-open-text-book"></i>
                                                        </span>
                                                        <span class="navi-text">Actualité</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-event']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon-event-calendar-symbol"></i>
                                                        </span>
                                                        <span class="navi-text">Evénement</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-forum']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-chat-1"></i>
                                                        </span>
                                                        <span class="navi-text">Discussion</span>
                                                    </a>
                                                </li>
                                                <!--li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-chatbot']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-speaker"></i>
                                                        </span>
                                                        <span class="navi-text">Chatbot</span>
                                                    </a>
                                                </li-->
                                                <li class="navi-separator mb-3 opacity-70"></li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-user']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-user"></i>
                                                        </span>
                                                        <span class="navi-text">Utilisateur</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/edit-company']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-soft-icons-1"></i>
                                                        </span>
                                                        <span class="navi-text">Société</span>
                                                    </a>
                                                </li>
                                                <li class="navi-separator mb-3 opacity-70"></li>
                                                <li class="navi-item">
                                                    <a href="<?= Url::to(['site/media']) ?>" class="navi-link">
                                                        <span class="navi-icon">
                                                            <i class="flaticon2-photo-camera"></i>
                                                        </span>
                                                        <span class="navi-text">Média</span>
                                                    </a>
                                                </li>
                                                <?php
                                                if (Yii::$app->user->identity->role == 5) { ?>
                                                    <li class="navi-item">
                                                        <a href="<?= Url::to(['site/edit-option']) ?>" class="navi-link">
                                                            <span class="navi-icon">
                                                                <i class="flaticon2-dashboard"></i>
                                                            </span>
                                                            <span class="navi-text">Option</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <!--end::Naviigation-->
                                        </div>
                                    </div>
                                    <!--end::Dropdown-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Header Wrapper-->
                    </div>
                    <!--end::Header-->

                    <?= Alert::widget() ?>
                    <?= $content ?>

                    <!--begin::Footer-->
                    <div class="footer py-2 py-lg-0 my-5 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <!--begin::Copyright-->
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted font-weight-bold mr-2"><?= date('Y') ?>©</span>
                                <a href="http://osborne.fr" target="_blank" class="text-dark-75 text-hover-primary">Osborne <sup>(La Factory)</sup></a>
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Nav-->
                            <div class="nav nav-dark order-1 order-md-2">
                                <a href="http://osborne.fr/#contact" target="_blank" class="nav-link pl-3 pr-0">Contact</a>
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Wrapper-->

                <?= SidebarWidget::widget(['action' => $actionId]) ?>
                <?= PopinWidget::widget(['name' => 'delete-item', 'type' => 'media']) ?>

            </div>
            <!--end::Page-->
        </div>
        <!--end::Main-->
        <!-- begin::Notifications Panel-->
        <div id="kt_quick_notifications" class="offcanvas offcanvas-left p-10">
            <!--begin::Header-->
            <div class="offcanvas-header d-flex align-items-center justify-content-between mb-10">
                <h3 class="font-weight-bold m-0">
                    <span class="">Notifications</span>
                    <!--span class="label label-xl font-weight-boldest label-success ml-2">2</span-->
                </h3>
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_notifications_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="offcanvas-content pr-5 mr-n5">
                <!--begin::Nav-->
                <div class="navi navi-icon-circle navi-spacer-x-0">
                    <!--begin::Sep-->
                    <div class="notif-separator">
                        <div class="text-muted text-right">Aucune notification</div>
                        <hr class="mt-1 d-block">
                    </div>
                    <!--end::Sep-->
                    <!--begin::Item-->
                    <a href="#" class="navi-item">
                        <!--div class="navi-link rounded">
                            <div class="symbol symbol-50 symbol-circle mr-3">
                                <div class="symbol-label">
                                    <i class="flaticon-bell text-success icon-lg"></i>
                                </div>
                            </div>
                            <div class="navi-text">
                                <div class="font-weight-bold font-size-lg">3 commandes en attente</div>
                                <div class="text-muted">29-10-2020</div>
                            </div>
                        </div-->
                    </a>
                    <!--end::Item-->
                </div>
                <!--end::Nav-->
            </div>
            <!--end::Content-->
        </div>
        <!-- end::Notifications Panel-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                        <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </div>
        <!--end::Scrolltop-->


    <?php $this->endBody() ?>

    </body>
</html>

<?php $this->endPage() ?>
