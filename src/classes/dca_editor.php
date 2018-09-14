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
 * Class dca_editor
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Frank Thonak www.thomkit.de
 * @author     Frank Thonak
 * @package    dca_editor
 */


class dca_editor extends System
{

	var $myDir = '../system/modules/zzz_dca';

	/**
	 *
	 */
	public function generateAllFiles($data = 0)
	{
		$this->import('Database');
		// Delete folder
		$this->unlinkDir($this->myDir.'/dca', true);
		$this->unlinkDir($this->myDir.'/languages/', true);
		$this->unlinkDir($this->myDir.'/config/', true);
		// Create Folder
		mkdir($this->myDir.'/dca');
		mkdir($this->myDir.'/languages/');
		mkdir($this->myDir.'/config/');
		$myFile = fopen ($this->myDir.'/config/config.php', 'w');
		flock ($myFile, 2);
		fputs ($myFile, '<?php // text ?>');
		flock ($myFile, 3);
		fclose ($myFile);

		// Get all datarows
		$sql = $this->Database->prepare("SELECT * FROM tl_dca_editor WHERE published = '1'")
					   ->execute();
		$ids = array();
		while($sql->next())
		{
			if(!in_array($sql->id,$ids)) $ids = $this->generateFile($ids,$sql->id);
		}
	}


	/**
	 *
	 */
	public function generateFile($retValue,$id=0)
	{
		// Get datarow
		if($sql = $this->Database->prepare("SELECT * FROM tl_dca_editor WHERE id=?")
					   ->execute($id));
		{
			$sql->next();
			if($sql->dolang == 'j')
			{
				// Get datarows 'language'
				$sqlrows = $this->Database->prepare("SELECT * FROM tl_dca_editor WHERE published = '1' AND language=? AND filename=?")
						   ->execute($sql->language,$sql->filename);
				// file incl. path
				$pathFile = $this->myDir.'/languages/'.$sql->language.'/'.$sql->filename.'.php';
				mkdir($this->myDir.'/languages/'.$sql->language);
			}
			else
			{
				// Get datarows 'table'
				$sqlrows = $this->Database->prepare("SELECT * FROM tl_dca_editor WHERE published = '1' AND tabelle=?")
						   ->execute($sql->tabelle);
				// file incl. path
				$pathFile = $this->myDir.'/dca/'.$sql->tabelle.'.php';
			}
			$filedata = '';
			while($sqlrows->next())
			{
				$filedata.=$sqlrows->dcadata."\n";
				$retValue[] = $sqlrows->id;
			}
			// Create file

			$myFile = fopen ($pathFile, 'w');
			flock ($myFile, 2);
			fputs ($myFile, '<?php '.html_entity_decode($filedata).'?>');
			flock ($myFile, 3);
			fclose ($myFile);
		}
		return $retValue;
	}

	function unlinkDir($dir, $DeleteMe) {
	    if(!$dh = @opendir($dir)) return;
	    while (false !== ($obj = readdir($dh))) {
	        if($obj=='.' || $obj=='..') continue;
	        if (!@unlink($dir.'/'.$obj)) $this->unlinkDir($dir.'/'.$obj, true);
	    }
	    closedir($dh);
	    if ($DeleteMe){
	        @rmdir($dir);
	    }
	}
}
?>
