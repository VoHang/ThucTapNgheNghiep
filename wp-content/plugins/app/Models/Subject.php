<?php

namespace Nana\Models;

use WPMVC\MVC\Traits\FindTrait;
use WPMVC\Addons\Metaboxer\Abstracts\PostModel as Model;

/**
 * Subject model.
 * WordPress MVC model.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
class Subject extends Model
{
    use FindTrait;
    /**
     * Property type.
     * @since 1.0.0
     *
     * @var string
     */
    const TYPE = 'subject';
    protected $type = self::TYPE;
    /**
     * Property aliases.
     * @since 1.0.0
     *
     * @var array
     */
    protected $aliases = [
        'student_id' => 'meta_student',
    ];
    /**
     * Property registry_controller.
     * @since 1.0.0
     *
     * @var string
     */
    protected $registry_controller = 'SubjectController';
    /**
     * Property registry_metabox.
     * @since 1.0.0
     *
     * @var array
     */
    // protected $registry_metabox = array(
    //     'title' => 'Meta fields',
    //     'context' => 'normal',
    //     'priority' => 'default',
    // );
    protected $registry_supports = [
        // 'title',
        // 'revision',

    ];
    
    /**
     * Returns "has_many" relationship.
     * @return object|Relationship
     */
    protected function student()
    {
        return $this->has_many( student::class, 'student_id' );
       
    }

    protected function init()
    {
        $this->metaboxes = [
            'general_info_course' =>
            [

                'title' => __('Thông tin môn học', ''),
                'tabs' => [
                    self::NO_TAB => [
                        'fields' => [
                            'course_id' =>
                            [
                                'title' => __('Mã môn học', ''),
                                'type' => 'input',
                            ],


                            'date_start' => [
                                'title' => __('Ngày khai giảng', ''),
                                'type' => 'datepicker'
                            ],
                            'date_end' => [
                                'title' => __('Ngày thi', ''),
                                'type' => 'datepicker'
                            ],
                            'course_price' => [
                                'title' => __('Học phí', ''),
                                'type' => 'input',
                                'control' => [
                                    'type' => 'number',

                                    'attributes' =>
                                    [
                                        'placeholder' => __('Nhập học phí (VND)', ''),
                                        'min' => 1500000,
                                        'max' => 3000000,
                                        'step' => '250000',


                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'info_subject' =>
            [

                'title' => __('Danh sách học viên đăng ký', ''),
                'tabs' => [
                    self::NO_TAB => [
                        'fields' => [
                            'subject_temp_data' => [
                                'type' => 'input',
                                'title' => 'subjectTL',
                                'show_title' => false,
                                'control' => [
                                    'type' => 'hidden',
                                    'wide' => true
                                ]
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }
}
