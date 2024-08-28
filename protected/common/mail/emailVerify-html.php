<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>

    <table cellpadding="0" cellspacing="0" align="center" class="es-content" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
        <tr>
            <td align="center" style="padding:0;Margin:0">
                <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" class="es-content-body" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                    <tr>
                        <td align="left" style="Margin:0;padding-right:20px;padding-left:20px;padding-top:30px;padding-bottom:30px">
                            <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                <tr>
                                    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px;font-size:0px">
                                                	<img src="https://epurhb.stripocdn.email/content/guids/CABINET_67e080d830d87c17802bd9b4fe1c0912/images/55191618237638326.png" alt="" width="100" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none">
                                                	<!--img src="<?= Url::to('@web/images/mail/email-verify.png', true) ?>" alt="" width="100" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:10px">
                                                    <h1 style="Margin:0;font-family:arial, 'helvetica neue', helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:46px;font-style:normal;font-weight:bold;line-height:46px;color:#333333">Confirmez votre email</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-p0r es-m-p0l" style="Margin:0;padding-top:5px;padding-right:40px;padding-bottom:5px;padding-left:40px">
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Vous recevez ce message car votre adresse e-mail a été enregistrée sur notre site. Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail et confirmer que vous êtes le propriétaire de ce compte. &nbsp;</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:5px">
                                                    <p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Si vous ne vous êtes pas inscrit auprès de nous, veuillez ignorer cet e-mail.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px"><span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#c84b4f;border-width:0px;display:inline-block;border-radius:25px;width:auto"><a href="<?= $verifyLink ?>" target="_blank" class="es-button" style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:20px;padding:10px 30px 10px 30px;display:inline-block;background:#c84b4f;border-radius:25px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:24px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #c84b4f;padding-left:30px;padding-right:30px">Confirmez votre email</a></span></td>
                                            </tr>
                                            <tr>
                                                <td align="center" class="es-m-p0r es-m-p0l es-text-7285" style="Margin:0;padding-top:5px;padding-bottom:5px;padding-right:30px;padding-left:30px">
                                                    <p class="es-text-mobile-size-14" style="Margin:0;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">Une fois confirmé, cet e-mail sera associé de manière unique à votre ​compte.</p>
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

