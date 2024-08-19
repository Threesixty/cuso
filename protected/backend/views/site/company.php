<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Company;
use common\models\Option;
use common\models\Update;
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
                                            <th>Adresse</th>
                                            <th>Secteur d'activité</th>
                                            <th>Taille</th>
                                            <th>Secteur public</th>
                                            <th>Sponsor</th>
                                            <th>Contact principal</th>
                                            <th>&#8227 Email</th>
                                            <th>&#8227 Téléphone</th>
                                            <th>Contact facturation</th>
                                            <th>&#8227 Email</th>
                                            <th>&#8227 Téléphone</th>
                                            <th>Plateforme facturation</th>
                                            <th>Nombre de licences</th>
                                            <th>Fin d'adhésion</th>
                                            <th>Statut</th>
                                            <th>Date de création</th>
                                            <th>Dernière mise à jour</th>
                                            <th class="text-center no-export">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($companyList)) {
                                            foreach ($companyList as $company) {
                                                $lastUpdate = Update::getLastUpdate('company', $company->id); ?>

                                                <tr>
                                                    <td><?= $company->id ?></td>
                                                    <td class="h6"><a href="<?= Url::to(['site/edit-company', 'id' => $company->id]) ?>"><strong><?= $company->name ?></strong></a></td>
                                                    <td class="list-type-none">
                                                        <li><?= $company->address_line1 ?></li>
                                                        <li><?= $company->address_line2 != '' ? $company->address_line2 : '' ?></li>
                                                        <li><?= $company->postal_code ?> <?= $company->city ?></li>
                                                    </td>
                                                    <td><?= $company->activity_area ?></td>
                                                    <td><?= $company->size ?></td>
                                                    <td><?= $company->public ? 'Oui' : 'Non' ?></td>
                                                    <td><?= $company->is_sponsor ? 'Oui' : 'Non' ?></td>
                                                    <td><?= $company->main_contact_name ?></td>
                                                    <td><?= $company->main_contact_email ?></td>
                                                    <td><?= $company->main_contact_phone ?></td>
                                                    <td><?= $company->billing_contact_name ?></td>
                                                    <td><?= $company->billing_contact_email ?></td>
                                                    <td><?= $company->billing_contact_phone ?></td>
                                                    <td><?= $company->billing_platform ?></td>
                                                    <td><?= $company->licenses_count ?></td>
                                                    <td data-sort="<?= $company->membership_end ?>"><?= utf8_encode(strftime('%e %B %Y', $company->membership_end)) ?></td>
                                                    <td><span class="label label-xl font-weight-bold label-light-<?= Company::getCompanyStatusColor($company->status) ?> label-inline"><?= Company::getCompanyStatusName($company->status) ?></span></td>
                                                    <td data-sort="<?= $company->created_at ?>"><?= utf8_encode(strftime('%e %B %Y', $company->created_at)) ?></td>
                                                    <td data-sort="<?= null !== $lastUpdate ? $lastUpdate->date : $company->created_at ?>"><?= null !== $lastUpdate ? utf8_encode(strftime('%e %B %Y', $lastUpdate->date)) : utf8_encode(strftime('%e %B %Y', $company->created_at)) ?></td>
                                                    <td nowrap="nowrap" class="text-center">
                                                        <a href="<?= Url::to(['site/edit-company', 'id' => $company->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
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
                                                                        if ($company->status != 0) { ?>
                                                                            <li class="navi-item">
                                                                                <a href="<?= Url::to(['site/company', 'id' => $company->id, 'status' => 0]) ?>" class="navi-link">
                                                                                    <span class="navi-icon">
                                                                                        <i class="flaticon2-cross"></i>
                                                                                    </span>
                                                                                    <span class="navi-text">Refuser</span>
                                                                                </a>
                                                                            </li>
                                                                        <?php }
                                                                        if ($company->status != 1) { ?>
                                                                            <li class="navi-item">
                                                                                <a href="<?= Url::to(['site/company', 'id' => $company->id, 'status' => 1]) ?>" class="navi-link">
                                                                                    <span class="navi-icon">
                                                                                        <i class="flaticon2-hourglass-1"></i>
                                                                                    </span>
                                                                                    <span class="navi-text">En attente</span>
                                                                                </a>
                                                                            </li>
                                                                        <?php }
                                                                        if ($company->status != 2) { ?>
                                                                            <li class="navi-item">
                                                                                <a href="<?= Url::to(['site/company', 'id' => $company->id, 'status' => 2]) ?>" class="navi-link">
                                                                                    <span class="navi-icon">
                                                                                        <i class="flaticon2-time"></i>
                                                                                    </span>
                                                                                    <span class="navi-text">Ex-adhérente</span>
                                                                                </a>
                                                                            </li>
                                                                        <?php }
                                                                        if ($company->status != 3) { ?>
                                                                            <li class="navi-item">
                                                                                <a href="<?= Url::to(['site/company', 'id' => $company->id, 'status' => 3]) ?>" class="navi-link">
                                                                                    <span class="navi-icon">
                                                                                        <i class="flaticon2-check-mark"></i>
                                                                                    </span>
                                                                                    <span class="navi-text">Active</span>
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