<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Json;
use common\models\Option;
use backend\widgets\PopinWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle('Liste des actualités', '', true);

#MainHelper::pp($newsList);
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
                                <h3 class="card-title text-uppercase">Liste des actualités</h3>
                            </div>

                            <div class="card-body">
                                <!--begin: Datatable-->
                                <table class="table table-separate table-head-custom table-checkable" id="datatableNews">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Titre</th>
                                            <th>Étiquettes</th>
                                            <th>Dates de publication</th>
                                            <th>Statut</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($newsList)) {
                                            foreach ($newsList as $news) { ?>

                                                <tr>
                                                    <td><?= $news->id ?></td>
                                                    <td class="h6"><a href="<?= Url::to(['site/edit-news', 'id' => $news->id]) ?>"><strong><?= $news->title ?></strong></a></td>
                                                    <td><?= Option::getOptionLabel('news-tags', JSON::decode($news->tags)) ?></td>
                                                    <td data-sort="<?= $news->start_date ?>">
                                                        <?= 0 !== $news->end_date ? 'Du' : '' ?> <?= utf8_encode(strftime('%e %B %Y', $news->start_date)) ?>
                                                        <?= 0 !== $news->end_date ? '<br>au '.utf8_encode(strftime('%e %B %Y', $news->end_date)) : '' ?></td>
                                                    <td><span class="label label-xl font-weight-bold label-light-<?= $news->status ? 'success' : 'gray' ?> label-inline"><?= $news->status ? 'Publié' : 'Dépublié' ?></span></td>
                                                    <td nowrap="nowrap" class="text-center">
                                                        <a href="<?= Url::to(['site/edit-news', 'id' => $news->id]) ?>" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="Modifier">
                                                            <i class="la la-edit"></i>
                                                        </a>
                                                        <span class="list-delete" data-toggle="modal" data-target="#deleteModal">
                                                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="Supprimer">
                                                                <i class="la la-trash"></i>
                                                            </a>
                                                        </span>
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon <?= $news->status ? 'add-to-menu' : '' ?>" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="<?= $news->status ? 'Ajouter au menu' : 'Pour ajouter ce contenu aux menus, ce dernier doit être publié' ?>" <?= $news->status ? '' : ' data-theme="dark"' ?>>
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