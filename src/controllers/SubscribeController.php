<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-lists
 * @copyright Copyright (c) Clearbold, LLC
 */

namespace clearbold\cmlists\controllers;

use clearbold\cmlists\CmLists;

use Craft;
use craft\web\Controller;

/**
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0.2
 */
class SubscribeController extends Controller
{

    // Protected Properties
    // =========================================================================

    protected $allowAnonymous = ['index'];

    /**
     * @returns redirect or JSON
     */
    public function actionIndex()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        // Fetch list id from hidden input
        $listId = $request->getRequiredBodyParam('listId') ? Craft::$app->security->validateData($request->post('listId')) : null;
        $redirect =  $request->getRequiredBodyParam('redirect') ? Craft::$app->security->validateData($request->post('redirect')) : null;

        $additionalFields = array();
        foreach($request->getParam('fields') as $key => $value) {
            $email = $request->getParam('email');
            $fullName = (null !==$request->getParam('firstname')) ? $request->getParam('firstname') . ' ' . $request->getParam('lastname') : $request->getParam('fullname');
            if ($key != 'email' && $key != 'firstname' && $key != 'lastname' && $key != 'fullname')
            {
                $additionalFields[] = array(
                    'Key' => $key,
                    'Value' => $value
                );
            }
            $subscriber = array(
                'EmailAddress' => $email,
                'Name' => $fullName,
                'CustomFields' => $additionalFields,
                'Resubscribe' => true
            );
        }

        $response = CmLists::getInstance()->campaignmonitor->addSubscriber($listId, $subscriber);

        return $request->getBodyParam('redirect') ? $this->redirectToPostedUrl() : $this->asJson($response);
    }

}