<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-lists
 * @copyright Copyright (c) Clearbold, LLC
 */

namespace clearbold\cmlists\controllers;

use clearbold\cmlists\CmLists;
use craft\web\Response;

use Craft;
use craft\web\Controller;

/**
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0.2
 */
class UnsubscribeController extends Controller
{

    // Protected Properties
    // =========================================================================

    protected array|int|bool $allowAnonymous = ['index'];

    /**
     * @returns redirect or JSON
     */
    public function actionIndex(): string|Response
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        // Fetch list id from hidden input
        $listId = $request->getRequiredBodyParam('listId') ? Craft::$app->security->validateData($request->post('listId')) : null;
        $redirect =  $request->getRequiredBodyParam('redirect') ? Craft::$app->security->validateData($request->post('redirect')) : null;
        $email = $request->getParam('email');

        $response = CmLists::getInstance()->campaignmonitor->unsubSubscriber($listId, $email);

        return $request->getBodyParam('redirect') ? $this->redirectToPostedUrl() : $this->asJson($response);
    }

}