<?php
use yii\helpers\Url;
use common\models\User;
use common\models\Company;
use common\models\Participant;

    if (!empty($eventParticipantList)) {
        foreach ($eventParticipantList as $participant) {
            $userParticipant = User::findOne($participant->user_id);
            $participantCompany = Company::findOne($userParticipant->company_id);
            $registrationDate = null !== $participant->updated_at && $participant->updated_at > $participant->created_at ? $participant->updated_at : $participant->created_at ?>

            <tr>
                <td><?= $participant->id ?></td>
                <td class="h6"><a href="<?= Url::to(['site/edit-user', 'id' => $userParticipant->id]) ?>"><strong class="text-nowrap"><?= ucfirst($userParticipant->firstname) ?> <?= mb_strtoupper($userParticipant->lastname) ?></strong></a></td>
                <td>
                    <?php 
                    if (null !== $participantCompany) { ?>
                        <a class="btn-link" href="<?= Url::to(['site/edit-company', 'id' => $participantCompany->id]) ?>"><?= strtoupper($participantCompany->name) ?></a>
                    <?php } ?>
                </td>
                <td>
                    <span class="label label-lg font-weight-bold label-light-<?= Participant::getRegisterStatusColor($participant->registered) ?> label-inline"><?= Participant::getRegisterStatusName($participant->registered) ?></span>
                </td>
                <td data-sort="<?= $registrationDate ?>"><strong><?= date('d/m/Y', $registrationDate) ?></strong><br><?= date('H:i', $registrationDate) ?></td>
                <td>
                    <span class="label label-lg font-weight-bold label-light-<?= Participant::getCameStatusColor($participant->came) ?> label-inline"><?= Participant::getCameStatusName($participant->came) ?></span>
                </td>
                <td nowrap="nowrap" class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon participant-action new-row" data-toggle="tooltip" data-placement="left" data-container="body" data-boundary="window" title="<?= $participant->registered ? "Désinscrire" : "Inscrire" ?>" data-action="register">
                        <i class="la la-<?= $participant->registered ? 'minus-circle' : 'plus-circle' ?>"></i>
                    </a>
                    <?php
                    if (null === $participant->came || !$participant->came) { ?>
                        <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon participant-action new-row" data-toggle="tooltip" data-placement="bottom" data-container="body" data-boundary="window" title="A participé" data-action="came">
                            <i class="la la-user-check"></i>
                        </a>
                    <?php }
                    if (null === $participant->came || $participant->came) { ?>
                        <a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon participant-action new-row" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="Absent" data-action="notcame">
                            <i class="la la-user-alt-slash"></i>
                        </a>
                    <?php } ?>
                </td>
            </tr>

        <?php }
    } ?>