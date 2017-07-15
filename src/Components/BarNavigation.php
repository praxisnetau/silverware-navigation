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

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextField;
use SilverWare\Components\BaseComponent;
use SilverWare\Forms\FieldSection;
use SilverWare\Forms\PageDropdownField;
use SilverWare\Forms\ViewportField;
use SilverWare\Navigation\Model\BarItem;
use Page;

/**
 * An extension of the base component class for bar navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class BarNavigation extends BaseComponent
{
    /**
     * Define button alignment constants.
     */
    const BUTTON_ALIGN_LEFT  = 'left';
    const BUTTON_ALIGN_RIGHT = 'right';
    
    /**
     * Define position constants.
     */
    const POSITION_FIXED_TOP    = 'fixed-top';
    const POSITION_FIXED_BOTTOM = 'fixed-bottom';
    
    /**
     * Define background constants.
     */
    const BG_PRIMARY = 'primary';
    const BG_INVERSE = 'inverse';
    
    /**
     * Define foreground constants.
     */
    const FG_LIGHT = 'light';
    const FG_DARK  = 'dark';
    
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Bar Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Bar Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A customisable navigation bar component';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware-navigation/admin/client/dist/images/icons/BarNavigation.png';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BaseComponent::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'BrandText' => 'Varchar(128)',
        'Background' => 'Varchar(16)',
        'Foreground' => 'Varchar(16)',
        'ButtonLabel' => 'Varchar(128)',
        'ButtonAlignment' => 'Varchar(8)',
        'BrandLinkDisabled' => 'Boolean',
        'Position' => 'Varchar(16)',
        'ToggleOn' => 'Varchar(8)'
    ];
    
    /**
     * Defines the has-one associations for this object.
     *
     * @var array
     * @config
     */
    private static $has_one = [
        'BrandPage' => Page::class
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'Background' => 'primary',
        'Foreground' => 'light',
        'BrandLinkDisabled' => 0,
        'ButtonAlignment' => 'right',
        'ToggleOn' => 'medium',
        'HideTitle' => 1
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = [
        BarItem::class
    ];
    
    /**
     * Maps field and method names to the class names of casting objects.
     *
     * @var array
     * @config
     */
    private static $casting = [
        'ButtonAttributesHTML' => 'HTMLFragment'
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
        
        // Create Main Fields:
        
        $fields->addFieldsToTab(
            'Root.Main',
            [
                TextField::create(
                    'BrandText',
                    $this->fieldLabel('BrandText')
                ),
                PageDropdownField::create(
                    'BrandPageID',
                    $this->fieldLabel('BrandPageID')
                ),
                TextField::create(
                    'ButtonLabel',
                    $this->fieldLabel('ButtonLabel')
                )
            ]
        );
        
        // Define Placeholder:
        
        $placeholder = _t(__CLASS__ . '.DROPDOWNDEFAULT', '(default)');
        
        // Create Style Fields:
        
        $fields->addFieldToTab(
            'Root.Style',
            FieldSection::create(
                'NavigationStyle',
                $this->fieldLabel('NavigationStyle'),
                [
                    DropdownField::create(
                        'Background',
                        $this->fieldLabel('Background'),
                        $this->getBackgroundOptions()
                    )->setEmptyString(' ')->setAttribute('data-placeholder', $placeholder),
                    DropdownField::create(
                        'Foreground',
                        $this->fieldLabel('Foreground'),
                        $this->getForegroundOptions()
                    )->setEmptyString(' ')->setAttribute('data-placeholder', $placeholder),
                    DropdownField::create(
                        'ButtonAlignment',
                        $this->fieldLabel('ButtonAlignment'),
                        $this->getButtonAlignmentOptions()
                    )->setEmptyString(' ')->setAttribute('data-placeholder', $placeholder),
                    DropdownField::create(
                        'Position',
                        $this->fieldLabel('Position'),
                        $this->getPositionOptions()
                    )->setEmptyString(' ')->setAttribute('data-placeholder', $placeholder)
                ]
            )
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            FieldSection::create(
                'NavigationOptions',
                $this->fieldLabel('NavigationOptions'),
                [
                    ViewportField::create(
                        'ToggleOn',
                        $this->fieldLabel('ToggleOn')
                    )->setRightTitle(
                        _t(
                            __CLASS__ . '.TOGGLEONRIGHTTITLE',
                            'Specifies the maximum viewport size to activate toggle.'
                        )
                    ),
                    CheckboxField::create(
                        'BrandLinkDisabled',
                        $this->fieldLabel('BrandLinkDisabled')
                    )
                ]
            )
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
        
        $labels['ToggleOn'] = _t(__CLASS__ . '.TOGGLEON', 'Toggle on');
        $labels['BrandText'] = _t(__CLASS__ . '.BRANDTEXT', 'Brand text');
        $labels['BrandPageID'] = _t(__CLASS__ . '.BRANDPAGE', 'Brand page');
        $labels['ButtonLabel'] = _t(__CLASS__ . '.BUTTONLABEL', 'Button label');
        $labels['ButtonAlignment'] = _t(__CLASS__ . '.BUTTONALIGNMENT', 'Button alignment');
        $labels['BrandLinkDisabled'] = _t(__CLASS__ . '.BRANDLINKDISABLED', 'Brand link disabled');
        $labels['NavigationStyle'] = $labels['NavigationOptions'] = _t(__CLASS__ . '.NAVIGATION', 'Navigation');
        
        // Define Relation Labels:
        
        if ($includerelations) {
            $labels['BrandPage'] = _t(__CLASS__ . '.has_one_BrandPage', 'Brand Page');
        }
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Populates the default values for the fields of the receiver.
     *
     * @return void
     */
    public function populateDefaults()
    {
        // Populate Defaults (from parent):
        
        parent::populateDefaults();
        
        // Populate Defaults:
        
        $this->ButtonLabel = _t(__CLASS__ . '.TOGGLENAVIGATION', 'Toggle Navigation');
    }
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = $this->styles('navbar');
        
        $classes[] = $this->style('navbar', sprintf('toggleable-%s', $this->ToggleOn));
        
        if ($this->Background) {
            $classes[] = $this->style('background', $this->Background);
        }
        
        if ($this->Foreground) {
            $classes[] = $this->style('navbar', sprintf('fg-%s', $this->Foreground));
        }
        
        if ($this->Position) {
            $classes[] = $this->style('position', $this->Position);
        }
        
        $this->extend('updateWrapperClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of button class names for the HTML template.
     *
     * @return array
     */
    public function getButtonClassNames()
    {
        $classes = $this->styles('navbar.button');
        
        if ($this->ButtonAlignment) {
            $classes[] = $this->style('navbar', sprintf('button-%s', $this->ButtonAlignment));
        }
        
        $this->extend('updateButtonClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of HTML tag attributes for the button.
     *
     * @return array
     */
    public function getButtonAttributes()
    {
        $attributes = [
            'type' => 'button',
            'class' => $this->ButtonClass,
            'title' => $this->ButtonLabel,
            'aria-label' => $this->ButtonLabel,
            'aria-expanded' => 'false',
            'aria-controls' => $this->CollapseHTMLID,
            'data-target' => $this->CollapseCSSID,
            'data-toggle' => 'collapse'
        ];
        
        $this->extend('updateButtonAttributes', $attributes);
        
        return $attributes;
    }
    
    /**
     * Answers the HTML tag attributes for the button as a string.
     *
     * @return string
     */
    public function getButtonAttributesHTML()
    {
        return $this->getAttributesHTML($this->getButtonAttributes());
    }
    
    /**
     * Answers an array of button icon class names for the HTML template.
     *
     * @return array
     */
    public function getButtonIconClassNames()
    {
        $classes = $this->styles('navbar.button-icon');
        
        $this->extend('updateButtonIconClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of brand class names for the HTML template.
     *
     * @return array
     */
    public function getBrandClassNames()
    {
        $classes = $this->styles('navbar.brand');
        
        $this->extend('updateBrandClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers true if the receiver has an brand link.
     *
     * @return boolean
     */
    public function hasBrandLink()
    {
        return (boolean) $this->getBrandLink();
    }
    
    /**
     * Answers the brand link for the receiver.
     *
     * @return string
     */
    public function getBrandLink()
    {
        if ($this->BrandPageID) {
            return $this->BrandPage()->Link();
        }
    }
    
    /**
     * Answers the brand URL for the HTML template.
     *
     * @return string
     */
    public function getBrandURL()
    {
        return ($this->hasBrandLink() && !$this->BrandLinkDisabled) ? $this->getBrandLink() : '#';
    }
    
    /**
     * Answers an array of collapse class names for the HTML template.
     *
     * @return array
     */
    public function getCollapseClassNames()
    {
        $classes = $this->styles('navbar.collapse', 'collapse');
        
        $this->extend('updateCollapseClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers a unique ID for the collapse element.
     *
     * @return string
     */
    public function getCollapseID()
    {
        return sprintf('%s_Collapse', $this->getHTMLID());
    }
    
    /**
     * Answers a unique CSS ID for the collapse element.
     *
     * @return string
     */
    public function getCollapseCSSID()
    {
        return $this->getCSSID($this->getCollapseID());
    }
    
    /**
     * Answers a list of all items within the receiver.
     *
     * @return DataList
     */
    public function getItems()
    {
        return $this->AllChildren();
    }
    
    /**
     * Answers a list of the enabled items within the receiver.
     *
     * @return ArrayList
     */
    public function getEnabledItems()
    {
        return $this->getItems()->filterByCallback(function ($item) {
            return $item->isEnabled();
        });
    }
    
    /**
     * Answers the first enabled item found matching the given class name.
     *
     * @param string $class
     *
     * @return BarItem
     */
    public function getEnabledItemByClass($class)
    {
        return $this->getEnabledItems()->find('ClassName', $class);
    }
    
    /**
     * Answers an array of options for the background field.
     *
     * @return array
     */
    public function getBackgroundOptions()
    {
        return [
            self::BG_PRIMARY => _t(__CLASS__ . '.PRIMARY', 'Primary'),
            self::BG_INVERSE => _t(__CLASS__ . '.INVERSE', 'Inverse')
        ];
    }
    
    /**
     * Answers an array of options for the foreground field.
     *
     * @return array
     */
    public function getForegroundOptions()
    {
        return [
            self::FG_LIGHT => _t(__CLASS__ . '.LIGHT', 'Light'),
            self::FG_DARK  => _t(__CLASS__ . '.DARK', 'Dark')
        ];
    }
    
    /**
     * Answers an array of options for the button alignment field.
     *
     * @return array
     */
    public function getButtonAlignmentOptions()
    {
        return [
            self::BUTTON_ALIGN_LEFT  => _t(__CLASS__ . '.LEFT', 'Left'),
            self::BUTTON_ALIGN_RIGHT => _t(__CLASS__ . '.RIGHT', 'Right')
        ];
    }
    
    /**
     * Answers an array of options for the position field.
     *
     * @return array
     */
    public function getPositionOptions()
    {
        return [
            self::POSITION_FIXED_TOP    => _t(__CLASS__ . '.FIXEDTOP', 'Fixed Top'),
            self::POSITION_FIXED_BOTTOM => _t(__CLASS__ . '.FIXEDBOTTOM', 'Fixed Bottom')
        ];
    }
}
