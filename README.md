# Article teaser pattern
Contao 4 contentblocks extension to add teaser functionality to articles
---

###Installation:

Use composer to add package to your framework
```
composer require agoat/articleteaser-bundle
```

Add to app/AppKernel.php (after 'new Contao\CoreBundle\ContaoCoreBundle()')
```
new Agoat\ArticleTeaserBundle\AgoatArticleTeaserBundle()
```
