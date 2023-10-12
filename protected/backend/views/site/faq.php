<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Hotel;
use common\models\Option;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des questions', '', true);

#MainHelper::pp($faqList);
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
                                <h3 class="card-title text-uppercase">Liste des questions</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableContent">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Question</th>
                                            <th>Hôtel</th>
                                            <th>Catégorie</th>
                                            <th>Dates de création</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($faqList)) {
                                            foreach ($faqList as $faq) {
                                                $hotelList = [];
                                                $hotels = JSON::decode($faq->hotel);
                                                if (null !== $hotels) {
                                                    foreach ($hotels as $hotelId) {
                                                        if ($hotelId == 'general') {
                                                            $hotelList[] = 'Générique';
                                                        } else {
                                                            $hotel = Hotel::getHotelBO($hotelId);
                                                            $hotelList[] = $hotel->name;
                                                        }
                                                    }
                                                } ?>

                                                <tr>
                                                    <td><?= $faq->id ?></td>
                                                    <td class="h6"><a href="<?= Url::to(['site/edit-faq', 'id' => $faq->id]) ?>"><strong><?= $faq->title ?></strong></a></td>
                                                    <td><?= implode(', ', $hotelList) ?></td>
                                                    <td><?= Option::getOptionLabel('faq-categories', JSON::decode($faq->category)) ?></td>
                                                    <td data-order="<?= $faq->created_at ?>"><?= utf8_encode(strftime('%e %B %Y' , $faq->created_at)) ?></td>
                                                    <td><span class="label label-xl font-weight-bold label-light-<?= $faq->status ? 'success' : 'danger' ?> label-inline"><?= $faq->status ? 'Publié' : 'Dépublié' ?></span></td>
                                                    <td nowrap="nowrap" class="text-center">
                                                        <a href="<?= Url::to(['site/edit-faq', 'id' => $faq->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                        <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="Supprimer">
                                                                <i class="la la-trash"></i>
                                                            </a>
                                                        </span>
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon <?= $faq->status ? 'add-to-menu' : '' ?>" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?= $faq->status ? 'Ajouter au menu' : 'Pour ajouter ce contenu aux menus, ce dernier doit être publié' ?>" <?= $faq->status ? '' : ' data-theme="dark"' ?>>
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