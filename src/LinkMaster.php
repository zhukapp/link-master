<?php
/**
 * Link Master plugin for Craft CMS 3.x
 *
 * Simplify linking in Craft
 *
 * @link      https://zhuk.app
 * @copyright Copyright (c) 2022 Vadim Goncharov
 */

namespace zhukapp\linkmaster;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;
use zhukapp\linkmaster\base\PluginTrait;

/**
 * Class LinkMaster
 *
 * @author    Vadim Goncharov
 * @package   LinkMaster
 * @since     0.0.1
 *
 */
class LinkMaster extends Plugin
{
    // Traits
    // =========================================================================

    use PluginTrait;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::setAlias('@linkMaster', __DIR__);

        $this->_setLogging();

        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function (RegisterComponentTypesEvent $event) {
            $event->types[] = Field::class;
        });


//        Event::on(
//            Plugins::class,
//            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
//            function (PluginEvent $event) {
//                if ($event->plugin === $this) {
//                }
//            }
//        );
//
//        Craft::info(
//            Craft::t(
//                'link-master',
//                '{name} plugin loaded',
//                ['name' => $this->name]
//            ),
//            __METHOD__
//        );
    }

    // Private Methods
    // =========================================================================

}
