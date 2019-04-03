<?php
/**
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.1.5
 */

namespace clearbold\cmlists\services;

use clearbold\cmlists\CmLists;

use Craft;
use craft\base\Component;
use yii\base\Event;

/**
 * ListService
 */
class ListService extends Component
{
    // Public Methods
    // =========================================================================
    /*
     * @return mixed
     */
    public function subscribe(string $listId, string $redirect, string $email, string $fullName, array $additionalFields)
    {
        $response = [];

        $subscriber = array(
            'EmailAddress' => $email,
            'Name' => $fullName,
            'CustomFields' => $additionalFields,
            'Resubscribe' => true
        );

        if ($email !== null) {
            $response = CmLists::getInstance()->campaignmonitor->addSubscriber($listId, $subscriber);
        }

        return $response;
    }

}
