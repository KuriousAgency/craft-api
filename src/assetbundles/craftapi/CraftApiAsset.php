<?php
/**
 * Craft API plugin for Craft CMS 3.x
 *
 * An api for craft.
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2018 Kurious Agency
 */

namespace kuriousagency\craftapi\assetbundles\CraftApi;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Kurious Agency
 * @package   CraftApi
 * @since     1.0.0
 */
class CraftApiAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@kuriousagency/craftapi/assetbundles/craftapi/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/CraftApi.js',
        ];

        $this->css = [
            'css/CraftApi.css',
        ];

        parent::init();
    }
}
