<?php

namespace Nana;

use Nana\Controllers\studentController;
use WPMVC\Bridge;


/**
 * Main class.
 * Bridge between WordPress and App.
 * Class contains declaration of hooks and filters.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
class Main extends Bridge
{
    /**
     * Declaration of public WordPress hooks.
     */
    public function init()
    {
        $this->add_model('Subject');
        $this->add_model('student');
        $this->add_model('License');
        $this->add_action('init', 'SubjectController@subject');
        $this->add_action('init', 'StudentController@student');
       
        $this->add_action( 'register_form_subject', 'SubjectController@registration_form' );
        $this->add_action( 'register_search_scores', 'SubjectController@search_scores' );
   
        $this->add_action( 'phpmailer_init', 'SubjectController@send_smtp_email' );
  
        $this->add_action( 'admin_post_render_subject_table_list', 'SubjectController@render_subject_table_list' );
        $this->add_action( 'admin_post_nopriv_render_subject_table_list', 'SubjectController@render_subject_table_list' );
       
       
        

        $this->add_action( 'wp_enqueue_scripts', 'SubjectController@ajax_form_scripts' );   
        
        $this->add_action( 'wp_ajax_set_form', 'SubjectController@set_form' );    //execute when wp logged in
        $this->add_action( 'wp_ajax_nopriv_set_form', 'SubjectController@set_form'); //execute when logged out
       
       
      
    }
    /**
     * Declaration of admin only WordPress hooks.
     * For WordPress admin dashboard.
     */
    public function on_admin()
    {
        $this->add_filter('manage_subject_posts_columns', 'SubjectController@manage_columns');
        $this->add_action(
            'manage_subject_posts_custom_column',
            'SubjectController@custom_subject_column',
            1,
            2
        );

       

        $this->add_filter(
            'metaboxer_model_student_id',
            'StudentController@prepare_data_before_rendering_metaboxes',
            10,
            2
        );
        $this->add_filter(
            'metaboxer_model_subject_id',
            'SubjectController@prepare_data_before_rendering_metaboxes',
            10,
            2
        );
        $this->add_filter('manage_student_posts_columns', 'StudentController@manage_columns');
        $this->add_action(
            'manage_student_posts_custom_column',
            'StudentController@custom_student_column',
            1,
            2
        );
       
    }
    
   
}
