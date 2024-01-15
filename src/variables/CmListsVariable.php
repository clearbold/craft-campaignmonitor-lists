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
use Craft;
/**
 * @author    Mark Reeves
 * @since     0.1.1
 */
class CmListsVariable
{
    // Public Methods
    // =========================================================================
    public function getLists(): array
    {
        return CmLists::getInstance()->campaignmonitor->getLists();
    }

    public function getListStats($listId = ''): array
    {
        return CmLists::getInstance()->campaignmonitor->getListStats($listId);
    }

    public function getList($listId = ''): array
    {
        return CmLists::getInstance()->campaignmonitor->getList($listId);
    }

    public function getActiveSubscribers($listId = ''): array
    {
        return CmLists::getInstance()->campaignmonitor->getActiveSubscribers($listId);
    }

    public function getListsForEmail($email): array
    {
        return CmLists::getInstance()->campaignmonitor->getListsForEmail($email);
    }
}
