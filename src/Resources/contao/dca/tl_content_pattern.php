<?php
/**
 * Contao Open Source CMS Extension
 *
 * @package  	 Teaser (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 
 
$GLOBALS['TL_DCA']['tl_content_pattern']['config']['onsubmit_callback'][] = array('tl_content_pattern_teaser', 'saveTeaser');

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




/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Arne Stappen (aGoat) <https://github.com/agoat>
 */
class tl_content_pattern_teaser extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function saveTeaser ($dc)
	{
		$db = Database::getInstance();
					
		// change predefined groups
		if ($dc->activeRecord->type == 'teaser' && !$dc->activeRecord->canChangeTeaser)
		{
			// save alias to database
			$db->prepare("UPDATE tl_content SET teaser=? WHERE type=(SELECT alias FROM tl_content_blocks WHERE id=?)")
			   ->execute($dc->activeRecord->teaser, $dc->activeRecord->pid);
		
		}
	}

}


