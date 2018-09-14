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


class ImportDCA extends \Backend
{

	/**
	 * Import the Files library
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('Files');
	}


	public function generate()
	{
		if (\Input::get('key') != 'import')
		{
			return '';
		}

		$this->import('BackendUser', 'User');
		$class = $this->User->uploader;

		if (!class_exists($class))
		{
			$class = 'FileUpload';
		}

		$objUploader = new $class();

		// Import XML
		if (\Input::post('FORM_SUBMIT') == 'tl_dca_editor_import')
		{
			$db = Database::getInstance();

			$arrUploaded = $objUploader->uploadTo('system/tmp');

			if (empty($arrUploaded))
			{
				\Message::addError($GLOBALS['TL_LANG']['ERR']['all_fields']);
				$this->reload();
			}

			foreach ($arrUploaded as $strDcaFile)
			{
				// Folders cannot be imported
				if (is_dir(TL_ROOT . '/' . $strDcaFile))
				{
					\Message::addError(sprintf($GLOBALS['TL_LANG']['ERR']['importFolder'], basename($strDcaFile)));
					continue;
				}

				$objFile = new \File($strDcaFile, true);

				// Check the file extension
				if ($objFile->extension != 'xml')
				{
					\Message::addError(sprintf($GLOBALS['TL_LANG']['ERR']['filetype'], $objFile->extension));
					continue;
				}

				// Read the file and remove carriage returns
				$strFile = $objFile->getContent();
				$xml = simplexml_load_string($strFile);
				foreach($xml->item AS $item)
				{
					$text = (string)$item->text;
					$dolang = (string)$item->dolang;
					$tabelle = (string)$item->tabelle;
					$language = (string)$item->language;
					$dcadata = (string)$item->dcadata;
					$published = (string)$item->published;
					$db->prepare("insert into tl_dca_editor (text,dolang,tabelle,language,dcadata,published) values (?,?,?,?,?,?)")
								->execute($text,$dolang,$tabelle,$language,$dcadata,$published);
				}
			}
			// Redirect
			\System::setCookie('BE_PAGE_OFFSET', 0, 0);
			$this->redirect(str_replace('&key=import', '', \Environment::get('request')));
		}

		// Return form
		return '
<div id="tl_buttons">
<a href="' .ampersand(str_replace('&key=import', '', \Environment::get('request'))). '" class="header_back" title="' .specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']). '" accesskey="b">' .$GLOBALS['TL_LANG']['MSC']['backBT']. '</a>
</div>

<h2 class="sub_headline">' .$GLOBALS['TL_LANG']['tl_dca_editor']['import'][1]. '</h2>
' .\Message::generate(). '
<form action="' .ampersand(\Environment::get('request'), true). '" id="tl_dca_editor_import" class="tl_form" method="post" enctype="multipart/form-data">
<div class="tl_formbody_edit">
<input type="hidden" name="FORM_SUBMIT" value="tl_dca_editor_import">
<input type="hidden" name="REQUEST_TOKEN" value="'.REQUEST_TOKEN.'">
<input type="hidden" name="MAX_FILE_SIZE" value="'.$GLOBALS['TL_CONFIG']['maxFileSize'].'">

<div class="tl_tbox">
  <h3>'.$GLOBALS['TL_LANG']['tl_dca_editor']['source'][0].'</h3>'.$objUploader->generateMarkup().(isset($GLOBALS['TL_LANG']['tl_dca_editor']['source'][1]) ? '
  <p class="tl_help tl_tip">'.$GLOBALS['TL_LANG']['tl_dca_editor']['source'][1].'</p>' : '').'
</div>

</div>

<div class="tl_formbody_submit">

<div class="tl_submit_container">
  <input type="submit" name="save" id="save" class="tl_submit" accesskey="s" value="' .specialchars($GLOBALS['TL_LANG']['tl_dca_editor']['import'][0]). '">
</div>

</div>
</form>';
	}
}
?>