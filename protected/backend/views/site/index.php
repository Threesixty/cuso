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
                            </div>
                            <!--end:: Card header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 d-flex flex-column">
                                        <!--begin::Engage Widget 2-->
                                        <div class="flex-grow-1 bg-success p-8 rounded-xl flex-grow-1 bgi-no-repeat" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 70%; background-image: url(<?= Yii::$app->request->BaseUrl ?>/media/svg/humans/custom-3.svg)">
                                            <h4 class="text-inverse-danger mt-2 font-weight-bolder">Nombre de demandes en attente</h4>
                                            <p class="display-1 text-inverse-danger my-6"><?= count($pendingUsers) ?></p>
                                            <a href="<?= Url::to(['site/user']) ?>" class="btn btn-light-success font-weight-bold py-2 px-6">Voir tout</a>
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
                                                                                                <a href="<?= Url::to(['site/user', 'id' => $user->id, 'status' => 0]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-cross"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">Refusé</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php }
                                                                                        if ($user->status != 1) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/user', 'id' => $user->id, 'status' => 1]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-time"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">Ex-membre</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php }
                                                                                        if ($user->status != 9) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/user', 'id' => $user->id, 'status' => 9]) ?>" class="navi-link">
                                                                                                    <span class="navi-icon">
                                                                                                        <i class="flaticon2-hourglass-1"></i>
                                                                                                    </span>
                                                                                                    <span class="navi-text">En attente</span>
                                                                                                </a>
                                                                                            </li>
                                                                                        <?php }
                                                                                        if ($user->status != 10) { ?>
                                                                                            <li class="navi-item">
                                                                                                <a href="<?= Url::to(['site/user', 'id' => $user->id, 'status' => 10]) ?>" class="navi-link">
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
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->