<?php
class MS_Theme_Setup {
    private $theme_array;
    private $theme_options = array(
        'disable_custom_colors' => true,
        'disable_custom_fonts' => true,
        'disable_custom_gradients' => true
    );

    public static function init($theme_array, $options = array()) {
        $self = new self();
        $self->theme_array = $theme_array;
        if($options) {
          $self->options = parse_valid_args($options);
        }
        $self->setup_theme();
        var_dump($theme_array);
    }

    private function parse_valid_args($options) {
        $valid_args = array_intersect_key($args, $this->args);
        $this->args = wp_parse_args( $valid_args, $this->args);
    }


    public function setup_theme() {
        $this->setup_colors();
        $this->setup_fonts();
    }

    private function setup_colors() {
        // Add theme colors to Gutenberg Block Editor panel
        add_theme_support( 'editor-color-palette', $this->generate_color_palette());
    
        // Disables custom colors in block color palette.
        if($this->theme_options['disable_custom_colors']) {
            add_theme_support( 'disable-custom-colors' );
        }
    }

    private function setup_gradients() {
        // Add theme gradients to Gutenberg Block Editor panel
        if($this->theme_array['gradients']) {
            add_theme_support( 'editor-gradient-presets', $this->generate_gradients());
        }
    
         // Disables custom gradients in block color palette.
         if($this->theme_options['disable_custom_gradients']) {
             add_theme_support( 'disable-custom-gradients' );
         }
    }

    private function setup_fonts() {
        // Add theme font sizes to Gutenberg Block Editor panel
        add_theme_support( 'editor-font-sizes', $this->generate_font_sizes());

        if($this->theme_options['disable_custom_fonts']) {
            add_theme_support( 'disable-custom-font-sizes' );
        }
    }

    private function generate_color_palette() {
        return $this->editor_generator('colors', 'color');
    }

    private function generate_gradients() {
        return $this->editor_generator('gradients', 'gradient');
    }

    private function generate_font_sizes() { 
        return $this->editor_generator('fonts', 'size');
    }

    private function editor_generator($key, $type) {
        $options = array();

        foreach($this->theme_array[$key] as $key=>$value) {
            $options[] = array(
                'name' => __(ucwords(str_replace('-', ' ', $key)), $this->theme_array['theme-slug']),
                'slug' => $key,
                $type => $value
            );
        }

        return $options;
    }
}

// function ms_theme_setup() {
    

    
//     add_theme_support( 'align-wide');
    
//     add_theme_support( 'post-thumbnails');
// }
// add_action('after_setup_theme', 'ms_theme_setup');






// function ms_custom_logo_setup() {
//     global $theme_array; 

//     $defaults = array(
//         'height' => $theme_array['logo']['height'],
//         'width' => $theme_array['logo']['width'], 
//     );
//     add_theme_support('custom-logo', $defaults);
// }
