<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-lists
 * @copyright Copyright (c) Clearbold, LLC
 *
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 */

namespace clearbold\cmlists\variables;
use clearbold\cmlists\CmLists;
use clearbold\cmlists\services\HttpService;
use Craft;
use craft\helpers\UrlHelper;
/**
 * @author    Mark Reeves
 * @since     0.1.1
 */
class CmListsVariable
{
    // Public Methods
    // =========================================================================
    public function getLists($params = [])
    {
        return CmLists::getInstance()->campaignmonitor->getLists();
    }
}
