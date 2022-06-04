<?php

namespace zhukapp\linkmaster\assets;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use craft\web\View;

class LinkMasterAsset extends AssetBundle
{
    public $depends = [
        CpAsset::class,
    ];

    public $sourcePath = __DIR__ . '/dist';

    public $css = [
        'css/LinkMaster.css',
    ];

    public $js = [
        'js/LinkMaster.js'
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);

        if ($view instanceof View) {
            $view->registerTranslations('link-master', [
                'Link',
                'External Link',
                'Link to an entry',
            ]);
        }
    }
}