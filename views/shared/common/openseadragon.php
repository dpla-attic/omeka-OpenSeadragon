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
        var config = osdSettings({ // shared/openseadragon/settings.js
            _id: "<?=$unique_id?>",
            prefixUrl: "<?=$button_path?>"
        });
        var viewer = OpenSeadragon(config);
        var ts = new OpenSeadragon.LegacyTileSource(<?php
            echo openseadragon_create_pyramid($image); ?>);
        viewer.openTileSource(ts);
    </script>
    <?php endforeach; ?>
</div>