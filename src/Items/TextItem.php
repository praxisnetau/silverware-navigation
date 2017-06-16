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

use SilverWare\Navigation\Model\BarItem;

/**
 * An extension of the bar item class for a text item.
 *
 * @package SilverWare\Navigation\Items
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class TextItem extends BarItem
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Text Item';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Text Items';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A bar item to show a string of text';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BarItem::class;
    
    /**
     * Answers a list of field objects for the CMS interface.
     *
     * @return FieldList
     */
    public function getCMSFields()
    {
        // Obtain Field Objects (from parent):
        
        $fields = parent::getCMSFields();
        
        // Modify Field Objects:
        
        $fields->fieldByName('Root.Main.Title')->setRightTitle(
            _t(
                __CLASS__ . '.TITLERIGHTTITLE',
                'Shown as text in the navigation bar.'
            )
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers an array of class names for the HTML template.
     *
     * @return array
     */
    public function getClassNames()
    {
        // Obtain Class Names:
        
        $classes = $this->styles('navbar.text');
        
        // Answer Class Names:
        
        return array_merge(
            parent::getClassNames(),
            $classes
        );
    }
}
