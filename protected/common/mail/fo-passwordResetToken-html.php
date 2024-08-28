<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Cms;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetPasswordPage = Cms::getCmsByTemplate('resetPassword', null, true);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/content', 'url' => $resetPasswordPage->url, 'token' => $user->password_reset_token]);
?>

    <table cellpadding="0" cellspacing="0" align="center" class="es-content" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
        <tr>
            <td align="center" style="padding:0;Margin:0">
                <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" class="es-content-body" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                        <td align="left" style="padding:0;Margin:0;padding-top:15px;padding-right:20px;padding-left:20px">
                            <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr>
                                    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px;font-size:0px">
                                                	<img src="https://foujnwn.stripocdn.email/content/guids/CABINET_91d375bbb7ce4a7f7b848a611a0368a7/images/69901618385469411.png" alt="" width="100" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                	<!--img src="<?= Url::to('@web/images/mail/reset-password.png', true) ?>" alt="" width="100" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-p0r es-m-p0l es-m-txt-c" style="Margin:0;padding-top:15px;padding-right:40px;padding-bottom:15px;padding-left:40px">
                                                    <h1 style="Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:46px;font-style:normal;font-weight:bold;line-height:55.2px;color:#333333">Réinitialiser&nbsp;</h1>
                                                    <h1 style="Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:46px;font-style:normal;font-weight:bold;line-height:55.2px;color:#333333">mon mot de passe</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding:0;Margin:0;padding-top:10px">
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Bonjour <?= Html::encode($user->firstname) ?> <?= Html::encode($user->lastname) ?>,</p>
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Nous avons bien reçu votre demande de changement de mot de passe. Pour &nbsp;procéder à la modification, veuillez cliquer sur le lien ci-dessous :</p>
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">​</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-bottom:20px">
                            <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr>
                                    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:5px" role="presentation">
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px"><span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#c84b4f;border-width:0px;display:inline-block;border-radius:25px;width:auto"><a href="<?= $resetLink ?>" target="_blank" class="es-button" style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;padding:10px 30px 10px 30px;display:inline-block;background:#c84b4f;border-radius:25px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #c84b4f;border-left-width:30px;border-right-width:30px">Réinitialiser mon mot de passe</a></span></td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-top:10px">
                                                    <h3 style="Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:30px;color:#333333">Ce lien est à usage unique et valide 1 heure.</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px">
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet e-mail&nbsp;</p>
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">ou nous contacter à l'adresse <a target="_blank" href="mailto:evenements@clubgenesys.org" style="mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px;line-height:21px"><strong> </strong></a><strong><a href="mailto:evenements@clubgenesys.org" target="_blank" style="mso-line-height-rule:exactly;text-decoration:underline;color:#5C68E2;font-size:14px">evenements@clubgenesys.org</a></strong>.</p>
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">​</p>
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">​</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
