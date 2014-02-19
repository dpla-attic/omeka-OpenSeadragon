OpenSeadragon plugin for Omeka
===

This is a plugin for [Omeka](http://omeka.org/) 2.x that adds an zoomable
image viewer provided by [OpenSeadragon](http://openseadragon.github.io),
usable on item pages, exhibits, and the Omeka admin dashboard.

This plugin was originally based on the [ZoomIt plugin](https://github.com/omeka/plugin-Zoomit)
for Omeka, and the fork of that plugin used in the
[DPLA Exhibitions](https://github.com/dpla/exhibitions) codebase.

**Requirements**

* Omeka 2.0 or higher
* The `gd` (recommended) and/or the `exif` modules for PHP

**How it works**

Omeka uses ImageMagick to generate derivatives of any image added. For
example, if you have an high resolution JPEG image, it will treat that image
as the "original", and derive "fullsize" (medium resolution) images and
thumbnails automatically.

The OpenSeadragon plugin uses OpenSeadragon's support for
["legacy image pyramids"](http://openseadragon.github.io/examples/tilesource-legacy/)
to pull in those original, fullsize, and thumbnail images from Omeka. Since
OpenSeadragon requires the image size to be stated explicitly for images in
any image pyramid, we need to obtain the dimensions from each of the files,
either through metadata stored in the Omeka database for each file, or through
using either `gd` or `exif` functions.

**Known issues:**

Only works with original images in formats supported by OpenSeadragon's
LegacyTileSource class (JPEG, GIF, and PNG). Specifically, this impacts you
if you're using high resolution images in TIFF or JPEG 2000 (JP2) format.
If you want to load high resolution versions of these, you'll need to convert
them to a supported format or only rely on the `fullsize` and `thumbnail`
sizes.

**Installation**

* Transfer the Omeka OpenSeadragon zip file to your `/plugins` directory. 
* Extract the contents of the zip file. 
* Change the directory name from `omeka-OpenSeadragon-master` to `OpenSeadragon`.
* Log in to Omeka and visit the **Plugins** section.
* Enable OpenSeadragon and click **Configure** to enable the OpenSeadragon viewer on Admin and Public 'item show' pages.

**Links:**

* [Release History](https://github.com/dpla/omeka-OpenSeadragon/wiki/Release-History)
