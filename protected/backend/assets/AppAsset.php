<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/pages/login/login-3.css',
        'plugins/global/plugins.bundle.css',
        'plugins/custom/prismjs/prismjs.bundle.css',
        //'plugins/custom/datatables/datatables.bundle.css',
        'plugins/custom/jstree/jstree.bundle.css',
        'plugins/custom/uppy/uppy.bundle.css',
        'dataTables.css',
        'buttons.dataTables.css',
        'css/style.bundle.css',
        'gfonts.css',

    ];
    public $js = [
        'plugins/global/plugins.bundle.js',
        'plugins/custom/prismjs/prismjs.bundle.js',
        'js/scripts.bundle.js',
        'js/pages/crud/forms/widgets/autosize.js',
        'plugins/custom/uppy/uppy.bundle.js',
        'plugins/custom/uppy/uppy.fr_FR.js',
        'plugins/custom/draggable/draggable.bundle.js',
        'js/pages/features/cards/draggable.js',
        'js/pages/crud/forms/editors/summernote.js',
        'js/pages/crud/forms/editors/summernote-fr-FR.min.js',
        'js/pages/crud/forms/widgets/ion-range-slider.js',
        'plugins/custom/jstree/jstree.bundle.js',
        //'plugins/custom/datatables/datatables.bundle.js',
        'masonry-layout.js',

        'dataTables.js',
        'dataTables.buttons.js',
        'jszip.min.js',
        'buttons.html5.min.js',
        'buttons.colVis.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy'=>true,
    ];
}
