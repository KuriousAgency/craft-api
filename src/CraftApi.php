<?php
/**
 * Craft API plugin for Craft CMS 3.x
 *
 * An api for craft.
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2018 Kurious Agency
 */

namespace kuriousagency\craftapi;

use kuriousagency\craftapi\services\Api as ApiService;
use kuriousagency\craftapi\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Class CraftApi
 *
 * @author    Kurious Agency
 * @package   CraftApi
 * @since     1.0.0
 *
 * @property  Api $craftApiService
 */
class CraftApi extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var CraftApi
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		self::$plugin = $this;
		
		$this->setComponents([
            'api' => ApiService::class,
        ]);

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
				//'<controller:(post|comment)>/<id:\d+>/<action:(update|delete)>' => '<controller>/<action>',
				//'PUT,POST post/<id:\d+>' => 'post/update',
				//send everything that starts with api to the controller
				$event->rules['api/<url:[a-zA-Z0-9-/.]+>'] = 'craft-api/api';
            }
        );

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'craft-api',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'craft-api/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
