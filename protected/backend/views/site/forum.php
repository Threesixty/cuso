<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Option;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des discussions', '', true);

#MainHelper::pp($forumList);
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
                                <h3 class="card-title text-uppercase">Liste des discussions</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableForum">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Titre</th>
                                            <th>Produits</th>
                                            <th>Centres d'intérêts</th>
                                            <th>Statut</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($forumList)) {
                                            foreach ($forumList as $forum) { ?>

                                                <tr>
                                                    <td><?= $forum->id ?></td>
                                                    <td class="h6"><a href="<?= Url::to(['site/edit-forum', 'id' => $forum->id]) ?>"><strong><?= $forum->title ?></strong></a></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><span class="label label-xl font-weight-bold label-light-<?= $forum->status ? 'success' : 'gray' ?> label-inline"><?= $forum->status ? 'Publié' : 'Dépublié' ?></span></td>
                                                    <td nowrap="nowrap" class="text-center">
                                                        <a href="<?= Url::to(['site/edit-forum', 'id' => $forum->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                        <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="Supprimer">
                                                                <i class="la la-trash"></i>
                                                            </a>
                                                        </span>
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