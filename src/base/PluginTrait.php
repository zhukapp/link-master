<?php
/**
 * Link Master plugin for Craft CMS 3.x
 *
 * Simplify linking in Craft
 *
 * @link      https://zhuk.app
 * @copyright Copyright (c) 2022 Vadim Goncharov
 */

namespace zhukapp\linkmaster\base;

use Craft;
use craft\web\Application;
use yii\log\FileTarget;
use yii\log\Logger;
use zhukapp\linkmaster\LinkMaster;

trait PluginTrait
{
    // Static Properties
    // =========================================================================

    /**
     * @var LinkMaster
     */
    public static LinkMaster $plugin;

    // Public Properties
    // =========================================================================


    /**
     * @var bool
     */
    public bool $hasCpSettings = false;

    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    // Public Properties
    // =========================================================================

    public function log($message)
    {
        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'link-master');
    }

    public function error($message)
    {
        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'link-master');
    }

    // Private Properties
    // =========================================================================

    private function _setLogging()
    {
        $pluginHandle = 'link-master';

        Craft::$app->on(Application::EVENT_INIT, function() use ($pluginHandle) {
            $hasFileLogging = false;

            foreach (Craft::$app->getLog()->targets as $target) {
                if ($target instanceof FileTarget) {
                    $hasFileLogging = true;

                    break;
                }
            }

            if ($hasFileLogging) {
                Craft::getLogger()->dispatcher->targets[] = new FileTarget([
                    'logFile' => Craft::getAlias('@storage/logs/' . $pluginHandle . '.log'),
                    'categories' => [$pluginHandle],
                    'logVars' => [
                        '_GET',
                        '_POST',
                    ]
                ]);
            }
        });
    }


}