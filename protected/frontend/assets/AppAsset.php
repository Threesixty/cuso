<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'google-fonts.css',
        'jquery-ui.css',
        'css/reset.css',
        'css/style.css',
        'css/datepicker.css',
        'css/swiper.min.css',
        'css/gallery.css',
        'css/faq.css',
        'css/style-dev.css',
    ];
    public $js = [
    	'js/swiper.min.js',
        'js/swiper.js',
        'jquery-ui.js',
        'js/datepicker.js',
        'js/nav-submenu.js',
        'js/isotope.pkgd.min.js',
        'js/imagesloaded.pkgd.min.js',
        'js/gallery.js',
        'js/faq.js',
        'js/jquery.matchHeight-min.js',
    	'js/parsley.min.js',
    	'js/parsley.fr.js',
    	'js/parsley.de.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
