<?php
/**
 * @link      https://github.com/clearbold/craft-campaignmonitor-lists
 * @copyright Copyright (c) Clearbold, LLC
 *
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 */

namespace clearbold\cmlists\models;

use clearbold\cmlists\CmLists;

use Craft;
use craft\base\Model;

/**
 * @author    Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since     0.1.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $apiKey = null;
    /**
     * @var string
     */
    public $clientId = null;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiKey'], 'string'],
            [['apiKey'], 'required'],
            [['clientId'], 'string'],
            [['clientId'], 'required'],
        ];
    }
}