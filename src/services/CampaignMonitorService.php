<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-lists
 * @copyright Copyright (c) Clearbold, LLC
 *
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 */

namespace clearbold\cmlists\services;

require_once CRAFT_VENDOR_PATH.'/campaignmonitor/createsend-php/csrest_clients.php';
require_once CRAFT_VENDOR_PATH.'/campaignmonitor/createsend-php/csrest_lists.php';

use clearbold\cmlists\CmLists;

use Craft;
use craft\base\Component;

/**
 * @author    Mark Reeves
 * @since     0.1.1
 */
class CampaignMonitorService extends Component
{
    /**
     * @var settings
     * @todo declare it once
     */

    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function getLists()
    {
        $settings = CmLists::$plugin->getSettings();

        try {
            $auth = array(
                'api_key' => (string)$settings->apiKey);
            $client = new \CS_REST_Clients(
                $settings->clientId,
                $auth);

            $result = $client->get_lists();

            if($result->was_successful()) {
                $body = array();
                foreach ($result->response as $list) {
                    $body[] = $list;
                }
                return [
                    'success' => true,
                    'statusCode' => $result->http_status_code,
                    'body' => $body
                ];
            } else {
                return [
                    'success' => false,
                    'statusCode' => $result->http_status_code,
                    'reason' => $result->response
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'reason' => $e->getMessage()
            ];
        }
    }

    public function getListStats($listId = '')
    {
        $settings = CmLists::$plugin->getSettings();

        try {
            $auth = array(
                'api_key' => (string)$settings->apiKey);
            $client = new \CS_REST_Lists(
                $listId,
                $auth);

            $result = $client->get_stats();

            if($result->was_successful()) {
                return [
                    'success' => true,
                    'statusCode' => $result->http_status_code,
                    'body' => $result->response
                ];
            } else {
                return [
                    'success' => false,
                    'statusCode' => $result->http_status_code,
                    'reason' => $result->response
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'reason' => $e->getMessage()
            ];
        }
    }
}
