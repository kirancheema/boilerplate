<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

/**
 * Foos Table class.
 *
 * @since  4.0
 */
class FooTable extends Table
{
	/**
	 * Constructor
	 *
	 * @param   DatabaseDriver  $db  Database connector object
	 *
	 * @since   4.0
	 */
	public function __construct(DatabaseDriver $db)
	{
		$this->typeAlias = 'com_foos.foo';

		parent::__construct('#__foos_details', 'id', $db);

		$this->setColumnAlias('published', 'state');
	}

	/**
	 * Overloaded check function
	 *
	 * @return  boolean
	 *
	 * @see     Table::check
	 * @since   1.5
	 */
	public function check()
	{
		try
		{
			parent::check();
		}
		catch (\Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		// Set name
		$this->name = htmlspecialchars_decode($this->name, ENT_QUOTES);

		// Check the publish down date is not earlier than publish up.
		if ($this->publish_down > $this->_db->getNullDate() && $this->publish_down < $this->publish_up)
		{
			$this->setError(Text::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));

			return false;
		}

		if (empty($this->publish_up))
		{
			$this->publish_up = $this->getDbo()->getNullDate();
		}

		if (empty($this->publish_down))
		{
			$this->publish_down = $this->getDbo()->getNullDate();
		}

		return true;
	}
}