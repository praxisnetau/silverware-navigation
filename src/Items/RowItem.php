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
 * An extension of the bar item class for a row item.
 *
 * @package SilverWare\Navigation\Items
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class RowItem extends BarItem
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Row Item';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Row Items';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A bar item to group together other items in a row';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_Navigation_RowItem';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BarItem::class;
    
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
     * Answers an array of class names for the HTML template.
     *
     * @return array
     */
    public function getClassNames()
    {
        // Obtain Class Names:
        
        $classes = $this->styles('navbar.row');
        
        // Answer Class Names:
        
        return array_merge(
            parent::getClassNames(),
            $classes
        );
    }
}
