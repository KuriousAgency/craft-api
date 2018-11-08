<?php
/**
 * Craft API plugin for Craft CMS 3.x
 *
 * An api for craft.
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2018 Kurious Agency
 */

namespace kuriousagency\craftapi\models;

use kuriousagency\craftapi\CraftApi;

use Craft;
use craft\base\Model;

/**
 * @author    Kurious Agency
 * @package   CraftApi
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $apiToken;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['apiToken', 'string'],
        ];
    }
}
