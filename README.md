CocurPageBundle
===============

Loads content from a [Gaufrette](https://github.com/KnpLabs/Gaufrette) filesystem, compiles various markup languages into HTML and renders pages using a [Symfony2 Templating](https://github.com/symfony/Templating) compatible engine.

[![Build Status](https://travis-ci.org/cocur/page-bundle.png?branch=master)](https://travis-ci.org/cocur/page-bundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/cocur/page-bundle/badges/quality-score.png?s=c5624aea97041219d02f05b321e9f19bdc3a15a7)](https://scrutinizer-ci.com/g/cocur/page-bundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/cocur/page-bundle/badges/coverage.png?s=9579c8d4940c5f87835d559a4350c4b767805a7d)](https://scrutinizer-ci.com/g/cocur/page-bundle/)


Features
--------

### Content Loaders

In theory content can be loaded from every filesystem supported by Gaufrette. In practice only the local filesystem
is fully supported and tested and other filesystems might require additional packages, configuration or even some
code to work properly.

Some filesystems supported by Gaufrette are:

- Amazon S3
- Databases compatible with Doctrine DBAL
- Dropbox
- FTP
- Rackspace

Gaufrette is exensible and additional filesystems can be added.

### Front Matter Parsers

The front matter are options for a page or piece of content. Currently the following formats are supported:

- JSON
- YAML

### Compilers

CocurPageBundle supports a number of different markup systems to write content in. Compilers take the markup and
generate the HTML. The compiler is selected on a per file basis depending on the file extension. The following formats are currently supported:

- Markdown (`.md` and `.markdown`) and Markdown Extra (`.mdx`)
- HTML (`.htm` and `.html`)
- Plain text (`.txt`)

### Renderes

The bundle uses Symfony2 Templating to render page. Therefore you can use any templating engine that has support for
Symfony2 templating.


Events
------

- `cocur_page.pre_load`: `PreLoadEvent` is dispatched before the content is loaded from the filesystem. The event constructor takes the key as argument.
- `cocur_page.post_load`: `PostLoadEvent` is dispatched immediately after the content is loaded. The content is the only argument the event constructor expects.
- `cocur_page.pre_compile`: `PreCompileEvent` is dispatched before the content is compiled and the constructor takes the content as argument.
- `cocur_page.post_compile`: `PostCompileEvent` is dispatched after the content is compiled and takes an array of variables as argument. The compiled content is stored at index `content`.
- `cocur_page.pre_render`: `PreRenderEvent` is dispatched before the content is rendered and takes an array of variables as argument.
- `cocur_page.post_render`: `PostRenderEvent` is dispatched after the content is rendered and takes an instance of `Response` as argument.


Credits
-------

- [Florian Eckerstorfer](http://florian.ec) ([Twitter](http://twitter.com/Florian_), [App.net](http://app.net/florian))


License
-------

This package is subject to the MIT license that is bundled with this package in the file LICENSE.

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/cocur/page-bundle/trend.png)](https://bitdeli.com/free "Bitdeli Badge")