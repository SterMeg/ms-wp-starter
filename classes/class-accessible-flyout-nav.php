<?php 
// This is an attempt to make a class that creates accessible nav menu
// flyouts according to WAI standards

class Accessible_Flyout_Nav {
    private $args = array(
        'menus' => array('primary'),
        'content' => array('<i class="fas fa-angle-down"></i>','<i class="fas fa-angle-right"></i>'),
        'toggle_class' => 'toggle-flyout'
    );
    private $has_popup;
    private $valid_url;

    public static function init($args = array()) {
        $self = new self();
        if ($args) {
            $self->args = parse_valid_args($args, $self->args);
        }
        
        $self->handle_filters();
    }

    private function handle_filters() {
        add_filter( 'nav_menu_submenu_css_class', array($this, 'add_submenu_class') );
        add_filter('walker_nav_menu_start_el', array($this,'add_dropdown_button'), 10, 4);
        add_filter('nav_menu_link_attributes', array($this, 'add_aria_popup'), 10, 4);
    }

    public function add_aria_popup($atts, $item, $args, $depth) {
        // Return if 
        if (!$this->has_popup($item, $args)) {
            return $atts;
        }

        // If menu item is an empty link, we will add the toggle class directly to link
        if(!$this->has_valid_url($atts['href'])) {
            $atts['class'] = $this->args['toggle_class'];
        }

        $atts['aria-haspopup'] = 'true';
        $atts['aria-expanded'] = 'false';

        return $atts;
    }

    public function add_submenu_class($classes) {
        $classes[] = "flyout-menu";
        return $classes;
    }

    public function add_dropdown_button($item_output, $item, $depth, $args) {

        if(!$this->has_popup($item, $args) || !$this->has_valid_url($item->url)) {
            return $item_output;
        } 

        if (is_array($this->args['content'])) {
            $content = end($this->args['content']);
            $count = count($this->args['content']) - 1; 
            
            if ($depth <= $count) {
                $content = $this->args['content'][$depth];
            }
        } else {
            $content = $this->args['content'];
        }
        ob_start();
        ?>
        
        <button class="toggle-flyout" aria-expanded="false"><span class="visuallyhidden ">Show submenu for <?= $item->title; ?></span><?= $content; ?></button>
        
        <?php 
        $button_dropdown = ob_get_clean();

        $item_output .= $button_dropdown;

        return $item_output;
    }

    // Status checks
    public function has_button_filter() {
        return has_filter('walker_nav_menu_start_el', array($this,'add_dropdown_button'));
    }

    private function has_valid_url($href) {
        return filter_var($href, FILTER_VALIDATE_URL);
    }

    private function has_popup($item, $args) {
        $menu_item_classes = $item->classes;
        $menu_slug = $args->menu->slug;

        return $this->is_flyout_nav($menu_slug) && $this->has_children($menu_item_classes);
    }

    private function is_flyout_nav($slug) {
        return in_array($slug, $this->args['menus']);
    }

    private function has_children($menu_item_classes) {
        if (empty($menu_item_classes)) {
            return false;
        }
        return in_array('menu-item-has-children', $menu_item_classes);
    }
}