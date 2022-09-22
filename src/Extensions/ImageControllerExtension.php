<?php

namespace Pikselin\ImageBlock\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

/**
 * Adds css requirement directive
 */
class ImageControllerExtension extends Extension
{
    public function onAfterInit() {
        Requirements::css('pikselin/silverstripe-elemental-image:client/css/image.css');
    }
}
