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

use SilverWare\Navigation\Model\LinkHolder;

/**
 * An extension of the link holder class for inline navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class InlineNavigation extends LinkHolder
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Inline Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Inline Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which shows a series of inline links';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware/navigation: admin/client/dist/images/icons/InlineNavigation.png';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_InlineNavigation';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = LinkHolder::class;
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = parent::getWrapperClassNames();
        
        $classes[] = 'inline';
        
        return $classes;
    }
}
