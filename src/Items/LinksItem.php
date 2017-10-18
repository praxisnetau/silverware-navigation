<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Navigation\Items
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */

namespace SilverWare\Navigation\Items;

use SilverStripe\Forms\DropdownField;
use SilverWare\Extensions\Style\CornerStyle;
use SilverWare\Extensions\Style\LinkColorStyle;
use SilverWare\Forms\FieldSection;
use SilverWare\Model\Link;
use SilverWare\Navigation\Model\BarItem;
use Page;

/**
 * An extension of the bar item class for a links item.
 *
 * @package SilverWare\Navigation\Items
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class LinksItem extends BarItem
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Links Item';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Links Items';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A bar item to show a series of links';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BarItem::class;
    
    /**
     * Defines the default child class for this object.
     *
     * @var string
     * @config
     */
    private static $default_child = Link::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'IconSize' => 'Int'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'IconSize' => 24
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = [
        Link::class
    ];
    
    /**
     * Defines the extension classes to apply to this object.
     *
     * @var array
     * @config
     */
    private static $extensions = [
        CornerStyle::class,
        LinkColorStyle::class
    ];
    
    /**
     * Defines the style extension classes to apply to this object.
     *
     * @var array
     * @config
     */
    private static $apply_styles = 'none';
    
    /**
     * Answers a list of field objects for the CMS interface.
     *
     * @return FieldList
     */
    public function getCMSFields()
    {
        // Obtain Field Objects (from parent):
        
        $fields = parent::getCMSFields();
        
        // Create Style Fields:
        
        $fields->addFieldsToTab(
            'Root.Style',
            [
                FieldSection::create(
                    'IconStyle',
                    $this->fieldLabel('IconStyle'),
                    [
                        DropdownField::create(
                            'IconSize',
                            $this->fieldLabel('IconSize'),
                            Link::singleton()->getIconSizeOptions()
                        )
                    ]
                )
            ]
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers the labels for the fields of the receiver.
     *
     * @param boolean $includerelations Include labels for relations.
     *
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        // Obtain Field Labels (from parent):
        
        $labels = parent::fieldLabels($includerelations);
        
        // Define Field Labels:
        
        $labels['IconSize'] = _t(__CLASS__ . '.ICONSIZEINPIXELS', 'Icon size (in pixels)');
        $labels['IconStyle'] = _t(__CLASS__ . '.ICON', 'Icon');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = ['links'];
        
        $this->extend('updateWrapperClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of list class names for the HTML template.
     *
     * @return array
     */
    public function getListClassNames()
    {
        $classes = ['links', 'show-icons', 'hide-text'];
        
        $this->extend('updateListClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers the CSS prefix used for the custom CSS template.
     *
     * @return string
     */
    public function getCustomCSSPrefix()
    {
        return sprintf('%s ul.links > li > a.link', $this->CSSID);
    }
    
    /**
     * Answers a list of all links within the receiver.
     *
     * @return DataList
     */
    public function getLinks()
    {
        return $this->getAllChildren();
    }
    
    /**
     * Answers a list of the enabled links within the receiver.
     *
     * @return ArrayList
     */
    public function getEnabledLinks()
    {
        return $this->getLinks()->filterByCallback(function ($link) {
            return $link->isEnabled();
        });
    }
}
