<?php

namespace Pikselin\ImageBlock\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;

class Image extends BaseElement
{
    use Configurable;

    private static $singular_name = 'Image';
    private static $plural_name = 'Images';
    private static $description = 'Image';
    private static $icon = 'font-icon-image';
    private static $table_name = 'ElementImage';

    private static $db = [
        'Caption' => 'Text',
    ];

    private static $has_one = [
        'FeatureImage' => \SilverStripe\Assets\Image::class,
    ];

    private static $owns = [
        'FeatureImage',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            $imageField = UploadField::create('FeatureImage', 'Image')
                ->setAllowedFileCategories('image')
                ->setIsMultiUpload(false)
                ->setFolderName($this->config()->get('folder_name'))
        );
        // check config to see if specific file types have been set
        if ($this->getAllowedFileTypes()) {
            $imageField->setAllowedExtensions($this->getAllowedFileTypes());
        }

        $fields->addFieldToTab(
            'Root.Main',
            LiteralField::create(
                'AltText',
                '<p class="alert alert-info">Make sure to add an alt text to the image if you have just uploaded a new'
                . " image. You can do this by clicking on the eye icon and then the 'Details' button on the right pane"
                . " of the Images popup. You should be now be able to add the alt text to the 'Alternative text' field"
                . " just under the 'Title' field. Make sure to publish the changes afterwards.</p>"
            )
        );

        $fields->addFieldToTab(
            'Root.Main',
            TextField::create('Caption', 'Caption')
        );

        return $fields;

    }

    public function getCMSValidator()
    {
        return new RequiredFields([
            'FeatureImage',
        ]);
    }

    public function getType()
    {
        return 'Image';
    }

    public function getSummary()
    {
        if ($this->FeatureImage()->exists()) {
            return DBField::create_field('HTMLText', $this->FeatureImage()->Name)->Summary(20);
        }
    }

    /**
     * Provides a summary to the gridfield.
     *
     * @return array
     * @throws \SilverStripe\ORM\ValidationException
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * Grab the allowed file types from config.
     * No fallback needed because setAllowedFileCategories('image') is already set.
     *
     * @return mixed|string[]
     */
    public function getAllowedFileTypes()
    {
        if (!empty($this->config()->get("allowed_extensions"))) {
            $types = $this->config()->get("allowed_extensions");
            $types = array_unique($types);
            return $types;
        }

        return false;
    }

    /**
     * Grab the value from config/yml file.
     *
     * @return mixed
     */
    public function UseResponsiveImages()
    {
        return $this->config()->get("use_responsive_images");
    }
}
