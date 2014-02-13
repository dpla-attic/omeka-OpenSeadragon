<?php
/**
 * OpenSeadragon (based on DPLA fork of the ZoomIt plugin)
 * 
 * @copyright Copyright 2014 Digital Public Library of America
 * @copyright Copyright 2007-2012 Roy Rosenzweig Center for History and New Media
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */


require_once dirname(__FILE__) . '/helpers/OpenSeadragonFunctions.php';

/**
 * The OpenSeadragon plugin.
 * 
 * @package Omeka\Plugins\OpenSeadragon
 */
class OpenSeadragonPlugin extends Omeka_Plugin_AbstractPlugin
{
    const DEFAULT_VIEWER_EMBED = 1;
    
    const DEFAULT_VIEWER_WIDTH = 500;
    
    const DEFAULT_VIEWER_HEIGHT = 600;

    const DEFAULT_CSS_OVERRIDE = 1;
    
    protected $_hooks = array(
        'install', 
        'uninstall', 
        'initialize', 
        'upgrade', 
        'config_form', 
        'config', 
        'admin_items_show', 
        'public_items_show', 
        'admin_head',
        'public_head'
    );
    
    protected $_options = array(
        'openseadragon_embed_admin' => self::DEFAULT_VIEWER_EMBED, 
        'openseadragon_width_admin' => self::DEFAULT_VIEWER_WIDTH, 
        'openseadragon_height_admin' => self::DEFAULT_VIEWER_HEIGHT, 
        'openseadragon_embed_public' => self::DEFAULT_VIEWER_EMBED, 
        'openseadragon_css_override_public' => self::DEFAULT_CSS_OVERRIDE,
        'openseadragon_width_public' => self::DEFAULT_VIEWER_WIDTH, 
        'openseadragon_height_public' => self::DEFAULT_VIEWER_HEIGHT, 
    );
    
    /**
     * Install the plugin.
     */
    public function hookInstall()
    {
        $this->_installOptions();
    }
   
    /**
     * Unnstall the plugin.
     */
    public function hookUninstall()
    {
        $this->_uninstallOptions();
    }
    
    
    /**
     * Initialize the plugin.
     */
    public function hookInitialize()
    {
        // Add translation.
        add_translation_source(dirname(__FILE__) . '/languages');
    }
    
    /**
     * Upgrade the plugin.
     */
    public function hookUpgrade($args)
    {
        // Version 2.0 introduced image viewer embed flags.
        if (version_compare($args['old_version'], '2.0', '<')) {
            set_option('openseadragon_embed_admin', self::DEFAULT_VIEWER_EMBED);
            set_option('openseadragon_embed_public', self::DEFAULT_VIEWER_EMBED);
        }
    }
    
    /**
     * Display the config form.
     */
    public function hookConfigForm()
    {
        echo get_view()->partial('plugins/openseadragon-config-form.php');
    }
    
    /**
     * Handle the config form.
     */
    public function hookConfig()
    {
        if (!is_numeric($_POST['openseadragon_width_admin']) || 
            !is_numeric($_POST['openseadragon_height_admin']) || 
            !is_numeric($_POST['openseadragon_width_public']) || 
            !is_numeric($_POST['openseadragon_height_public'])) {
            throw new Omeka_Validate_Exception('The width and height must be numeric.');
        }
        set_option('openseadragon_embed_admin', (int) (boolean) $_POST['openseadragon_embed_admin']);
        set_option('openseadragon_width_admin', $_POST['openseadragon_width_admin']);
        set_option('openseadragon_height_admin', $_POST['openseadragon_height_admin']);
        set_option('openseadragon_embed_public', (int) (boolean) $_POST['openseadragon_embed_public']);
        set_option('openseadragon_css_override_public', (int) (boolean) $_POST['openseadragon_css_override_public']);
        set_option('openseadragon_width_public', $_POST['openseadragon_width_public']);
        set_option('openseadragon_height_public', $_POST['openseadragon_height_public']);
    }
    
    /**
     * Display the image viewer in admin items/show.
     */
    public function hookAdminItemsShow($args)
    {
        // Embed viewer only if configured to do so.
        if (!get_option('openseadragon_embed_admin')) {
            return;
        }
        echo $args['view']->openseadragon($args['item']->Files);
    }
    
    /**
     * Display the image viewer in public items/show.
     */
    public function hookPublicItemsShow($args)
    {
        // Embed viewer only if configured to do so.
        if (!get_option('openseadragon_embed_public')) {
            return;
        }
        echo $args['view']->openseadragon($args['item']->Files);
    }

    private function _osd_css($width, $height)
    {
        return ".openseadragon { width: ".$width."px; height: ".$height."px};";
    }

    public function hookAdminHead($args)
    {
        $this->_head();
        queue_css_string($this->_osd_css(get_option('openseadragon_width_admin'), get_option('openseadragon_height_admin')));
    }

    public function hookPublicHead($args)
    {
        $this->_head();
        if (!get_option('openseadragon_css_override_public')) {
            queue_css_string($this->_osd_css(get_option('openseadragon_width_public'), get_option('openseadragon_height_public')));
        }
    }

    /* 
     * Uses a pre-release version of OpenSeadragon to provide positioning of nav
     *
     * @see https://github.com/openseadragon/openseadragon/tree/9ecb69e
     */
    private function _head()
    {
        queue_css_file('openseadragon', 'screen', false, 'openseadragon');
        queue_js_file('openseadragon.min', 'openseadragon');
        queue_js_file('settings', 'openseadragon');
    }

    public function openseadragon_pyramid($image, $size)
    {
        return openseadragon_create_pyramid($image, $size);
    }
}
