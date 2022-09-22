# Pikselin Image elemental

An elemental block with an image and caption.

Features:
- allows for an image, alt text and caption
- uses responsive images (picture tags) via the `heyday/silverstripe-responsive-images` module
- includes CSS that can be easily overridden
- includes an extension for the controller that does the requirements call for the CSS.
- adds an alt text field to the image object via the `purplespider/asset-alt-text` module

## Installation
This module only works with SilverStripe 4.x.

`composer require pikselin/silverstripe-elemental-image`

Run `dev/build` afterwards.

## Requirements
These can be found in the composer.json file.

## Configuration
Admin uppload field option configuration can be found here:
`_config/config.yml`

Default responsive image config can be overridden by making sure your yml file specifies that it is after this yml file:
`_config/responsive_image.yml`

## Templates
You can override the default template by copying `templates/Pikselin/ImageBlock/Elements/Image.ss` to your own theme.

## CSS
Base styles can be found in:
`client/css/image.css`

## Notes
This module already activates the CSS files in the PageController via the `ImageControllerExtension.php` extension.
