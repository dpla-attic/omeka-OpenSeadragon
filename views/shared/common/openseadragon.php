<?php $button_path = src('images/', 'openseadragon');?>
<div class="openseadragon">
    <?php
    foreach($images as $image):
        $image_url = $image->getWebPath('original');
        $unique_id = "openseadragon_".hash("md4", $image_url);
        $metadata = json_decode($image->metadata, true);
        $image_url_esc = html_escape($image_url);
       ?>
    <div class="openseadragon_viewer" id="<?=$unique_id?>"
        data-api-url="<?=$button_path?>home_pressed.png"> <!-- FIXME -->
        <img src="<?=$image_url_esc?>" data-original="<?=$image_url_esc?>"
        class="openseadragon-image tmp-img" alt="">
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