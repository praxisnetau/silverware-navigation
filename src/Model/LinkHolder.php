<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Navigation\Model
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */

namespace SilverWare\Navigation\Model;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\ArrayList;
use SilverWare\Components\BaseComponent;
use SilverWare\Extensions\Style\AlignmentStyle;
use SilverWare\FontIcons\Extensions\FontIconExtension;
use SilverWare\Forms\FieldSection;
use SilverWare\Forms\PageMultiselectField;
use SilverWare\Model\Link;
use Page;

/**
 * An extension of the base component class for a link holder.
 *
 * @package SilverWare\Navigation\Model
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class LinkHolder extends BaseComponent
{
    /**
     * Define mode constants.
     */
    const MODE_LINKS = 'links';
    const MODE_PAGES = 'pages';
    
    /**
     * Define sort constants.
     */
    const SORT_ORDER = 'order';
    const SORT_TITLE = 'title';
    
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Link Holder';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Link Holders';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which holds a series of links';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_Navigation_LinkHolder';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BaseComponent::class;
    
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
        'HeaderContent' => 'HTMLText',
        'FooterContent' => 'HTMLText',
        'LinkMode' => 'Varchar(8)',
        'SortBy' => 'Varchar(16)',
        'ShowIcons' => 'Boolean'
    ];
    
    /**
     * Defines the many-many associations for this object.
     *
     * @var array
     * @config
     */
    private static $many_many = [
        'LinkedPages' => Page::class
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'LinkMode' => 'links',
        'SortBy' => 'order',
        'HideTitle' => 1,
        'ShowIcons' => 1
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
        AlignmentStyle::class,
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
        
        // Create Main Fields:
        
        $fields->addFieldsToTab(
            'Root.Main',
            [
                HTMLEditorField::create(
                    'HeaderContent',
                    $this->fieldLabel('HeaderContent')
                )->setRows(10),
                HTMLEditorField::create(
                    'FooterContent',
                    $this->fieldLabel('FooterContent')
                )->setRows(10)
            ]
        );
        
        // Insert Links Tab:
        
        $fields->insertAfter(
            Tab::create(
                'Links',
                $this->fieldLabel('Links')
            ),
            'Main'
        );
        
        // Add Links Fields:
        
        $fields->addFieldsToTab(
            'Root.Links',
            [
                DropdownField::create(
                    'LinkMode',
                    $this->fieldLabel('LinkMode'),
                    $this->getLinkModeOptions()
                ),
                PageMultiselectField::create(
                    'LinkedPages',
                    $this->fieldLabel('LinkedPages')
                )
            ]
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            FieldSection::create(
                'NavigationOptions',
                $this->fieldLabel('NavigationOptions'),
                [
                    DropdownField::create(
                        'SortBy',
                        $this->fieldLabel('SortBy'),
                        $this->getSortByOptions()
                    ),
                    CheckboxField::create(
                        'ShowIcons',
                        $this->fieldLabel('ShowIcons')
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
        
        $labels['Links'] = _t(__CLASS__ . '.LINKS', 'Links');
        $labels['SortBy'] = _t(__CLASS__ . '.SORTBY', 'Sort by');
        $labels['LinkMode'] = _t(__CLASS__ . '.LINKMODE', 'Mode');
        $labels['ShowIcons'] = _t(__CLASS__ . '.SHOWICONS', 'Show icons');
        $labels['LinkedPages'] = _t(__CLASS__ . '.LINKEDPAGES', 'Pages');
        $labels['HeaderContent'] = _t(__CLASS__ . '.HEADERCONTENT', 'Header content');
        $labels['FooterContent'] = _t(__CLASS__ . '.FOOTERCONTENT', 'Footer content');
        $labels['NavigationOptions'] = _t(__CLASS__ . '.NAVIGATION', 'Navigation');
        
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
        $classes = ['link-holder'];
        
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
        $classes = ['links'];
        
        $classes[] = ($this->ShowIcons ? 'show-icons' : 'hide-icons');
        
        $this->extend('updateListClassNames', $classes);
        
        return $classes;
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
        switch ($this->LinkMode) {
            
            case self::MODE_PAGES:
                
                $links = ArrayList::create();
                
                foreach ($this->LinkedPages() as $page) {
                    $link = $page->toLink();
                    $link->setParent($this);
                    $links->push($link);
                }
                
                break;
                
            default:
                
                $links = $this->getLinks()->filterByCallback(function ($link) {
                    return $link->isEnabled();
                });
                
        }
        
        return $links->sort($this->getSortOrder());
    }
    
    /**
     * Answers an array of options for the link mode field.
     *
     * @return array
     */
    public function getLinkModeOptions()
    {
        return [
            self::MODE_LINKS => _t(__CLASS__ . '.LINKS', 'Links'),
            self::MODE_PAGES => _t(__CLASS__ . '.PAGES', 'Pages')
        ];
    }
    
    /**
     * Answers the sort order for the navigation.
     *
     * @return string
     */
    public function getSortOrder()
    {
        switch ($this->SortBy) {
            
            case self::SORT_TITLE:
                return 'Title';
            
            default:
                return 'Sort';
            
        }
    }
    
    /**
     * Answers an array of options for the sort by field.
     *
     * @return array
     */
    public function getSortByOptions()
    {
        return [
            self::SORT_ORDER => _t(__CLASS__ . '.ORDER', 'Order'),
            self::SORT_TITLE => _t(__CLASS__ . '.TITLE', 'Title')
        ];
    }
}
