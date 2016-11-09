<?php
/**
 * Contao Open Source CMS Extension
 *
 * @package  	 Teaser (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 
namespace Agoat/ArticleTeaser;

 
class PatternTeaser extends \Pattern
{
	/**
	 * generate the DCA construct
	 */
	public function construct()
	{
		// the teaser field
		if ($this->canChangeTeaser)
		{
			// elements field so don´t use parent construct method
			$GLOBALS['TL_DCA']['tl_content']['palettes'][$this->alias] .= ',teaser';
		}
		else
		{
			// copy pattern teaser setting to content element
			$this->import("Database");
			$this->Database->prepare("UPDATE tl_content SET teaser=? WHERE id=?")
						   ->execute($this->teaser, $this->cid);
		}
	}
	

	/**
	 * Generate backend output
	 */
	public function view()
	{
		if ($this->canChangeTeaser)
		{
			$strPreview = '<div class="" style="padding-top:10px;"><h3 style="margin: 0;"><label>' . $GLOBALS['TL_LANG']['tl_content_pattern']['teaser'][0] . '</label></h3>';
			$strPreview .= '<select class="tl_select" style="width: 412px;">';
			$strPreview .= '<option value="any">' . $GLOBALS['TL_LANG']['tl_content_pattern_teaser']['any'][0] . '</option>';
			$strPreview .= '<option value="teaser">' . $GLOBALS['TL_LANG']['tl_content_pattern_teaser']['teaser'][0] . '</option>';
			$strPreview .= '<option value="article">' . $GLOBALS['TL_LANG']['tl_content_pattern_teaser']['article'][0] . '</option>';
			$strPreview .= '</select><p class="tl_help tl_tip" title="">' . $GLOBALS['TL_LANG']['tl_content_pattern']['teaser'][1] . '</p></div>';
		}
		else
		{
			$strPreview = '<div style="padding: 5px 0 10px;"><span>' . $GLOBALS['TL_LANG']['tl_content_pattern_teaser'][$this->teaser][0] . '</span></div>';
		}
		
		return $strPreview;
	}

	/**
	 * Generate data for the frontend template 
	 */
	public function compile()
	{
		// generate a readmore link
		if ($this->cptable == 'tl_article')
		{
			$articleTeaser = new ArticleTeaser();
			$this->writeToTemplate($articleTeaser->generateLink($this->cpid));
		}
		elseif ($this->cptable == 'tl_news')
		{
			$newsTeaser = new NewsTeaser();
			$this->writeToTemplate($newsTeaser->generateLink($this->cpid));
		}
	}
}
