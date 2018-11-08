<?php
/**
 * Craft API plugin for Craft CMS 3.x
 *
 * An api for craft.
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2018 Kurious Agency
 */

namespace kuriousagency\craftapi\services;

use kuriousagency\craftapi\CraftApi;

use Craft;
use craft\base\Component;

/**
 * @author    Kurious Agency
 * @package   CraftApi
 * @since     1.0.0
 */
class Api extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (CraftApi::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
