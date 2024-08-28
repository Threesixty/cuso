<?php
use yii\helpers\Url;
use common\models\User;
use common\models\Company;
use common\models\Participant;

/* @var $this yii\web\View */

$this->title = 'Tableau de bord';
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->

                <!--begin::Row-->
                <div class="row mt-0 mt-lg-8">
                    <div class="col-xl-12">
                        <!--begin::Charts Widget 5-->
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Card header-->
                            <div class="card-header h-auto border-0">
                                <div class="card-title py-5">
                                    <h3 class="card-label">
                                        <span class="d-block text-dark font-weight-bolder">Demande d'adhésion en attente</span>
                                        <span class="d-block text-muted mt-2 font-size-sm">Plus anciennes demandes en premier</span>
                                    </h3>
                                </div>
                                <div class="card-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link py-2 px-4 bg-primary toggle-pending-users" href="javascript:void(0)">
                                                <span class="nav-text text-light font-size-sm toggle-text">Masquer</span>
                                                <span class="nav-text text-light font-size-sm toggle-text d-none">Afficher</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end:: Card header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 d-flex flex-column">
                                        <!--begin::Engage Widget 2-->
                                        <div class="flex-grow-1 bg-primary p-8 rounded-xl flex-grow-1 bgi-no-repeat" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 70%; background-image: url(<?= Yii::$app->request->BaseUrl ?>/media/svg/humans/custom-3.svg)">
                                            <h4 class="text-inverse-danger mt-2 font-weight-bolder">Nombre de demandes en attente</h4>
                                            <p class="display-1 text-success my-6"><?= count($pendingUsers) ?></p>
                                            <a href="<?= Url::to(['site/user']) ?>" class="btn btn-success btn-hover-light font-weight-bold py-2 px-6">Voir tout</a>
                                        </div>
                                        <!--end::Engage Widget 2-->
                                    </div>
                                    <div class="col-lg-10">
                                        <!--begin: Datatable-->
                                        <div class="bg-light p-5 rounded">
                                            <table class="table table-separate table-head-custom table-foot-custom table-checkable" id="datatableUser" data-pageLength="5">
                                                <thead>
                                                    <tr>
                                                        <th width="50">#ID</th>
                                                        <th>Nom complet</th>
                                                        <th>Prénom</th>
                                                        <th>Nom</th>
                                                        <th>Société</th>
                                                        <th>Fonction</th>
                                                        <th>Email</th>
                                                        <th>Tel. fixe</th>
                                                        <th>Mobile</th>
                                                        <th>Centres d'intérêts</th>
                                                        <th>Produits utilisés</th>
                                                        <th>Evénements</th>
                                                        <th>Role</th>
                                                        <th>Statut</th>
                                                        <th>Date de création</th>
                                                        <th>Dernière mise à jour</th>
                                                        <th class="text-center no-export">Actions</th>
                                                    </tr>
                                                    <tr id="column-search">
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($pendingUsers)) {
                                                        foreach ($pendingUsers as $user) {
                                                            if (Yii::$app->user->identity->role >= $user->role && ($user->id != 1 || ($user->id == 1 && Yii::$app->user->id == 1))) {
                                                                $userCompany = Company::findOne($user->company_id);
                                                                $interests = $products = [];
                                                                foreach ($user['modelRelations'] as $modelRelation) {
                                                                    if ($modelRelation->model == 'user' && $modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                                                                        $interests[] = $modelRelation->type_id;
                                                                    if ($modelRelation->model == 'user' && $modelRelation->type == 'option' && $modelRelation->type_name == 'products') {
                                                                        $products[] = $modelRelation->type_id;
                                                                    }
                                                                }
                                                                $eventParticipations = Participant::getMemberParticipation($user->id); ?>

                                                                <tr>
                                                                    <td><?= $user->id ?></td>
                                                                    <td class="h6"><a href="<?= Url::to(['site/edit-user', 'id' => $user->id]) ?>"><strong><?= ucfirst($user->firstname) ?> <?= mb_strtoupper($user->lastname) ?></strong></a></td>
                                                                    <td><?= $user->firstname ?></td>
                                                                    <td><?= $user->lastname ?></td>
                                                                    <td>
                                                                        <?php 
                                                                        if (null !== $userCompany) { ?>
                                                                            <a class="btn-link" href="<?= Url::to(['site/edit-company', 'id' => $userCompany->id]) ?>"><?= strtoupper($userCompany->name) ?></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td><?= $user->function ?></td>
                                                                    <td><?= $user->email ?></td>
                                                                    <td><?= $user->phone ?></td>
                                                                    <td><?= $user->mobile ?></td>
                                                                    <td><?= implode(', ', $interests) ?></td>
                                                                    <td><?= implode(', ', $products) ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if (null !== $eventParticipations) {
                                                                            foreach ($eventParticipations as $participation) {
                                                                                if (isset($participation['event'])) { ?>
                                                                                    <li><a href="<?= Url::to(['site/edit-event', 'id' => $participation['event']->id]) ?>" target="_blank"><?= $participation['event']->title ?></a></li>
                                                                                <?php }
                                                                            }
                                                                        } ?>
                                                                    </td>
                                                                    <td><span class="font-weight-bold text-uppercase"><?= User::getRoles($user->role) ?></span></td>
                                                                    <td><span class="label label-lg font-weight-bold label-light-<?= User::getUserStatusColor($user->status) ?> label-inline"><?= User::getUserStatusName($user->status) ?></span></td>
                                                                    <td data-sort="<?= $user->created_at ?>"><?= utf8_encode(strftime('%e %B %Y', $user->created_at)) ?></td>
                                                                    <td data-sort="<?= $user->updated_at ?>"><?= utf8_encode(strftime('%e %B %Y', $user->updated_at)) ?></td>
                                                                    <td nowrap="nowrap" class="text-center">
                                                                        <a href="<?= Url::to(['site/edit-user', 'id' => $user->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                                            <i class="la la-edit"></i>
                                                                        </a>
                                                                        <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="Supprimer">
                                                                                <i class="la la-trash"></i>
                                                                            </a>
                                                                        </span>
                                                                        <div class="card-toolbar d-inline">
                                                                            <div class="dropdown dropdown-inline" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Statut">
                                                                                <a href="#" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="ki ki-bold-more-ver"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                                    <!--begin::Navigation-->
                                                                                    <ul class="navi navi-hover">
                                                                                        <li class="navi-header pb-1">
                                                                                            <span class="text-primary text-uppercase font-weight-bold font-size-sm">Statut :</span>
                                                                                        </li>
                                                                                        <?php
                                                                                        if ($user->status != 0) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/index', 'target' => 'user', 'id' => $user->id, 'status' => 0]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-cross"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">Refusé</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php }
                                                                                        if ($user->status != 1) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/index', 'target' => 'user', 'id' => $user->id, 'status' => 1]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-time"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">Ex-membre</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php }
                                                                                        if ($user->status != 9) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/index', 'target' => 'user', 'id' => $user->id, 'status' => 9]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-hourglass-1"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">En attente</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php }
                                                                                        if ($user->status != 10) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/index', 'target' => 'user', 'id' => $user->id, 'status' => 10]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-check-mark"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">Actif</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php } ?>
                                                                                    </ul>
                                                                                    <!--end::Navigation-->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            <?php }
                                                        }
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="50">#ID</th>
                                                        <th>Nom complet</th>
                                                        <th>Prénom</th>
                                                        <th>Nom</th>
                                                        <th>Société</th>
                                                        <th>Fonction</th>
                                                        <th>Email</th>
                                                        <th>Tel. fixe</th>
                                                        <th>Mobile</th>
                                                        <th>Centres d'intérêts</th>
                                                        <th>Produits utilisés</th>
                                                        <th>Evénements</th>
                                                        <th>Role</th>
                                                        <th>Statut</th>
                                                        <th>Date de création</th>
                                                        <th>Dernière mise à jour</th>
                                                        <th class="text-center no-export">Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!--end: Datatable-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Card body-->
                        </div>
                        <!--end:: Card-->
                        <!--end:: Charts Widget 5-->
                    </div>
                </div>
                <!--end::Row-->

                <div class="row">

                    <div class="col-xl-12">
                        <!--begin::List Widget 11-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0">
                                <h3 class="card-title font-weight-bolder text-dark">Statistiques</h3>
                                <div class="card-toolbar">
                                    <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link py-2 px-4 bg-primary toggle-pending-users" href="javascript:void(0)">
                                                <span class="nav-text text-light font-size-sm toggle-text">Masquer</span>
                                                <span class="nav-text text-light font-size-sm toggle-text d-none">Afficher</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-9 bg-light-info rounded p-5">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-info mr-5">
                                                <span class="svg-icon svg-icon-xxl">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <a href="<?= Url::to(['site/user']) ?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Utilisateurs actifs</a>
                                                <span class="text-muted font-weight-bold">En attente : <?= count($pendingUsers) ?></span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Lable-->
                                            <a href="<?= Url::to(['site/user']) ?>" class="font-weight-bolder text-info py-1 display-2"><?= $activeUsers ?></a>
                                            <!--end::Lable-->
                                        </div>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-9">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-warning mr-5">
                                                <span class="svg-icon svg-icon-xxl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Home\Building.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"></path>
                                                            <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"></rect>
                                                            <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"></path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <a href="<?= Url::to(['site/company']) ?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Entreprises actives</a>
                                                <span class="text-muted font-weight-bold">En attente : <?= $pendingCompanies ?></span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Lable-->
                                            <a href="<?= Url::to(['site/company']) ?>" class="font-weight-bolder text-warning py-1 font-size-lg display-2"><?= $activeCompanies ?></a>
                                            <!--end::Lable-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <div class="col-lg-6">

                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center bg-light-danger rounded p-5 mb-9">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-danger mr-5">
                                                <span class="svg-icon svg-icon-xxl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Map\Marker2.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <a href="<?= Url::to(['site/event']) ?>" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">Evénements publiés</a>
                                                <span class="text-muted font-weight-bold">Brouillons : <?= $draftEvents ?></span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Lable-->
                                            <a href="<?= Url::to(['site/event']) ?>" class="font-weight-bolder text-danger py-1 font-size-lg display-2"><?= $publishedEvents ?></span>
                                            <!--end::Lable-->
                                        </div>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center bg-primary rounded p-5 mb-9">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-light mr-5">
                                                <span class="svg-icon svg-icon-xxl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Text\Font.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M0.18,19 L7.1,4.64 L14.02,19 L12.06,19 L10.3,15.28 L3.9,15.28 L2.14,19 L0.18,19 Z M7.1,8.52 L4.7,13.6 L9.5,13.6 L7.1,8.52 Z" fill="#000000"/>
                                                            <path d="M21.34,19 L21.34,18 C20.5,18.76 19.38,19.16 18.16,19.16 C15.22,19.16 13.06,16.9 13.06,14 C13.06,11.1 15.22,8.84 18.16,8.84 C19.38,8.84 20.5,9.24 21.34,10 L21.34,9 L23.06,9 L23.06,19 L21.34,19 Z M18.2,17.54 C19.64,17.54 20.76,16.86 21.34,15.92 L21.34,12.08 C20.76,11.14 19.64,10.46 18.2,10.46 C16.24,10.46 14.84,12.02 14.84,14 C14.84,15.98 16.24,17.54 18.2,17.54 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <a href="<?= Url::to(['site/cms']) ?>" class="font-weight-bold text-light text-hover-light font-size-lg mb-1">Pages de contenu publiées</a>
                                                <span class="text-muted font-weight-bold">Brouillons : <?= $draftCms ?></span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Lable-->
                                            <a href="<?= Url::to(['site/cms']) ?>" class="font-weight-bolder text-light py-1 font-size-lg display-2"><?= $publishedCms ?></span>
                                            <!--end::Lable-->
                                        </div>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center bg-light-secondary rounded p-5">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-secondary mr-5">
                                                <span class="svg-icon svg-icon-xxl">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo10\dist/../src/media/svg/icons\Communication\Send.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M3,13.5 L19,12 L3,10.5 L3,3.7732928 C3,3.70255344 3.01501031,3.63261921 3.04403925,3.56811047 C3.15735832,3.3162903 3.45336217,3.20401298 3.70518234,3.31733205 L21.9867539,11.5440392 C22.098181,11.5941815 22.1873901,11.6833905 22.2375323,11.7948177 C22.3508514,12.0466378 22.2385741,12.3426417 21.9867539,12.4559608 L3.70518234,20.6826679 C3.64067359,20.7116969 3.57073936,20.7267072 3.5,20.7267072 C3.22385763,20.7267072 3,20.5028496 3,20.2267072 L3,13.5 Z" fill="#000000"/>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <!--end::Icon-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                                <a href="<?= Url::to(['site/news']) ?>" class="font-weight-bold text-secondary text-hover-primary font-size-lg mb-1">Actualités publiées </a>
                                                <span class="text-muted font-weight-bold">Brouillons : <?= $draftNews ?></span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Lable-->
                                            <a href="<?= Url::to(['site/news']) ?>" class="font-weight-bolder text-secondary py-1 font-size-lg display-2"><?= $publishedNews ?></a>
                                            <!--end::Lable-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 11-->
                    </div>

                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->