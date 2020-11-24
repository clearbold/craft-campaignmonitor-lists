<?php
/**
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.1.5
 */

namespace clearbold\cmlists\services;

use clearbold\cmlists\CmLists;
use clearbold\cmlists\events\SubscribeEvent;

use Craft;
use craft\base\Component;
use yii\base\Event;

/**
 * ListService
 */
class ListService extends Component
{
    const EVENT_SUBSCRIBER_ADDED = 'subscriberAdded';

    // Public Methods
    // =========================================================================
    /*
     * @return mixed
     */
    public function subscribe(string $listId, string $email, string $fullName, array $additionalFields)
    {
        $response = [];

        $subscriber = array(
            'EmailAddress' => $email,
            'Name' => $fullName,
            'CustomFields' => $additionalFields,
            'Resubscribe' => true,
            'ConsentToTrack' => 'yes',
            'Resubscribe' => true
        );

        if ($email !== null) {
            $response = CmLists::getInstance()->campaignmonitor->addSubscriber($listId, $subscriber);
        }

        $eventName = self::EVENT_SUBSCRIBER_ADDED;

        $event = new SubscribeEvent([
            'subscriber' => $subscriber
        ]);
        $this->trigger($eventName, $event);

        return $response;
    }

}
