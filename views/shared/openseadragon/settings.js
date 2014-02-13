
function osdSettings(cfg) {
    OpenSeadragon.DEFAULT_SETTINGS.showNavigationControl = true; 
    OpenSeadragon.DEFAULT_SETTINGS.navigationControlAnchor = OpenSeadragon.ControlAnchor.BOTTOM_RIGHT;
    return {
    id: cfg._id,
    prefixUrl: cfg.prefixUrl,
    minZoomImageRatio: 0.8,
    maxZoomPixelRatio: 2,
    autoHideControls: false,
    animationTime: 1.5,
    blendTime: 0.5,
    constrainDuringPan: true,
    springStiffness: 5,
    visibilityRatio: 0.8,
    }
}
