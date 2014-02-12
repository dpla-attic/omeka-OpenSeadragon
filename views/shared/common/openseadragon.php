<?php
$unique_id = "openseadragon_".hash("md4", $images[0]->getWebPath('original'));
$btn_path = src('images/', 'openseadragon');
//$cache_param = html_escape(Zend_Registry::get('bootstrap')->getResource('Config')->dpla->openseadragon->update_cache_param);
?>

<div class="openseadragon">
    <div class="openseadragon_viewer" id="<?=$unique_id?>"
        data-api-url="<?=$btn_path?>home_pressed.png"> <!-- FIXME -->
        <?php foreach($images as $image): 
           $metadata = json_decode($image->metadata, true)?>
            <img src="<?php echo html_escape($image->getWebPath('original')); ?>"
            data-original="<?php echo html_escape($image->getWebPath('original')); ?>"
            class="openseadragon-image tmp-img" alt="">
        <?php endforeach; ?>
    <script type="text/javascript">
        var viewer = OpenSeadragon({
        id:              "<?=$unique_id?>",
        prefixUrl:       "<?=$btn_path?>",
        tileSources: {
            type: 'legacy-image-pyramid',
            // TODO: Add logic that checks the file type of original; if it's a TIFF,
            //       fail gracefully by not including the original in the image pyramid
            levels:[{
                url: "<?=$images[0]->getWebPath('original')?>",
                height: <?= $metadata['video']['resolution_y'] ?>,
                width: <?= $metadata['video']['resolution_x'] ?>
            }, {
                url: "<?=$images[0]->getWebPath('fullsize')?>",
                height: <?php echo get_option('fullsize_constraint'); ?>,
                width: <?php echo get_option('fullsize_constraint'); ?>
            }, {
                url: "<?=$images[0]->getWebPath('thumbnail')?>",
                height: <?php echo get_option('thumbnail_constraint'); ?>,
                width: <?php echo get_option('thumbnail_constraint'); ?>
            }
            ]
        },
        showNavigationControl:   true, 
        navigationControlAnchor: OpenSeadragon.ControlAnchor.BOTTOM_RIGHT,
        minZoomImageRatio: 0.8,
        maxZoomPixelRatio: 2,
        autoHideControls: false
    });
    // </script>
</div>
</div>