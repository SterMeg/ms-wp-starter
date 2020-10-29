# Starter WordPress theme

This theme is a work in progress designed to provide an extendable base for a WordPress developer to get up and running with Gutenberg blocks quickly.

## Theming
Theme.json contains theme variables that map to both SASS stylesheets and PHP functions in order to set up the appropriate options in the core blocks and their corresponding styles. 

### theme.json

#### Theme Slug
This is the slug that will be passed into any themeing functions that accept the slug.

#### Colors
Accepts a 'name' : 'hex color' pairing. Any colors added here will be added to the core block color picker, and will be available in the stylesheet as .has-{name}-color and .has-{name}-background-color.

#### Fonts
Accepts a 'name' : int pairing. The int represents a pixel value, which will be translated into a rem value with fallback. Any sizes added here will be added to the preset size picker in core blocks, and will be available in the stylesheet as .has-{name}-font-size. 

### Theme Setup Class
MS_Theme_Setup runs the php setup in order to register theme support based on the values added to theme.json, and additional options can be customize by passing an options array after the theme array. Because this is designed to be a theme for custom development, the custom colors, fonts, and gradients panels are disabled by default. The options and their defaults are as follows 

    $options = array(
        'disable_custom_colors' => true,
        'disable_custom_fonts' => true,
        'disable_custom_gradients' => true
    )

### Theme Setup SCSS
Theme SASS map can be generated and updated by running 'gulp theme'. Setup.scss takes the values from the theme map and sets up the appropriate color and font-size classes used by WordPress. It also sets up a default button, as well as classes for all of the color/text combinations used by WordPress according to theme. Default button color combinations utilize variable that can be easily updated.

## Extending the Default Nav
This starter includes a class that provides the option of extending the default nav walker in order to generate an accessible flyout menu. This flyout menu structure is based on examples from https://www.w3.org/WAI/tutorials/menus/flyout/. 

It is added by default, but can be removed by removing

    add_action('init', 'load_accessible_flyout_nav');

By default, when this class is initiated, it will apply to nav menu with the slug 'primary'. However, you can change or extend the navs you would like to add flyouts to by passing an array of menu slugs: 

    $args = array(
        'menus' => array(<your slugs here>);
    );

When the class is active and applied to a specific nav, if link has children and a valid href, it adds a button plus appropriate aria. If it doesn't have an href, it will not add a button, and instead will just add the appropriate aria to the link.

By default, the buttons will use a Font Awesome angle down for the first level nav, and an angle right for subsequent navs. This can be customized with button content of your choice, by adding 'content' to your $args array. 'Content' accepts either a string or an array of values. If an array is passed, the button will display the content from whatever position in the array matches the depth of the menu. If the depth of the menu is greater than the length of the array, it will use the last item in the array.
