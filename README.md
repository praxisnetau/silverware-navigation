# SilverWare Navigation Module

[![Latest Stable Version](https://poser.pugx.org/silverware/navigation/v/stable)](https://packagist.org/packages/silverware/navigation)
[![Latest Unstable Version](https://poser.pugx.org/silverware/navigation/v/unstable)](https://packagist.org/packages/silverware/navigation)
[![License](https://poser.pugx.org/silverware/navigation/license)](https://packagist.org/packages/silverware/navigation)

Provides a series of navigation components for use with [SilverWare][silverware].

## Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Issues](#issues)
- [To-Do](#to-do)
- [Contribution](#contribution)
- [Attribution](#attribution)
- [Maintainers](#maintainers)
- [License](#license)

## Requirements

- [SilverWare][silverware]

## Installation

Installation is via [Composer][composer]:

```
$ composer require silverware/navigation
```

## Configuration

As with all SilverStripe modules, configuration is via YAML. Page settings for navigation are applied
using the included `PageExtension` class. Style mappings for Bootstrap are configured in the `styles.yml`
configuration file.

## Usage

This module provides a series of navigation-related components:

- Anchor Navigation
- Bar Navigation
- Block Navigation
- Button Navigation
- Crumb Navigation
- Icon Navigation
- Inline Navigation
- Level Navigation
- List Navigation

These components can be added to your SilverWare templates or layouts using the CMS.

### Anchor Navigation

The Anchor Navigation component shows a list of links to anchors within the current page's content.

### Bar Navigation

The Bar Navigation component represents a standard [Bootstrap navbar][bootstrap-navbar].

### Block Navigation

The Block Navigation component renders a series of Link components in a block layout.

### Button Navigation

The Button Navigation component renders a series of Button components in an inline layout.

### Crumb Navigation

The Crumb Navigation component is used to add [Bootstrap breadcrumb][bootstrap-breadcrumb]
navigation to your template or layout.

### Icon Navigation

The Icon Navigation component renders a series of Link components as icons in an inline layout.

### Inline Navigation

The Inline Navigation component renders a series of Link components in an inline layout.

### Level Navigation

The Level Navigation component is typically added to a sidebar to provide navigation for
the current page level, i.e. all of the pages within the current section.

### List Navigation

The List Navigation component renders a series of Link components as a list (similar to Level Navigation).

## Issues

Please use the [GitHub issue tracker][issues] for bug reports and feature requests.

## To-Do

- Tests

## Contribution

Your contributions are gladly welcomed to help make this project better.
Please see [contributing](CONTRIBUTING.md) for more information.

## Attribution

- Makes use of [Bootstrap](https://github.com/twbs/bootstrap) by the
  [Bootstrap Authors](https://github.com/twbs/bootstrap/graphs/contributors)
  and [Twitter, Inc](https://twitter.com).

## Maintainers

[![Colin Tucker](https://avatars3.githubusercontent.com/u/1853705?s=144)](https://github.com/colintucker) | [![Praxis Interactive](https://avatars2.githubusercontent.com/u/1782612?s=144)](http://www.praxis.net.au)
---|---
[Colin Tucker](https://github.com/colintucker) | [Praxis Interactive](http://www.praxis.net.au)

## License

[BSD-3-Clause](LICENSE.md) &copy; Praxis Interactive

[silverware]: https://github.com/praxisnetau/silverware
[composer]: https://getcomposer.org
[bootstrap-navbar]: https://v4-alpha.getbootstrap.com/components/navbar
[bootstrap-breadcrumb]: https://v4-alpha.getbootstrap.com/components/breadcrumb
[issues]: https://github.com/praxisnetau/silverware-navigation/issues
