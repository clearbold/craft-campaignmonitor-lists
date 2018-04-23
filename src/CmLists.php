<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-transactional
 * @copyright Copyright (c) Clearbold, LLC
 */

namespace clearbold\cmlists;

use clearbold\cmlists\CmTransactionalAdapter;

use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\helpers\MailerHelper;
use yii\base\Event;

/**
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0
 */
class CmLists extends Plugin
{
    public $hasCpSection = true;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
    }
}
