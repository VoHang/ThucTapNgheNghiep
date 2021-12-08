<?php

namespace Nana\Models;

use WPMVC\MVC\Traits\FindTrait;
use WPMVC\Addons\Metaboxer\Abstracts\PostModel as Model;
/**
 * License model.
 * WordPress MVC model.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
class License extends Model
{
    use FindTrait;
    /**
     * Property type.
     * @since 1.0.0
     *
     * @var string
     */
    protected $type = 'license';
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
    protected $registry_controller = 'LicenseController';
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
    protected function init( ){
        $this -> metaboxes =[
            'general_info_license' =>
            [
                
                    'title' => __('Thông tin văn bằng',''),
                    'tabs' => [
                        self::NO_TAB =>[
                            'fields'=>[
                                'license_id' =>
                                [
                                    'title'=> __('Mã văn bằng',''),
                                    'type'=> 'input',
                                ],
                                
                                'license_scores' => 
                                [
                                    'title'=> __('Điểm đạt',''),
                                    'type'=> 'input',
                                ],
                            ]
                        ]
                ]
            ]
        ];
    }
}