<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Dca_editor
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'dca_editor' => 'system/modules/dca_editor/classes/dca_editor.php',
	'ExportDCA'  => 'system/modules/dca_editor/classes/ExportDCA.php',
	'ImportDCA'  => 'system/modules/dca_editor/classes/ImportDCA.php',
));
