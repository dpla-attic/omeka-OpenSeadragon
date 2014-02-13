OpenSeadragon plugin for Omeka
===

This is a plugin for Omeka 2.x that adds an [OpenSeadragon](http://openseadragon.github.io)
zoomable image viewer, usable on item pages and exhibits. It uses OpenSeadragon's
support for ["legacy image pyramids"](http://openseadragon.github.io/examples/tilesource-legacy/)
to pull in original, fullsize, and thumbnail images from Omeka.

This plugin was based on the [ZoomIt Omeka plugin](https://github.com/omeka/plugin-Zoomit), and
the fork used in the [DPLA Exhibitions](https://github.com/dpla/exhibitions) codebase.

**Known issues:**

* Does not work with TIFF images.
* Relies on a bogus XHR (legacy of the ZoomIt plugin on which it's based)
* Requires php-GD module

**Links:**

* [Release History](https://github.com/dpla/omeka-OpenSeadragon/wiki/Release-History)