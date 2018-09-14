<?php

 /**
  * Namespace
  */


if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Frank Thonak www.thomkit.de
 * @author     Frank Thonak
 * @package    dca_editor
 * @license    LGPL
 * @filesource
 */



/**
 * Class ExportDCA
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Frank Thonak www.thomkit.de
 * @author     Frank Thonak
 * @package    dca_editor
 */


class ExportDCA extends System
{
	public function generate()
	{
		$db = Database::getInstance();
		$ids = $this->Input->get('id');
		if ($this->Input->get('ids') != '') $ids = $this->Input->get('ids');
		$dbDCA = $db->execute("SELECT * FROM tl_dca_editor WHERE id IN (".$ids.")");
		$xmlData = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><dca></dca>');
		while($dbDCA->next())
		{
			$xmlItem = $xmlData->addChild('item');
			$xmlItem->addChild('text', utf8_encode($dbDCA->text));
			$xmlItem->addChild('dolang', utf8_encode($dbDCA->dolang));
			$xmlItem->addChild('tabelle', utf8_encode($dbDCA->tabelle));
			$xmlItem->addChild('language', utf8_encode($dbDCA->language));
			$xmlItem->addChild('dcadata', utf8_encode($dbDCA->dcadata));
			$xmlItem->addChild('published', utf8_encode($dbDCA->published));
		}
		Header('Content-type: text/xml');
		header("Content-Disposition: attachment; filename=dca.xml");
		echo $xmlData->asXML();
		die();
	}
}
?>