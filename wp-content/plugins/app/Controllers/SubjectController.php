<?php

namespace Nana\Controllers;

use Nana\Models\Subject;
use WPMVC\MVC\Controllers\ModelController as Controller;
use Nana\Database\StudentDPO;
use Nana\Ultis\NanaListTable;
use Nana\assers\views;
use Nana\Models\student;


/**
 * SubjectController
 * WordPress MVC automated model controller.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
class SubjectController extends Controller
{
    /**
     * Property model.
     * @since 1.0.0
     *
     * @var string
     */
    protected $model = 'Nana\\Models\\Subject';
    /**
     * @since 1.0.0
     *
     * @hook init
     *
     * @return
     */
    public function subject()
    {
        /**
         * $label: chứa các tham số thiết lập tên hiển thị của taxonomy
         */
        $labels = array(
            'name' => 'Khóa học',
            'singular' => 'Quản lý khóa học',
            'menu_name' => 'Quản lý khóa học',
        );
        /**
         * biến $args khai báo các tham số trong custom taxonomy cần tạo
         * 
         */
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
        );
        $_SESSION['id_student_post '] = array();
        session_start();
        /**
         * register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('subject', 'subject', $args);
    }

    public function manage_columns($columns)
    {
        unset($columns['author']);
        unset($columns['date']);
        unset($columns['title']);
        $columns['course_id'] = __('Mã môn học', '');
        $columns['course_name'] = __('Tên môn học ', '');
        $columns['date_start'] = __('Ngày khai giảng', '');
        $columns['date_end'] = __('Ngày thi', '');
        $columns['course_price'] = __('Giá', '');

        return $columns;
    }
    public function custom_subject_column($column, $post_id)
    {
        $model = Subject::find($post_id);
        switch ($column) {
            case 'course_name': {
                    if (!is_array($model->post_title)) {
                        echo $model->post_title;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'course_id': {
                    if (!is_array($model->course_id)) {
                        echo $model->course_id;
                        break;
                    }
                    echo '--';
                    break;
                }


            case 'date_start': {
                    if (!is_array($model->date_start)) {
                        echo $model->date_start;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'date_end': {
                    if (!is_array($model->date_end)) {
                        echo $model->date_end;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'course_price': {
                    if (!is_array($model->course_price)) {
                        echo $model->course_price;
                        break;
                    }
                    echo '--';
                    break;
                }
        }
    }
    public function render_subject_table_list($settings_model, $field_id)
    {
        error_log(__METHOD__);
        $table = new NanaListTable();
        error_log('pass 1');
        $table->headers = [

            [
                'id' => 'member_name',
                'title' => __('Tên học viên'),
            ],
            [
                'id' => 'member_image',
                'title' => __('Ảnh', ''),
            ],
            [
                'id' => 'member_birth',
                'title' => __('Ngày sinh', ''),
            ],
            [
                'id' => 'member_email',
                'title' => __('Email', ''),
            ],
            [
                'id' => 'member_phone',
                'title' => __('SĐT', ''),
            ],
            [
                'id' => 'member_address',
                'title' => __('Địa chỉ', ''),
            ],

        ];

        $table->data = [];
        $list = StudentDPO::get_info_student();

        $id = get_the_ID();

        foreach ($list as $index => $value) {

            $student = Student::find($value->post_id);
            if ($student->meta['id_course'] == $id) {
                $table->data[] = [

                    'member_image' => $student->meta['member_image'],
                    'member_name' => $student->post_title,
                    'member_birth' =>  $student->meta['member_birth'],
                    'member_email' =>  $student->meta['member_email'],
                    'member_phone' => $student->meta['member_phone'],
                    'member_address' => $student->meta['member_address'],

                ];
            }
        }

        $table->display();
    }
    public function prepare_data_before_rendering_metaboxes($model, $metabox_id)
    {

        if ($metabox_id == 'info_subject') {

            if (!is_array($model->subject_temp_data)) {
                $model->subject_temp_data = array();
            }

            $this->subjectTL = $model->subject_temp_data;
            $model->subject_temp_data = json_encode($model->subject_temp_data);
            $model->metaboxes['info_subject']['tabs']['__NOTAB']['fields']['subject_table_list'] = [
                'type' => 'callback',
                'callback' => [$this, 'render_subject_table_list'],
            ];
            error_log('after callback');
        }

        return $model;
    }

    function registration_form()
    {
        if ( get_post_type() == 'subject' ){ 

        $this->view->show('admin.metaboxes.subject.meta', []);
        }
    }

    function search_scores()
    {
        if ( get_post_type() == 'license' ){ 

        $this->view->show('admin.metaboxes.license.meta', []);
        }
    }

    function ajax_form_scripts()
    {

        wp_enqueue_script(
            'register_ajax_form',
            assets_url('raw/js/HandleFormRegister.js', __FILE__),
            assets_url('raw/js/Search_scores.js', __FILE__),

        );

        $translation_array = array(
            'ajax_url' => admin_url('admin-ajax.php')
        );
       
        wp_localize_script('register_ajax_form', 'object', $translation_array);

        wp_enqueue_style(
            'my-control-style',
            assets_url('raw/css/RegisterForm.css', __FILE__),
            [],
            '1.0.0'
        );

        wp_enqueue_style(
            'my-control-style',
            assets_url('raw/css/Search_scores.css', __FILE__),
            [],
            '1.0.0'
        );
    }

    function set_form()
    {
        
        if (isset($_POST['getid'])) {
            $student = new student();
            $student->post_title = $_POST['name'];

            $student->meta['member_email'] = $_POST['email'];
            $student->meta['member_phone'] = $_POST['phone'];
            $student->meta['member_address'] = $_POST['address'];
            $student->meta['member_image'] = $_POST['avatar'];
            $student->meta['member_birth'] = $_POST['birthday'];
            $student->meta['id_course'] = $_POST['getid'];

            $student->post_status = "publish";
            $student->save();
        };

        
        die();
    }

    
}
