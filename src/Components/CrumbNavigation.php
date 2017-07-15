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
use SilverWare\Forms\FieldSection;
use Page;
use PageController;

/**
 * An extension of the base component class for crumb navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class CrumbNavigation extends BaseComponent
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Crumb Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Crumb Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which shows crumb navigation for the current page';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware-navigation/admin/client/dist/images/icons/CrumbNavigation.png';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BaseComponent::class;
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = 'none';
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'HideTopLevel' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'HideTitle' => 1,
        'HideTopLevel' => 1
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
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            FieldSection::create(
                'NavigationOptions',
                $this->fieldLabel('NavigationOptions'),
                [
                    CheckboxField::create(
                        'HideTopLevel',
                        $this->fieldLabel('HideTopLevel')
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
        
        $labels['HideTopLevel'] = _t(__CLASS__ . '.HIDETOPLEVEL', 'Hide crumbs on top-level pages');
        $labels['NavigationOptions'] = _t(__CLASS__ . '.NAVIGATION', 'Navigation');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers the breadcrumb items from the current controller.
     *
     * @return ArrayList
     */
    public function getCrumbs()
    {
        if ($controller = $this->getCurrentController(PageController::class)) {
            return $controller->getBreadcrumbItems();
        }
    }
    
    /**
     * Answers the number of breadcrumb items from the current controller.
     *
     * @return integer
     */
    public function getCrumbsCount()
    {
        return ($crumbs = $this->getCrumbs()) ? $crumbs->count() : 0;
    }
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = $this->styles('breadcrumb');
        
        $this->extend('updateWrapperClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of item class names for the HTML template.
     *
     * @return array
     */
    public function getItemClassNames()
    {
        $classes = $this->styles('breadcrumb.item');
        
        $this->extend('updateItemClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of active class names for the HTML template.
     *
     * @return array
     */
    public function getActiveClassNames()
    {
        $classes = $this->styles('breadcrumb.item', 'breadcrumb.active');
        
        $this->extend('updateActiveClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers true if the object is disabled within the template.
     *
     * @return boolean
     */
    public function isDisabled()
    {
        // Obtain Current Page (with crumbs enabled):
        
        if (($page = $this->getCurrentPage(Page::class)) && !$page->CrumbsDisabled) {
            
            // Disable for Top-Level (if required):
            
            if ($this->HideTopLevel && $this->getCrumbsCount() == 1) {
                return true;
            }
            
            // Answer from Parent:
            
            return parent::isDisabled();
            
        }
        
        // Disable (by default):
        
        return true;
    }
}
