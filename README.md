# Brainrider WordPress Boilerplate

WordPress starter theme and associated gulp workflow files. Developed as part of the Brainrider web team to allow for accelerated start up of web projects.

## Getting Started

For an automated setup, use in conjuction with Brainrider workflow.

As a standalone, can be installed as per standard WordPress custom theme development. To initialize gulp workflow, ensure prerequisites have been installed and reference the associated npm and bower modules (i.e. npm install etc.).

All development should occur within the src folder with dist files being generated at the top level via gulp.

### Prerequisites

```
npm (see package.json for specific dependencies)
bower (see bower.json for specific dependencies)
Advanced Custom Fields Pro plugin
```

### Installing

Download boilerplate and place in your theme directory:

```
wp-content/themes/
```

From within the src directory of the boilerplate theme, install the associated bower dependencies:

```
cd wp-content/themes/brainrider-boilerplate/src
bower install
```

Do the same w/ npm to install the associated node modules:

```
npm install
npm update
```

Next update the included gulp config file (i.e. gulp-config) w/ your project-specific settings (e.g. text-domain, project name etc.).

Apply these settings to the boilerplate by running the workflow's regex task:

```
gulp regex
```

To begin development and ouput the generated files to the root, run the default gulp task:
```
gulp
```


Finally, the premium [Advanced Custom Fields plugin](https://www.advancedcustomfields.com/) will also need to be installed and enabled. The boilerplate does not currently include an ACF settings import file. As such, the fields used in the theme will need to bre created manually. 


## Built With

* [Underscores](https://github.com/Automattic/underscores.me)
* [WordPress-VIP Coding Standards](https://github.com/Automattic/VIP-Coding-Standards)
* [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer)
* [Advanced Custom Fields Plugin](https://www.advancedcustomfields.com/)
* [Gulp](https://gulpjs.com/)

## Future Development
* Include ACF settings import file
* Rework JS inclusion (consider conditional concierge approach)
* More!

## Author

* **Nathan M. House** - [NathanMHouse](https://github.com/NathanMHouse)


## License

This project is licensed under the GNU V.2 license - see the LICENSE file for details.

## Acknowledgments

* [Zell Liew](https://zellwk.com/) - workflow automation 