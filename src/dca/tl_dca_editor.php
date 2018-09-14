<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
 * Table tl_dca_editor
 */

$GLOBALS['TL_DCA']['tl_dca_editor'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'tables'                      => array('tl_dca_editor'),
		'onload_callback'             => array(),
		'ondelete_callback' => array
		(
			array('dca_editor', 'generateAllFiles')
		),
		'onsubmit_callback' => array
		(
			array('dca_editor', 'generateAllFiles')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		),
		'closed'                      => false,
		'switchToEdit'                => true,
		'enableVersioning'            => false
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('text'),
			'flag'                    => 1
		),
		'label' => array
		(
			'fields'                  => array('text','class','published'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'import' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dca_editor']['import'],
				'icon'                => 'cssimport.gif',
				'href'                => 'key=import',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dca_editor']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dca_editor']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dca_editor']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this,%s);"',
				'button_callback'     => array('tl_dca_editor', 'toggleIcon')
			),
			'export' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dca_editor']['export'],
				'icon'                => 'store.gif',
				'href'                => 'key=export',
				'attributes'          => 'target="export" style="margin-left:10px;"'

			)
		)
	),

    // select
    'select' => array
    (
        'buttons_callback' => array
        (
            array('tl_dca_editor', 'export')
        )
    ),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('dolang'),
		'default'                     => 'text,dolang,dcadata,published;'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'dolang_j'                            => 'language,filename',
		'dolang_n'                            => 'tabelle'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'text' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['text'],
			'inputType'               => 'text',
			'sql'                     => "varchar(256) NOT NULL default ''"
		),
		'dolang' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['dolang'],
			'inputType'               => 'radio',
			'options'				  => array('j','n'),
			'default'				  => 'n',
			'eval'                    => array('tl_class'=>'clr', 'cols'=>2, 'submitOnChange' => true),
			'reference'               => &$GLOBALS['TL_LANG']['tl_dca_editor'],
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'tabelle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['table'],
			'inputType'               => 'text',
			'eval'					  => array('tl_class'=>'not_dolang clr w50'),
			'sql'                     => "varchar(256) NOT NULL default ''"
		),
		'filename' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['filename'],
			'inputType'               => 'text',
			'default'                 => 'default',
			'eval'					  => array('tl_class'=>'not_dolang clr w50'),
			'sql'                     => "varchar(256) NOT NULL default ''"
		),
		'language' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['language'],
			'inputType'               => 'text',
			'eval'					  => array('tl_class'=>' w50','maxlength'=>'5'),
			'sql'                     => "char(5) NOT NULL default ''"
		),
		'dcadata' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['dcadata'],
			'inputType'               => 'textarea',
			'eval'                    => array('tl_class'=>'clr','decodeEntities' => false),
			'sql'                     => "text NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dca_editor']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'clr', 'doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);


/**
 * Class tl_dca_editor
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Frank Thonak www.thomkit.de
 * @author     Frank Thonak
 * @package    dca_editor
 */
class tl_dca_editor extends Backend
{

	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
        {
	           $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
               $this->redirect($this->getReferer());
        }

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
	}

	/**
	 * Disable/enable
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		$this->import('dca_editor');
		// Update the database
		$this->Database->prepare("UPDATE tl_dca_editor SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);
        $this->dca_editor->generateAllFiles();
	}



	public function export($arrButtons)
	{
		$ids= '';
		if(Input::post('exportDCA') != '' && count(Input::post('IDS') > 0))
			$ids = "<script>window.open('contao/main.php?do=dca_editor&key=export&ids=0,".implode(",",Input::post('IDS'))."');</script>";
		// Unset the buttons
    	unset($arrButtons['edit']);
    	unset($arrButtons['override']);
		$arrButtons['export'] = $ids.'<input type="submit" name="exportDCA" id="exportDCA" class="tl_submit" accesskey="e" value="Exportieren"> ';
		return $arrButtons;
	}

}

