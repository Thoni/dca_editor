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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_dca_editor']['text'] = array('Titel','');
$GLOBALS['TL_LANG']['tl_dca_editor']['dolang'] = array('Sprachdatei','Bitte w&auml;hlen Sie hier, ob die Daten als Sprachdatei abgespeichert werden sollen.');
$GLOBALS['TL_LANG']['tl_dca_editor']['j'] = array('ja','ja');
$GLOBALS['TL_LANG']['tl_dca_editor']['n'][0] = 'nein';
$GLOBALS['TL_LANG']['tl_dca_editor']['n'][1] = 'nein';
$GLOBALS['TL_LANG']['tl_dca_editor']['table'] = array('Tabelle','Geben Sie hier die Tabelle (tl_page, tl_content,...) ein, auf die sich die Angaben beziehen.');
$GLOBALS['TL_LANG']['tl_dca_editor']['filename'] = array('Dateiname','Geben Sie hier den dateinamen (default, tl_content,...) ein, in der die Daten gespeichert werden sollen.');
$GLOBALS['TL_LANG']['tl_dca_editor']['language'] = array('Sprache','Geben Sie hier die Sprache (de,en,...) ein.');
$GLOBALS['TL_LANG']['tl_dca_editor']['dcadata'] = array('Daten','Geben Sie hier die Daten ein.');
$GLOBALS['TL_LANG']['tl_dca_editor']['published'] = array('aktivieren','Diese Angaben benutzen.');

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dca_editor']['edit'] = array('DCA-Eintrag bearbeiten','DCA-Eintrag ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_dca_editor']['toggle'] = array('DCA-Eintrag (de)aktivieren','DCA-Eintrag ID %s (de)aktivieren');
$GLOBALS['TL_LANG']['tl_dca_editor']['delete'] = array('DCA-Eintrag l&ouml;schen','DCA-Eintrag ID %s l&ouml;schen');
$GLOBALS['TL_LANG']['tl_dca_editor']['export'] = array('DCA-Eintrag exportieren','DCA-Eintrag ID %s exportieren');
$GLOBALS['TL_LANG']['tl_dca_editor']['import'] = array('DCA-Import', 'Vorhandene DCA-Definition importieren');
$GLOBALS['TL_LANG']['tl_dca_editor']['new']    = array('Neue Daten', 'Neue Daten');

$GLOBALS['TL_LANG']['tl_dca_editor']['source'] = array('Quelldateien', 'Hier k&ouml;nnen Sie eine oder mehrere .xml-Dateien f&uuml;r den Import hochladen.');

?>