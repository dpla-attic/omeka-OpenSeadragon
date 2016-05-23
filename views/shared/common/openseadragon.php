<?php $button_path = src('images/', 'openseadragon');?>
<div class="openseadragon">
    <?php
    foreach($images as $image):
        $image_url = html_escape($image->getWebPath('original'));
        $unique_id = "openseadragon_".hash("md4", $image_url);
       ?>
    <div class="openseadragon_viewer" id="<?=$unique_id?>">
        <img src="<?=$image_url?>" class="openseadragon-image tmp-img" alt="">
    </div>

    <script type="text/javascript">
        var config = { // shared/openseadragon/settings.js
            <?php if (isset($options['showRotate']) && $options['showRotate']): ?>
            showRotationControl: true,
            gestureSettingsTouch: {
                pinchRotate: true
            },
            <?php endif; ?>
            id: "<?=$unique_id?>",
            prefixUrl: "<?=$button_path?>"
        };
        var viewer = OpenSeadragon(config);
        var ts = new OpenSeadragon.LegacyTileSource(<?php
            echo openseadragon_create_pyramid($image); ?>);
        viewer.open(ts);
    </script>
    <?php endforeach; ?>
</div>