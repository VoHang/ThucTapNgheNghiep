<?php

namespace Nana\Database;

use TenQuality\WP\Database\QueryBuilder;

class StudentDPO
{
    public static function get_info_student()
    {

        return QueryBuilder::create()
            ->select('a.post_title, a.post_content')
            ->select('b.meta_key, b.post_id')
            ->from('posts as `a` ')
            ->join( 'postmeta as `b`', [
                [
                    'raw' => 'b.post_id = a.ID',
                   
                ],
            ])
            ->where([
                'a.post_type' => 'student',
                'a.post_status' => 'publish',
                
            ])
            ->group_by( 'a.post_name', )
            ->get();
    }

}
