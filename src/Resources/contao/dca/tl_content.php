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

$GLOBALS['TL_DCA']['tl_content']['fields']['type']['save_callback'][] = array('tl_content_teaser', 'correctTeaserStatus');


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
	'sql'				=> "varchar(8) NOT NULL default 'any'"
);



class tl_content_teaser extends Backend
{
	// panel_callback
	public function generatePreviewFilter($dc) 
	{ 
		/** @var SessionInterface $objSession */
		$objSession = \System::getContainer()->get('session');
		
		/** @var AttributeBagInterface $objSessionBag */
		$objSessionBag = $objSession->getBag('contao_backend');
		
		$filter = $objSessionBag->get('filter');
		$preview = $filter['tl_content_'.CURRENT_ID]['preview'];

		return '<div class="tl_filter tl_subpanel"><strong>' . $GLOBALS['TL_LANG']['tl_content']['teaserPreview'] . '</strong>
<select name="teaserpreview" id="teaserpreview" class="tl_select" onchange="this.form.submit()">
<option value="">-</option>
<option value="teaser"' . (($preview == 'teaser')? ' selected="selected"' : '') . '>' . $GLOBALS['TL_LANG']['tl_content']['teaserView'] . '</option>
<option value="article"' . (($preview == 'article')? ' selected="selected"' : '') . '>' . $GLOBALS['TL_LANG']['tl_content']['articleView'] . '</option>
</select></div>';
	}
		
	// onload_callback
	public function teaserPreview($dc) 
	{ 
		/** @var SessionInterface $objSession */
		$objSession = \System::getContainer()->get('session');
		
		/** @var AttributeBagInterface $objSessionBag */
		$objSessionBag = $objSession->getBag('contao_backend');

		$filter = $objSessionBag->get('filter');
		$preview = $filter['tl_content_'.CURRENT_ID]['preview'];

		if (\Input::post('FORM_SUBMIT') == 'tl_filters')
		{
			// Validate the user input
			if (in_array(\Input::post('teaserpreview'), array('teaser', 'article')))
			{
				$preview = \Input::Post('teaserpreview');
			}
			else
			{
				unset($preview);
			}
			
			$filter['tl_content_'.CURRENT_ID]['preview'] = $preview;
			$objSessionBag->set('filter', $filter);
		}

		// apply filter if preview mode is set
		if ($preview)
		{
			$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['filter']['teaser'] = array("(teaser='any' OR teaser=?)", $preview);
		}
	}
	
	
	// onsubmit_callback
	public function correctTeaserStatus($varValue, $dc) 
	{ 
		$db = Database::getInstance();

		$bolNoTeaser = true;
		
		$objContentBlock = \ContentBlocksModel::findByAlias($varValue);

		if ($objContentBlock !== null)
		{
			$colContentPattern = \ContentPatternModel::findByPid($objContentBlock->id);
			
			foreach(\ContentPatternModel::findByPid(\ContentBlocksModel::findByAlias($varValue)->id) as $objPattern)
			{
				if ($objPattern->type == 'teaser')
				{
					$bolNoTeaser = false;
				}
			}
		}

		if ($bolNoTeaser)
		{
			$db->prepare("UPDATE tl_content SET teaser=\"any\" WHERE id=?")
			   ->execute($dc->id);
		}
	
		return $varValue;
	}
}
