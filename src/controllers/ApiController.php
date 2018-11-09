<?php
/**
 * Craft API plugin for Craft CMS 3.x
 *
 * An api for craft.
 *
 * @link      https://kurious.agency
 * @copyright Copyright (c) 2018 Kurious Agency
 */

namespace kuriousagency\craftapi\controllers;

use kuriousagency\craftapi\CraftApi;

use Craft;
use craft\web\Controller;
use yii\web\Response;
use craft\helpers\StringHelper;
use craft\helpers\Template;
use yii\web\HttpException;
use yii\base\Exception;

/**
 * @author    Kurious Agency
 * @package   CraftApi
 * @since     1.0.0
 */
class ApiController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index'];

    // Public Methods
	// =========================================================================
	
	public function actionIndex($url)
	{
		$request = Craft::$app->getRequest();
		$apiToken = CraftAPI::$plugin->getSettings()->apiToken;
		
		if ($apiToken && $request->headers['authorization'] != 'Bearer '.$apiToken) {
			throw new HttpException(401);
		}
		
		$response = Craft::$app->getResponse();
		$segments = explode('/', $url);

		$view = Craft::$app->getView();
        $oldTemplateMode = $view->getTemplateMode();
		$view->setTemplateMode($view::TEMPLATE_MODE_SITE);

		//check if last segment is format
		$lastSeg = $segments[count($segments)-1];
		if (StringHelper::contains($lastSeg, '.')) {
			$type = explode('.',$lastSeg)[1];
			$lastSeg = $segments[count($segments)-1] = explode('.',$lastSeg)[0];

			//check if file exists with that extension
			if ($view->doesTemplateExist('_api/'.$url)) {
				return $this->renderTemplate('_api/'.$url);
			}


			switch ($type)
			{
				case 'json':
					$response->format = \yii\web\Response::FORMAT_JSON;
					break;
				case 'xml':
					$response->format = \yii\web\Response::FORMAT_XML;
					break;

				default:
					throw new HttpException(404);
			}
		} else {
			$response->format = \yii\web\Response::FORMAT_JSON;
		}

		$variables = [];

		//check if last segment is an id and pass it to the template
		if ((int)$lastSeg) {
			$variables['id'] = (int)$lastSeg;
			unset($segments[count($segments)-1]);
		}

		

		/*$view = Craft::$app->getView();
        $oldTemplateMode = $view->getTemplateMode();
		$view->setTemplateMode($view::TEMPLATE_MODE_SITE);*/

		$templatePath = "_api/".implode('/',$segments);

		if (!$view->doesTemplateExist($templatePath)) {
			throw new HttpException(404);
		}

		try {
			$content = $view->renderTemplate($templatePath, $variables);
		} catch (\Exception $e) {
			$view->setTemplateMode($oldTemplateMode);
		}

		$view->setTemplateMode($oldTemplateMode);

		$content = json_decode($content);

		return (array) $content;
	}

}
