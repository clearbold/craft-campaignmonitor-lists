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
        $redirect =  $request->getParam('redirect') ? Craft::$app->security->validateData($request->post('redirect')) : null;

        $additionalFields = array();
        $email = $request->getParam('email');
        $fullName = '';
        if ($request->getParam('fullname') !== null)
            $fullName = $request->getParam('fullname');
        if ($request->getParam('firstname') !== null)
            $fullName = $request->getParam('firstname');
        if ($request->getParam('lastname') !== null)
            $fullName .= ' ' . $request->getParam('lastname');

        if ($request->getParam('fields') !== null)
        {
            foreach($request->getParam('fields') as $key => $value) {
                if ($key != 'email' && $key != 'firstname' && $key != 'lastname' && $key != 'fullname')
                {
                    $additionalFields[] = array(
                        'Key' => $key,
                        'Value' => $value
                    );
                }
            }
        }

        // $subscriber = array(
        //     'EmailAddress' => $email,
        //     'Name' => $fullName,
        //     'CustomFields' => $additionalFields,
        //     'Resubscribe' => true
        // );

        // if ($request->getParam('email') !== null) {
        //     $response = CmLists::getInstance()->campaignmonitor->addSubscriber($listId, $subscriber);
        // }

        $response = CmLists::getInstance()->cmListService->subscribe($listId, $email, $fullName, $additionalFields);

        return $request->getBodyParam('redirect') ? $this->redirectToPostedUrl() : $this->asJson($response);
    }

}
