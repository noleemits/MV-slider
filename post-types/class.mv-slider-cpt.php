<?php


if(!class_exists('MV_Slider_Post_Type')){
    class MV_Slider_Post_Type{
       function __construct() {
            add_action( 'init', array($this, 'create_post_type') );
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            add_action( 'save_post', array($this, 'save_post'), 10, 2 );
        }
        public function create_post_type(){
            register_post_type( 'mv-slider', array(
                'label' => 'Slider',
                'description' => 'Sliders',
                'labels' => array(
                    'name' => 'Sliders',
                    'singular_name' => 'Slider'
                ),
                'public' => true,
                'supports' => array(
                    'title', 'editor','thumbnail'
                ),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus'=> true,
                'can_export' => true,
                'has_archive' => false,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_rest' => true,
                'menu_icon' => 'dashicons-images- alt2'

            ) 
         ); 
        }
        //Adding the metaboxes
        public function add_meta_boxes( ){
            add_meta_box( 
                //Id that will be used for css
                'mv_slider_meta_box',
                'link Options',
                array($this, 'add_inner_meta_boxes'),
                'mv-slider', 
                'normal',
                'high'

            );
        }
        public function add_inner_meta_boxes($post){
            require_once(MV_SLIDER_PATH . 'views/mv-slider_metabox.php');
        }
        public function save_post($post_id){
            if(isset($_POST['action']) && $_POST['action'] == 'editpost'){
                //Set variables
                 $old_link_text = get_post_meta( $post_id, 'mv_slider_link_text', true);
                 $new_link_text = $_POST['mv_slider_link_text'];
                 $old_link_url  = get_post_meta( $post_id, 'mv_slider_link_url', true);;
                 $new_link_url_= $_POST['mv_slider_link_url'];

                 //Update fields
                 if(empty($new_link_text)){

                     update_post_meta( $post_id, 'mv_slider_link_text', 'Add text' );
                 }else{
                    update_post_meta( $post_id, 'mv_slider_link_text', sanitize_text_field( $new_link_text), $old_link_text );
                 }

                 if(empty($new_link_url)){
                    update_post_meta( $post_id, 'mv_slider_link_url', '#' );
                 }else{
                    update_post_meta( $post_id, 'mv_slider_link_url', esc_url_raw( $new_link_url), $old_link_url );
                 }
                

            }
        }
    }
}
