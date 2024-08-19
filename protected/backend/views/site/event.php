<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\User;
use common\models\Company;
use common\models\Option;
use common\models\Update;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des événements', '', true);

#MainHelper::pp($eventList);
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
                                <h3 class="card-title text-uppercase">Liste des événements</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableEvent">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Titre</th>
                                            <th>Date de l'événement</th>
                                            <th>Nombre d'inscrits</th>
                                            <th>Présentiel</th>
                                            <th>Distanciel </th>
                                            <th>Ouvert aux prospects</th>
                                            <th>Ouvert à l'inscription</th>
                                            <th>Sujets abordés</th>
                                            <th>Produits concernés</th>
                                            <th>Intervenants</th>
                                            <th>Statut</th>
                                            <th>Date de création</th>
                                            <th>Dernière mise à jour</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($eventList)) {
                                            foreach ($eventList as $event) {
                                                $registeredParticipants = array_filter($event['participant'], function ($participant) {
                                                    return $participant->registered == 1;
                                                });
                                                $interests = $products = $speakers = [];
                                                foreach ($event['modelRelations'] as $modelRelation) {
                                                    if ($modelRelation->model == 'event' && $modelRelation->type == 'option' && $modelRelation->type_name == 'interests')
                                                        $interests[] = $modelRelation->type_id;
                                                    if ($modelRelation->model == 'event' && $modelRelation->type == 'option' && $modelRelation->type_name == 'products') {
                                                        $products[] = $modelRelation->type_id;
                                                    }
                                                    if ($modelRelation->model == 'event' && $modelRelation->type == 'speakers') {
                                                        $currentSpeaker = User::findOne($modelRelation->type_id);
                                                        $speakerCompany = Company::getUserCompanyName($currentSpeaker->company_id);
                                                        $speakerCompanyName = null !== $speakerCompany ? $speakerCompany : '';
                                                        $speakers[] = '<strong>'.$currentSpeaker->firstname.' '.$currentSpeaker->lastname.'</strong> ('.$speakerCompanyName.')';
                                                    }
                                                }
                                                $lastUpdate = Update::getLastUpdate('event', $event->id); ?>

                                                <tr>
                                                    <td><?= $event->id ?></td>
                                                    <td class="h6"><a href="<?= Url::to(['site/edit-event', 'id' => $event->id]) ?>"><strong><?= $event->title ?></strong></a></td>
                                                    <td data-sort="<?= $event['event']->start_datetime ?>">
                                                        <strong class="d-block text-nowrap"><?= MainHelper::getPrettyEventDate($event['event']->start_datetime, $event['event']->end_datetime, false, 'date') ?></strong>
                                                        <span class="text-nowrap"><?= MainHelper::getPrettyEventDate($event['event']->start_datetime, $event['event']->end_datetime, false, 'time') ?></span>
                                                    </td>
                                                    <td><?= count($registeredParticipants) ?></td>
                                                    <td><?= $event['event']->presential ? 'Oui' : 'Non' ?></td>
                                                    <td><?= $event['event']->distance ? 'Oui' : 'Non' ?></td>
                                                    <td><?= $event['event']->prospect ? 'Oui' : 'Non' ?></td>
                                                    <td><?= $event['event']->registerable ? 'Oui' : 'Non' ?></td>
                                                    <td><?= implode(', ', $interests) ?></td>
                                                    <td><?= implode(', ', $products) ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($speakers as $speaker) { ?>
                                                             <li><?= $speaker ?></li>
                                                        <?php } ?>
                                                    </td>
                                                    <td><span class="label label-xl font-weight-bold label-light-<?= $event->status ? 'success' : 'gray' ?> label-inline"><?= $event->status ? 'Publié' : 'Dépublié' ?></span></td>
                                                    <td data-sort="<?= $event->created_at ?>"><?= utf8_encode(strftime('%e %B %Y', $event->created_at)) ?></td>
                                                    <td data-sort="<?= null !== $lastUpdate ? $lastUpdate->date : $event->created_at ?>"><?= null !== $lastUpdate ? utf8_encode(strftime('%e %B %Y', $lastUpdate->date)) : utf8_encode(strftime('%e %B %Y', $event->created_at)) ?></td>
                                                    <td nowrap="nowrap" class="text-center">
                                                        <a href="<?= Url::to(['site/edit-event', 'id' => $event->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                        <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="Supprimer">
                                                                <i class="la la-trash"></i>
                                                            </a>
                                                        </span>
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon <?= $event->status ? 'add-to-menu' : '' ?>" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?= $event->status ? 'Ajouter au menu' : 'Pour ajouter ce contenu aux menus, ce dernier doit être publié' ?>" <?= $event->status ? '' : ' data-theme="dark"' ?>>
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