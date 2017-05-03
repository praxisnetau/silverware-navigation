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
use SilverWare\Components\BaseComponent;
use SilverWare\FontIcons\Extensions\FontIconExtension;
use Page;

/**
 * An extension of the base component class for level navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class LevelNavigation extends BaseComponent
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Level Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Level Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which shows navigation for the current page level';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware-navigation/admin/client/dist/images/icons/LevelNavigation.png';
    
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
        'UseLevelTitle' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'UseLevelTitle' => 0
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = 'none';
    
    /**
     * Defines the extension classes to apply to this object.
     *
     * @var array
     * @config
     */
    private static $extensions = [
        FontIconExtension::class
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
        
        // Create Field Objects:
        
        $fields->fieldByName('Root.Options.TitleOptions')->push(
            CheckboxField::create(
                'UseLevelTitle',
                $this->fieldLabel('UseLevelTitle')
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
        
        $labels['UseLevelTitle'] = _t(__CLASS__ . '.USELEVELTITLE', 'Use title of current level for component title');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers the title of the component for the template.
     *
     * @return string
     */
    public function getTitleText()
    {
        if ($this->UseLevelTitle && ($level = $this->getLevel())) {
            return $level->MenuTitle;
        }
        
        return parent::getTitleText();
    }
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = ['level'];
        
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
        $classes = [];
        
        if ($this->hasFontIcon()) {
            $classes[] = 'fa-ul';
        }
        
        return $classes;
    }
    
    /**
     * Answers true to enable list item mode.
     *
     * @return boolean
     */
    public function getFontIconListItem()
    {
        return true;
    }
    
    /**
     * Answers the page object at the current level.
     *
     * @return SiteTree
     */
    public function getLevel()
    {
        if ($page = $this->getCurrentPage(Page::class)) {
            
            if (!$page->Children()->exists()) {
                
                $parent = $page->getParent();
                
                while ($parent && !$parent->Children()->exists()) {
                    $parent = $parent->getParent();
                }
                
                return $parent;
                
            }
            
            return $page;
            
        }
    }
    
    /**
     * Answers a list of the child pages within the current level.
     *
     * @return ArrayList
     */
    public function getCurrentLevel()
    {
        if ($level = $this->getLevel()) {
            return $level->Children();
        }
    }
    
    /**
     * Answers true if the object is disabled within the template.
     *
     * @return boolean
     */
    public function isDisabled()
    {
        if ($page = $this->getCurrentPage(Page::class)) {
            
            if ($this->getLevel()) {
                return parent::isDisabled();
            }
            
        }
        
        return true;
    }
}
