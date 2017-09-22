<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */

namespace SilverWare\Navigation\Components;

use SilverStripe\Forms\TextField;
use SilverWare\Components\BaseComponent;
use SilverWare\Extensions\Style\AlignmentStyle;
use SilverWare\Forms\FieldSection;
use SilverWare\Model\Button;

/**
 * An extension of the base component class for button navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class ButtonNavigation extends BaseComponent
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Button Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Button Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component to show navigation as a series of buttons';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware-navigation/admin/client/dist/images/icons/ButtonNavigation.png';
    
    /**
     * Defines the default child class for this object.
     *
     * @var string
     * @config
     */
    private static $default_child = Button::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'ButtonMargin' => 'AbsoluteInt',
        'ButtonPaddingX' => 'AbsoluteInt',
        'ButtonPaddingY' => 'AbsoluteInt'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'HideTitle' => 1,
        'ButtonMargin' => 10
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = [
        Button::class
    ];
    
    /**
     * Defines the extension classes to apply to this object.
     *
     * @var array
     * @config
     */
    private static $extensions = [
        AlignmentStyle::class
    ];
    
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
                    'NavigationStyle',
                    $this->fieldLabel('NavigationStyle'),
                    [
                        TextField::create(
                            'ButtonMargin',
                            $this->fieldLabel('ButtonMargin')
                        ),
                        TextField::create(
                            'ButtonPaddingX',
                            $this->fieldLabel('ButtonPaddingX')
                        ),
                        TextField::create(
                            'ButtonPaddingY',
                            $this->fieldLabel('ButtonPaddingY')
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
        
        $labels['ButtonMargin'] = _t(__CLASS__ . '.BUTTONMARGININPIXELS', 'Button margin (in pixels)');
        $labels['ButtonPaddingX'] = _t(__CLASS__ . '.BUTTONPADDINGXINPIXELS', 'Button padding (x-axis, in pixels)');
        $labels['ButtonPaddingY'] = _t(__CLASS__ . '.BUTTONPADDINGYINPIXELS', 'Button padding (y-axis, in pixels)');
        $labels['NavigationStyle'] = _t(__CLASS__ . '.NAVIGATION', 'Navigation');
        
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
        $classes = ['button'];
        
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
        $classes = ['buttons'];
        
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
        return sprintf('%s ul.buttons > li > a.button', $this->CSSID);
    }
    
    /**
     * Answers a list of all buttons within the receiver.
     *
     * @return DataList
     */
    public function getButtons()
    {
        return $this->getAllChildren();
    }
    
    /**
     * Answers a list of the enabled buttons within the receiver.
     *
     * @return ArrayList
     */
    public function getEnabledButtons()
    {
        return $this->getButtons()->filterByCallback(function ($button) {
            return $button->isEnabled();
        });
    }
}
