<?php
/**
 * OpenSeadragon (based on DPLA fork of the ZoomIt plugin)
 *
 * @copyright Copyright 2014 Digital Public Library of America
 * @copyright Copyright 2007-2012 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

function openseadragon_create_pyramid($image)
{
    $sizes = array('original', 'fullsize', 'thumbnail');
    $pyramid = array();
    foreach ($sizes as $size) {
        $pyramid[] = openseadragon_pyramid_level($image, $size);
    }
    return json_encode($pyramid);
}

function openseadragon_pyramid_level($image, $size='original')
{
    $url = array('url' => $image->getWebPath($size));
    $dimensions = openseadragon_dimensions($image, $size);
    $level = $url + $dimensions;
    return $level;
}

function openseadragon_dimensions($image, $size='original')
{
    // First, fetch the metadata for the original, just because it might be relevant
    $stored_md = json_decode($image->metadata, true);

    // If we're getting the level hash for the original, trust the stored ID3 data
    if (($size == 'original') && ($md = _dimensions_from_id3($stored_md))) {
        return $md;
    }

    // If it's not an original, or there was no stored ID3 data
    if ($md = _dimensions_from_id3(_osd_getId3($image, $size))) {
        return $md;
    }

    // If all else fails and it's not an original, bodge together the dimensions
    // from the size constraints. NOTE:: this has an adverse impact on aspect
    // ratio.
    if ($size != 'original') {
        return array(
            'width' => (int) get_option($size.'_constraint'),
            'height' => (int) get_option($size.'_constraint')
        );
    }
    // If all else fails, just throw back null, because we don't know what to do
    else {
        return array('width' => null, 'height' => null);
    }
}

function _dimensions_from_id3($source)
{
    if ((isset($source['video']))
    && (isset($source['video']['resolution_x']))
    && (isset($source['video']['resolution_y'])))
    {
        return array(
            'width' => $source['video']['resolution_x'],
            'height' => $source['video']['resolution_y']
            );
    } else {
        return false;
    }
}

function _osd_getId3($image, $size='original')
{
    require_once 'getid3/getid3.php';
    $id3 = new getID3;
    $id3->encoding = 'UTF-8';
    try {
        $id3->Analyze(FILES_DIR.'/'.$image->getStoragePath($size));
        getid3_lib::CopyTagsToComments($id3->info);
        $metadata = array();
        $keys = array(
            'mime_type', 'audio', 'video', 'comments', 'comments_html',
            'iptc', 'jpg'
        );
        foreach($keys as $key) {
            if (array_key_exists($key, $id3->info)) {
                $metadata[$key] = $id3->info[$key];
            }
        }
        return $metadata;
    } catch (getid3_exception $e) {
        $message = $e->getMessage();
        _log("getID3: $message");
        return false;
    }
}