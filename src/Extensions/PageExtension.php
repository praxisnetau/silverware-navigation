<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Navigation\Extensions
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */

namespace SilverWare\Navigation\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;
use SilverWare\Forms\FieldSection;
use SilverWare\Navigation\Components\InlineNavigation;

/**
 * A data extension which adds navigation settings to pages.
 *
 * @package SilverWare\Navigation\Extensions
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class PageExtension extends DataExtension
{
    /**
     * Maps field names to field types for the extended object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'CrumbsDisabled' => 'Boolean',
        'HideFromMainMenu' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of the extended object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'CrumbsDisabled' => 0,
        'HideFromMainMenu' => 0
    ];
    
    /**
     * Defines the reciprocal many-many associations for this object.
     *
     * @var array
     * @config
     */
    private static $belongs_many_many = [
        'InlineNavigations' => InlineNavigation::class
    ];
    
    /**
     * Updates the CMS settings fields of the extended object.
     *
     * @param FieldList $fields Collection of CMS settings fields from the extended object.
     *
     * @return void
     */
    public function updateSettingsFields(FieldList $fields)
    {
        // Update Field Objects:
        
        $fields->addFieldToTab(
            'Root.Settings',
            $settings = FieldSection::create(
                'NavigationSettings',
                $this->owner->fieldLabel('NavigationSettings'),
                [
                    CheckboxField::create(
                        'CrumbsDisabled',
                        $this->owner->fieldLabel('CrumbsDisabled')
                    ),
                    CheckboxField::create(
                        'HideFromMainMenu',
                        $this->owner->fieldLabel('HideFromMainMenu')
                    )
                ]
            )
        );
        
        // Check Permissions and Modify Fields:
        
        if (!Permission::check(['ADMIN', 'SILVERWARE_PAGE_SETTINGS_CHANGE'])) {
            
            foreach ($settings->getChildren() as $field) {
                $settings->makeFieldReadonly($field);
            }
            
        }
    }
    
    /**
     * Updates the field labels of the extended object.
     *
     * @param array $labels Array of field labels from the extended object.
     *
     * @return void
     */
    public function updateFieldLabels(&$labels)
    {
        $labels['CrumbsDisabled'] = _t(__CLASS__ . '.CRUMBSDISABLED', 'Crumbs disabled');
        $labels['HideFromMainMenu'] = _t(__CLASS__ . '.HIDEFROMMAINMENU', 'Hide from main menu');
        $labels['NavigationSettings'] = _t(__CLASS__ . '.NAVIGATION', 'Navigation');
    }
    
    /**
     * Answers the children of the extended object which are to be shown in the main menu.
     *
     * @return ArrayList
     */
    public function getMainMenuChildren()
    {
        return $this->owner->Children()->exclude('HideFromMainMenu', 1);
    }
}
