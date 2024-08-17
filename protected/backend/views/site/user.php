<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\User;
use common\models\Company;
use common\models\Option;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des utilisateurs', '', true);

#MainHelper::pp($userList);
?>

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header pl-5">
                                <h3 class="card-title text-uppercase">Liste des utilisateurs</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableUser">
                                    <thead>
                                        <tr>
                                            <th width="50">#ID</th>
                                            <th>Nom</th>
                                            <th>Société</th>
                                            <th>Role</th>
                                            <th>Statut</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($userList)) {
                                            foreach ($userList as $user) {
                                                if (Yii::$app->user->identity->role >= $user->role && ($user->id != 1 || ($user->id == 1 && Yii::$app->user->id == 1))) {
                                                    $userCompany = Company::findOne($user->company_id); ?>

                                                    <tr>
                                                        <td><?= $user->id ?></td>
                                                        <td class="h6"><a href="<?= Url::to(['site/edit-user', 'id' => $user->id]) ?>"><strong><?= ucfirst($user->firstname) ?> <?= mb_strtoupper($user->lastname) ?></strong></a></td>
                                                        <td>
                                                            <?php 
                                                            if (null !== $userCompany) { ?>
                                                                <a class="btn-link" href="<?= Url::to(['site/edit-company', 'id' => $userCompany->id]) ?>"><?= strtoupper($userCompany->name) ?></a>
                                                            <?php } ?>
                                                        </td>
                                                        <td><span class="font-weight-bold text-uppercase"><?= User::getRoles($user->role) ?></span></td>
                                                        <td><span class="label label-lg font-weight-bold label-light-<?= User::getUserStatusColor($user->status) ?> label-inline"><?= User::getUserStatusName($user->status) ?></span></td>
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
                                                                                            <i class="flaticon2-hourglass-1"></i>
                                                                                        </span>
                                                                                        <span class="navi-text">Ex-membre</span>
                                                                                    </a>
                                                                                </li>
                                                                            <?php }
                                                                            if ($user->status != 9) { ?>
                                                                                <li class="navi-item">
                                                                                    <a href="<?= Url::to(['site/user', 'id' => $user->id, 'status' => 9]) ?>" class="navi-link">
                                                                                        <span class="navi-icon">
                                                                                            <i class="flaticon2-check-mark"></i>
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
                                </table>
                                <!--end: Datatable-->

                                <?= PopinWidget::widget(['name' => 'delete-item', 'type' => 'list']) ?>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->