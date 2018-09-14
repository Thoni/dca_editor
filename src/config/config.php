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
 * @license    GPL
 * @filesource
 */

/*
 * -------------------------------------------------------------------------
 * BACK END MODULES
 * -------------------------------------------------------------------------
 *
 */

array_insert(
    $GLOBALS['BE_MOD'], 10, array(
        'devtools' => array(
            'dca_editor' => array(
                'icon'   => 'system/modules/dca_editor/assets/images/extension.gif',
                'tables' => array('tl_dca_editor'),
                'export' => array('ExportDCA','generate'),
                'import' => array('ImportDCA','generate')
            )
        )
    )
);

?>