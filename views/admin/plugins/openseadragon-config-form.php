<h2>Admin Theme</h2>

<div class="field">
    <div id="openseadragon_embed_admin_label" class="two columns alpha">
        <label for="openseadragon_embed_admin"><?php echo __('Embed viewer in admin item show pages?'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formCheckbox('openseadragon_embed_admin', null, 
        array('checked' => (bool) get_option('openseadragon_embed_admin'))); ?>
    </div>
</div>
<div class="field">
    <div id="openseadragon_width_admin_label" class="two columns alpha">
        <label for="openseadragon_width_admin"><?php echo __('Viewer width, in pixels'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('openseadragon_width_admin', get_option('openseadragon_width_admin')); ?>
    </div>
</div>
<div class="field">
    <div id="openseadragon_height_admin_label" class="two columns alpha">
        <label for="openseadragon_height_admin"><?php echo __('Viewer height, in pixels'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('openseadragon_height_admin', get_option('openseadragon_height_admin')); ?>
    </div>
</div>

<h2>Public Theme</h2>

<div class="field">
    <div id="openseadragon_embed_public_label" class="two columns alpha">
        <label for="openseadragon_embed_public"><?php echo __('Embed viewer in public item show pages?'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formCheckbox('openseadragon_embed_public', null, 
        array('checked' => (bool) get_option('openseadragon_embed_public'))); ?>
    </div>
</div>
<div class="field">
    <div id="openseadragon_width_public_label" class="two columns alpha">
        <label for="openseadragon_width_public"><?php echo __('Viewer width, in pixels'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('openseadragon_width_public', get_option('openseadragon_width_public')); ?>
    </div>
</div>
<div class="field">
    <div id="openseadragon_height_public_label" class="two columns alpha">
        <label for="openseadragon_height_public"><?php echo __('Viewer height, in pixels'); ?></label>
    </div>
    <div class="inputs five columns omega">
        <?php echo $this->formText('openseadragon_height_public', get_option('openseadragon_height_public')); ?>
    </div>
</div>
