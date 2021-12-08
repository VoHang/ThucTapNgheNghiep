<?php

namespace Nana\Models;

use WPMVC\MVC\Traits\FindTrait;
use WPMVC\Addons\Metaboxer\Abstracts\PostModel as Model;

/**
 * student model.
 * WordPress MVC model.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
class student extends Model
{
    use FindTrait;
    /**
     * Property type.
     * @since 1.0.0
     *
     * @var string
     */
    const TYPE = 'student';
    protected $type = self::TYPE;
    /**
     * Property aliases.
     * @since 1.0.0
     *
     * @var array
     */
    protected $aliases = array();
    /**
     * Property registry_controller.
     * @since 1.0.0
     *
     * @var string
     */
    protected $registry_controller = 'studentController';
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
        'title',
        'revision',

    ];
    
    protected function init()
    {
       
        $this->metaboxes =
            [
                'general_info_member' =>
                [
                    'title' => __('Thông tin sinh viên', ''),
                    'tabs' =>
                    [
                        self::NO_TAB => [
                            'fields' =>
                            [
                                'member_id' => [
                                    'type' => 'input',
                                    'title' => __('Mã số sinh viên', ''),
                                    'control' =>
                                    [
                                        'wide' => false,
                                    ]
                                ],

                                'member_image' =>
                                [
                                    'title' => __('Hình ảnh', ''),
                                    'type' => 'media',
                                    'description' => __('Đăng tải hình ảnh học viên'),
                                    'control' => [
                                        'wide' => true,
                                        'button_label' => __('Chọn Ảnh'),
                                        'icon' => ' fa-picture-o',
                                    ]

                                ],
                                'member_birth' =>
                                [
                                    'title' => __('Ngày sinh', ''),
                                    'type' => 'datepicker',
                                    'control' => [
                                        'attributes' => [
                                            'data-show-time' => 0,
                                            'data-format' =>  'd-m-Y',
                                        ]
                                    ]
                                ],
                                'member_email' => [
                                    'title' => __('Email', ''),
                                    'type' => 'input',
                                ],
                                'member_phone' => [
                                    'title' => __('Số điện thoại', ''),
                                    'type' => 'input',
                                ],
                                'member_address' =>
                                [
                                    'title' => __('Địa chỉ', ''),
                                    'type' => 'input',
                                    'control' => [
                                        'wide' => true,


                                    ],
                                ],
                                'id_course' => [
                                    'type' => 'input',
                                    'title' => 'id_course',
                                    'show_title' => false,
                                    'control' => [
                                        'type' => 'hidden',
                                        'wide' => true
                                    ]
                                ],
                            ]
                        ]
                    ]
                ],
                'info_student' =>
                [
                    'title' => __('Bảng thông tin sinh viên', ''),
                    'tabs' =>
                    [
                        self::NO_TAB => [
                            'fields' =>
                            [
                                'student_temp_data' => [
                                    'type' => 'input',
                                    'title' => 'studentTL',
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
