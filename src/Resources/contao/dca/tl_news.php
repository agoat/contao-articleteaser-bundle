<?php
/**
 * Contao Open Source CMS Extension
 *
 * @package  	 Teaser (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 
 
/**
 * Palettes
 */

// remove teaser
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace('{teaser_legend},subheadline,teaser;', '', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
// remove add image
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace('{image_legend},addImage;', '', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
// remove enclosures
//$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace('{enclosure_legend:hide},addEnclosure;', '', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
