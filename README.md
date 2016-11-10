# Article Elements Teaser Pattern
####Contao 4 contentblocks extension to add teaser functionality to articles and news
---

###Installation:

Use composer to add package to your framework
```
composer require agoat/teaserpattern-bundle
```

Add to app/AppKernel.php (after 'new Contao\CoreBundle\ContaoCoreBundle()')
```
new Agoat\TeaserPatternBundle\AgoatTeaserPatternBundle()
```
