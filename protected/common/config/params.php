<?php
setlocale(LC_ALL, ["fr_FR.utf8", "fr_FR@euro", "fr_UTF8", "fr_FR", "french"]);

Yii::setAlias('@uploadFolder', realpath(dirname(__FILE__).'/../../../medias'));
Yii::setAlias('@uploadWeb', '/cuso/medias');
#Yii::setAlias('@uploadWeb', '/medias');

return [
    'adminEmail' => 'michael.convergence@gmail.com',
    'supportEmail' => 'michael.convergence@gmail.com',
    'senderEmail' => 'contact@clubsutilisateuroracle.org',
    'senderName' => 'Clubs Utilisateurs Oracle',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
];
