<?php
/**
 * Contao Open Source CMS Extension
 *
 * @package  	 Teaser (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 

// table callbacks
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_teaser', 'teaserPreview');
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['panel_callback']['teaser'] = array('tl_content_teaser', 'generatePreviewFilter');

// add Teaser preview option
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['panelLayout'] = str_replace('filter', 'teaser;filter', $GLOBALS['TL_DCA']['tl_content']['list']['sorting']['panelLayout']);

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['teaser'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['teaser'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options'			=> array('any', 'teaser', 'article'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content_teaser'],
	'eval'				=> array('tl_class'=>'w50 clr',),
	'sql'				=> "varchar(8) NOT NULL default ''"
);



class tl_content_teaser extends Backend
{
	// panel_callback
	public function generatePreviewFilter($dc) 
	{ 
		$session = $this->Session->getData();
		$filter = 'tl_content_'.CURRENT_ID;

		return '<div class="tl_filter tl_subpanel"><strong>' . $GLOBALS['TL_LANG']['tl_content']['teaserPreview'] . '</strong>
<select name="teaserpreview" id="teaserpreview" class="tl_select" onchange="this.form.submit()">
<option value="">-</option>
<option value="teaser"' . (($session['filter'][$filter]['preview'] == 'teaser')? ' selected="selected"' : '') . '>' . $GLOBALS['TL_LANG']['tl_content']['teaserView'] . '</option>
<option value="article"' . (($session['filter'][$filter]['preview'] == 'article')? ' selected="selected"' : '') . '>' . $GLOBALS['TL_LANG']['tl_content']['articleView'] . '</option>
</select></div>';
	}
		
	// onload_callback
	public function teaserPreview($dc) 
	{ 
		$session = $this->Session->getData();
		$filter = 'tl_content_'.CURRENT_ID;

		if (\Input::post('FORM_SUBMIT') == 'tl_filters')
		{
			// Validate the user input
			if (in_array(\Input::post('teaserpreview'), array('teaser', 'article')))
			{
				$session['filter'][$filter]['preview'] = \Input::Post('teaserpreview');
			}
			else
			{
				unset($session['filter'][$filter]['preview']);
			}
			
			$this->Session->setData($session);
		}

		// apply filter if preview mode is set
		if ($session['filter'][$filter]['preview'])
		{
			$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['filter']['teaser'] = array("(teaser='any' OR teaser=?)", $session['filter'][$filter]['preview']);
		}
	}
}
