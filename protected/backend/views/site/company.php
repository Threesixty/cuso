<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Option;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des sociétés', '', true);

#MainHelper::pp($companyList);
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
                                <h3 class="card-title text-uppercase">Liste des sociétés</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableCompany">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nom</th>
                                            <th>Contact principal</th>
                                            <th>Nombre de licences</th>
                                            <th>Fin d'adhésion</th>
                                            <th>Statut</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($companyList)) {
                                            foreach ($companyList as $company) { ?>

                                                <tr>
                                                    <td><?= $company->id ?></td>
                                                    <td class="h6"><a href="<?= Url::to(['site/edit-company', 'id' => $company->id]) ?>"><strong><?= $company->name ?></strong></a></td>
                                                    <td><?= $company->main_contact_name ?></td>
                                                    <td><?= $company->licenses_count ?></td>
                                                    <td data-sort="<?= $company->membership_end ?>"><?= utf8_encode(strftime('%e %B %Y', $company->membership_end)) ?></td>
                                                    <td><span class="label label-xl font-weight-bold label-light-<?= $company->status ? 'success' : 'gray' ?> label-inline"><?= $company->status ? 'Publié' : 'Dépublié' ?></span></td>
                                                    <td nowrap="nowrap" class="text-center">
                                                        <a href="<?= Url::to(['site/edit-company', 'id' => $company->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                        <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="Supprimer">
                                                                <i class="la la-trash"></i>
                                                            </a>
                                                        </span>
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon <?= $company->status ? 'add-to-menu' : '' ?>" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?= $company->status ? 'Ajouter au menu' : 'Pour ajouter ce contenu aux menus, ce dernier doit être publié' ?>" <?= $company->status ? '' : ' data-theme="dark"' ?>>
                                                            <i class="la la-plus"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            <?php }
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