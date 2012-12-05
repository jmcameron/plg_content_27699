<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Content.27699
 *
 * @author      Roberto Segura <roberto@phproberto.com>
 * @copyright   (c) 2012 Roberto Segura. All Rights Reserved.
 * @license     GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.htm
 */

defined('_JEXEC') or die;

JLoader::import('joomla.plugin.plugin');

/**
 * Main plugin class
 *
 * @package     Joomla.Plugin
 * @subpackage  Content.27699
 * @since       3.0
 *
 */
class PlgContent27699 extends JPlugin
{
	private $_params = null;

	// Plugin info constants
	const TYPE = 'content';

	const NAME = '27699';

	// Url parameters
	private $_option = null;

	private $_view = null;

	private $_id = null;

	/**
	* Constructor
	*
	* @param   mixed  &$subject  Subject
	*/
	function __construct( &$subject )
	{

		parent::__construct($subject);

		// Load plugin parameters
		$this->_plugin = JPluginHelper::getPlugin(self::TYPE, self::NAME);
		$this->_params = new JRegistry($this->_plugin->params);
	}

	function onContentPrepare($context, &$article, &$params )
	{
		// Required objects
		$app      = JFactory::getApplication();
		$document = JFactory::getDocument();
		$jinput   = $app->input;

		// Get url parameters
		$this->_option = $jinput->get('option', null);
		$this->_view   = $jinput->get('view', null);
		$this->_id     = $jinput->get('id', null);

		/**
		 * Test Backwards Compatibility
		 * Old plugins only process $article->text
		 * New plugins should be able to access the article->title
		 **/
		$title = isset($article->title) ? $article->title : "No title!";
		$article->text .= '<h1>IT WORKS! ('.$context.'), Title='.$title.'</h1>';
		//$article->introtext = str_replace('{27699}', '<h1>IT WORKS!</h1>', $article->introtext);
		// Display title to ensure that the property is available
		// echo var_dump($article->title);

		if ($app->isSite())
		{
			$properties = get_object_vars($article);
			echo '<h1>Context: ' . $context . ' - Properties: ' . count($properties) . '</h1>';
		}
	}
}
