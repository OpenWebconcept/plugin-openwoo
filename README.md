# Yard | OpenWOO

## Description

Through this plugin, OpenWOO requests can be managed

[OpenWOO](https://www.rijksoverheid.nl/onderwerpen/wet-open-overheid-woo) items are public documents which are provided by the (local)government.

OpenWOO is an interface to the REST API for querying WOO items.

* [Repository](https://bitbucket.org/openwebconcept/plugin-openwoo/src)
* [Documentation](https://openwebconcept.bitbucket.io/openwoo/index.html)

## Dependencies

In order to use this plug-in there are two required plug-ins or packages:

* CMB2
* [ExtendedCPTs](https://github.com/johnbillion/extended-cpts)

## Installation

### Manual installation

1. Upload the 'openwoo' folder in to the `/wp-content/plugins/` directory.
2. `cd /wp-content/plugins/openwoo`
3. Run `composer install, NPM asset build is in version control already.
4. Activate the plugin in via the WordPress admin.

### Composer installation

1. `composer source git@github.com:OpenWebconcept/plugin-openwoo.git`
2. `composer require plugin/openwoo`
3. `cd /wp-content/plugins/openwoo`
4. Run `composer install`

## License

The source code is made available under the [EUPL 1.2 license](https://github.com/OpenWebconcept/plugin-openwoo/blob/main/LICENSE.md). Some of the dependencies are licensed differently, with the BSD or MIT license, for example.
