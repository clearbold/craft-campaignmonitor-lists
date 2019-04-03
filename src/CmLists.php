<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-lists
 * @copyright Copyright (c) Clearbold, LLC
 */

namespace clearbold\cmlists;

use clearbold\cmservice\services\CampaignMonitorService;
use clearbold\cmlists\variables\CmListsVariable;

use Craft;
use craft\base\Plugin;
use craft\web\UrlManager;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;
use yii\base\Event;

/**
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 0.1.0
 */
class CmLists extends Plugin
{
    public $hasCpSection = true;
    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'campaignmonitor' => \clearbold\cmservice\services\CampaignMonitorService::class,
            'cmList' =>  \clearbold\cmlists\services\ListService::class
        ]);

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['cm-lists/<listId>'] = ['template' => 'cm-lists/lists/details'];
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('cmLists', CmListsVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'cm-lists',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
