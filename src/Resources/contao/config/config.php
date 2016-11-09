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
 * Content pattern
 */
$GLOBALS['TL_CTP']['element']['teaser'] = array('teaser' => 'PatternTeaser');


/**
 * Content pattern not allowed in sub pattern
 */
$GLOBALS['TL_CTP_NA']['multipattern'][] = 'teaser';


/**
 * HOOK
 */
$GLOBALS['TL_HOOKS']['isVisibleElement'][] = array('Agoat\\ArticleTeaser\\Teaser', 'checkVisibility'); 

