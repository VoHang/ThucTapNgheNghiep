<?php

namespace Nana\Controllers;

use Nana\Controllers\studentController as ControllersStudentController;
use WPMVC\MVC\Controllers\ModelController as Controller;
use Nana\Models\student;
use Nana\Models\Subject;
use Nana\Ultis\NanaListTable;
use Nana\Database\SubjectDPO;
use Nana\Database\StudentDPO;
use Nana\assets;


/**
 * studentController
 * WordPress MVC automated model controller.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
class studentController extends Controller
{
    /**
     * Property model.
     * @since 1.0.0
     *
     * @var string
     */
    protected $model = 'Nana\\Models\\student';
    /**
     * @since 1.0.0
     *
     * @hook init
     *
     * @return
     */
    public function student()
    {
        /**
         * $label: chứa các tham số thiết lập tên hiển thị của taxonomy
         */
        $labels = array(
            'name' => 'Học viên',
            'singular' => 'Quản lý học viên',
            'menu_name' => 'Quản lý học viên'
        );
        /**
         * biến $args khai báo các tham số trong custom taxonomy cần tạo
         * 
         */
        $args = array(
            'labels'                => $labels,
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'show_in_nav_menus'     => true,
            'show_tagcloud'         => true,
        );
        /**
         * register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('Class', 'student', $args);
    }
    public function manage_columns($columns)
    {

        unset($columns['author']);
        unset($columns['date']);
        unset($columns['title']);
        $columns['member_id'] = __('Mã học viên', '');
        $columns['member_name'] = __('Tên học viên', '');
        $columns['member_image'] = __('Ảnh', '');

        $columns['member_birth'] = __('Ngày sinh', '');
        $columns['member_email'] = __('Email', '');
        $columns['member_phone'] = __('Số điện thoại', '');
        $columns['member_address'] = __('Địa chỉ', '');
        return $columns;

        return $columns;
    }
    public function custom_student_column($column, $post_id)
    {
        $model = Student::find($post_id);
        switch ($column) {
            case 'member_id': {
                    if (!is_array($model->member_id)) {
                        echo $model->member_id;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'member_name': {
                    if (!is_array($model->post_title)) {
                        echo $model->post_title;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'member_image': {
                    if (!is_array($model->meta_key)) {
                        echo wp_get_attachment_image(get_post_meta($post_id, 'member_image', true), array(220, 100));


                        break;
                    }

                    echo '--';
                    break;
                }

            case 'member_birth': {
                    if (!is_array($model->member_birth)) {
                        echo $model->member_birth;
                        break;
                    }
                    echo '--';
                    break;
                }

            case 'member_email': {
                    if (!is_array($model->member_email)) {
                        echo $model->member_email;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'member_phone': {
                    if (!is_array($model->member_phone)) {
                        echo $model->member_phone;
                        break;
                    }
                    echo '--';
                    break;
                }
            case 'member_address': {
                    if (!is_array($model->member_address)) {
                        echo $model->member_address;
                        break;
                    }
                    echo '--';
                    break;
                }
        }
    }
    public function prepare_data_before_rendering_metaboxes($model, $metabox_id)
    {
        error_log(__METHOD__);
        error_log($metabox_id);
        if ($metabox_id == 'info_student') {

            if (!is_array($model->student_temp_data)) {
                $model->student_temp_data = array();
            }

            $this->studentTL = $model->student_temp_data;
            $model->student_temp_data = json_encode($model->student_temp_data);
            $model->metaboxes['info_student']['tabs']['__NOTAB']['fields']['student_table_list'] = [
                'type' => 'callback',
                'callback' => [$this, 'render_student_table_list'],
            ];
            error_log('after callback');
        }

        return $model;
    }


    public function render_student_table_list($settings_model, $field_id)
    {
        //if (!$this->chemical_list || empty($this->chemical_list)) return;
        error_log(__METHOD__);
        $table = new NanaListTable();

        error_log('pass 1');
        $table->headers = [
            [
                'id' => 'course_id',
                'title' => __('Mã số'),
            ],
            [
                'id' => 'course_name',
                'title' => __('Tên môn học'),
            ],
            [
                'id' => 'course_description',
                'title' => __('Giới thiệu', ''),
            ],
            [
                'id' => 'date_start',
                'title' => __('Ngày khai giảng', ''),
            ],
            [
                'id' => 'date_end',
                'title' => __('Ngày thi', ''),
            ],
            [
                'id' => 'course_price',
                'title' => __('Giá môn học', ''),
            ],

        ];

        $table->data = [];
     
        $student = Student::find(get_the_ID());
        $subject = Subject::find($student->meta['id_course']);
        $table->data[] = [
            'course_id'  =>$subject->meta['course_id'],
            'date_start'  =>$subject->meta['date_start'],
            'date_end'  =>$subject->meta['date_end'],
            'course_description' =>$subject->post_content,
            'course_price'  =>$subject->meta['course_price'],
            'course_name' => $subject->post_title,

        ];

        $table->display();
    }

    
}
