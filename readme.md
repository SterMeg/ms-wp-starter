# Starter WordPress theme

This theme is designed to provide an extendable base for a WordPress developer to get up and running with Gutenberg blocks quickly.

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