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
$GLOBALS['TL_DCA']['tl_article']['palettes']['default'] = str_replace('{teaser_legend:hide},teaserCssID,showTeaser,teaser;', '', $GLOBALS['TL_DCA']['tl_article']['palettes']['default']);
