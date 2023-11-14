<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des options', '', true);

#MainHelper::pp($cmsList);
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
                                <h3 class="card-title text-uppercase">Liste des options</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableOption">
                                    <thead>
                                        <tr>
                                            <th width="50">#ID</th>
                                            <th>Titre</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Date de création</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($optionList)) {
                                            foreach ($optionList as $option) { ?>

                                                <tr>
                                                    <td><?= $option->id ?></td>
                                                    <?php
                                                    if ($option->description == 'SPECIAL') { ?>
                                                        <td>
                                                            <span class="text-dark-50"><?= $option->title ?></i>
                                                        </td>
                                                        <td><code class="d-inline-block"><?= $option->name ?></code></td>
                                                        <td><span class="label label-lg font-weight-bold label-light-primary label-inline"><?= $option->description ?></span></td>
                                                        <td data-order="<?= $option->created_at ?>"><?= utf8_encode(strftime('%e %B %Y' , $option->created_at)) ?></td>
                                                        <td nowrap="nowrap" class="text-center"></td>
                                                    <?php } else { ?>
                                                        <td class="h6">
                                                            <a href="<?= Url::to(['site/edit-option', 'id' => $option->id]) ?>"><strong><?= $option->title ?></strong></a>
                                                        </td>
                                                        <td><code class="d-inline-block"><?= $option->name ?></code></td>
                                                        <td><?= $option->description ?></td>
                                                        <td data-order="<?= $option->created_at ?>"><?= utf8_encode(strftime('%e %B %Y' , $option->created_at)) ?></td>
                                                        <td nowrap="nowrap" class="text-center">
                                                            <a href="<?= Url::to(['site/edit-option', 'id' => $option->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                                <i class="la la-edit"></i>
                                                            </a>
                                                            <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Supprimer">
                                                                    <i class="la la-trash"></i>
                                                                </a>
                                                            </span>
                                                        </td>
                                                    <?php } ?>
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