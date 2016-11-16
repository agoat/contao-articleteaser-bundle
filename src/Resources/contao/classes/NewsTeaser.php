<?php

/**
 * Contao Open Source CMS Extension
 *
 * @package  	 Teaser (Content block pattern)
 * @author   	 Arne Stappen
 * @license  	 LGPL-3.0+ 
 * @copyright	 Arne Stappen (2016)
 */
 
namespace Agoat\TeaserPattern;

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
		
		$this->strLink = $this->generateNewsUrl($objNews, true);

		return $this->strLink;
	}
}
