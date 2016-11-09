<?php

/**
 * Contao Open Source CMS Extension
 *
 * @package  	 Teaser (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 
namespace Agoat\ArticleTeaser;

use Contao\News;

class NewsTeaser extends News
{
	protected $strLink = false;

	public function generateLink($intId) 
	{ 
		if ($this->strLink)
		{
			return $this->strLink;
		}
		
		$objNews = \NewsModel::findByPk($intId);
		$objPage = \PageModel::findWithDetails($objNews->getRelated('pid')->jumpTo);
				
		// A jumpTo page is set but does no longer exist (see #5781)
		if ($objPage === null)
		{
			return '';
		}
		else
		{
			$strUrl = $this->generateFrontendUrl($objPage->row(), ((\Config::get('useAutoItem') && !\Config::get('disableAlias')) ?  '/%s' : '/items/%s'), $objPage->language);
		}
				
		$this->strLink = parent::getLink($objNews, $strUrl);
		
		return $this->strLink;
	}
}
