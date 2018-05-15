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
 * An extension of the link holder class for list navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class ListNavigation extends LinkHolder
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'List Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'List Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which shows a series of links as a list';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware/navigation: admin/client/dist/images/icons/ListNavigation.png';
    
    /**
     * Defines the table name to use for this object.
     *
     * @var string
     * @config
     */
    private static $table_name = 'SilverWare_ListNavigation';
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'HideTitle' => 0
    ];
    
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
        
        $classes[] = 'list';
        
        return $classes;
    }
    
    /**
     * Answers an array of list class names for the HTML template.
     *
     * @return array
     */
    public function getListClassNames()
    {
        $classes = parent::getListClassNames();
        
        if ($this->hasFontIcon() && $this->ShowIcons) {
            $classes[] = 'fa-ul';
        }
        
        return $classes;
    }
    
    /**
     * Renders the font icon tag for the HTML template.
     *
     * @param string $icon
     *
     * @todo Improve this, as it's kinda hacky.
     *
     * @return DBHTMLText|string
     */
    public function getLinkFontIconTag($icon = null)
    {
        if ($icon) {
            $self = clone $this;
            $self->FontIcon = $icon;
            return $self->getFontIconTag();
        }
        
        return $this->getFontIconTag();
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
}
