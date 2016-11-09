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
$GLOBALS['TL_DCA']['tl_content_pattern']['palettes']['teaser'] = '{type_legend},type;{teaser_legend},teaser,canChangeTeaser;{readmorelink_legend},alias;{invisible_legend},invisible';

// Fields
$GLOBALS['TL_DCA']['tl_content_pattern']['fields']['teaser'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content_pattern']['teaser'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'       		  => array('any', 'teaser', 'article'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_content_pattern_teaser'],
	'eval'                    => array('tl_class'=>'w50 clr',),
	'sql'                     => "varchar(8) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content_pattern']['fields']['canChangeTeaser'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content_pattern']['canChangeTeaser'],
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class' => 'w50 m12'),
	'sql'                     => "varchar(1) NOT NULL default ''"
);


