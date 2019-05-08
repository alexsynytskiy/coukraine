<?php
namespace app\assets;

class AppAsset extends \yii\web\AssetBundle
{
    /**
     * @var string
     */
    protected static $pathToImages;

    public $sourcePath = '@app/media';

    public $css = [
        'css/bootstrap.min.css',
        'style.css',
        'css/responsive.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'plugins/rs-plugin/css/extralayers.css',
        'plugins/rs-plugin/css/settings.css',
        'plugins/lightbox-master/dist/ekko-lightbox.css',
        'plugins/animate/animate.css',
        'plugins/isotope-portfolio/css/isotope.css',
        'plugins/isotope-portfolio/css/jquery.fancybox.css',
        'plugins/unitegallery-master/package/unitegallery/css/unite-gallery.css',
        'plugins/isotope-portfolio/css/jquery.fancybox.css',
        'plugins/pnotify/pnotify.min.css',
        'css/custom.css?version=6',
    ];

    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/smooth-scroll.min.js',
        'plugins/unitegallery-master/package/unitegallery/js/unitegallery.min.js',
        'plugins/unitegallery-master/package/unitegallery/themes/compact/ug-theme-compact.js',
        'js/wow.min.js',
        'js/jquery.inview.js',
        'plugins/rs-plugin/js/jquery.themepunch.tools.min.js',
        'plugins/rs-plugin/js/jquery.themepunch.revolution.min.js',
        'plugins/lightbox-master/dist/ekko-lightbox.js',
        'plugins/parallax/js/jquery.easing.1.3.js',
        'plugins/parallax/js/jquery.parallax-scroll.js',
        'plugins/counterup/jquery.counterup.min.js',
        'plugins/counterup/waypoints.min.js',
        'plugins/isotope-portfolio/js/isotope.min.js',
        'plugins/isotope-portfolio/js/isotope-main.js',
        'plugins/isotope-portfolio/js/jquery.fancybox.pack.js',
        'plugins/pnotify/pnotify.min.js',
        'js/SiteCore.js?version=2',
        'js/NewsPage.js',
        'js/main.js',
    ];


    public $publishOptions = [
        'forceCopy' => true
    ];
}