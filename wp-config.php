<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'thuctap' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'QNo]H3a)`_b/Dm}R&V?Fk{wqRps8NQx7?=pqwbyFCv2WAZG`GBqS0J_Q2n}9GW@F' );
define( 'SECURE_AUTH_KEY',  '(;}}CcNo/q_hwJDgweUr.kGA@#XolykkprkDw=DIyDbtNs`:<g7NoI=8uhN7TqQ ' );
define( 'LOGGED_IN_KEY',    '>U(<[DFPfPx&uj/$=wAjAh@9vW2tEiy |FD_@I`El,Q3S/6E(LkK0L7EORZB/qH^' );
define( 'NONCE_KEY',        '/gxa8L+jLW+C52BM|1%u)%-yuu0pd-Pjdh[[8Hv<ab|Oh{!`dY:^C7*SGgqfdp{?' );
define( 'AUTH_SALT',        'DEOR)zJKcc]^5iX?V>Md]3M;]k}+{@<LAF[}ropQ-) ;sC4=]>#v<gniCnxc8BBN' );
define( 'SECURE_AUTH_SALT', '6E%i>a`0p~VGcvdcd>g*&7-uot16;ERE!d?r^3BnN#V~CN8M#6H&14L(J<f*Xv};' );
define( 'LOGGED_IN_SALT',   '9w2kFpP<%t} 6 D?l[vqp%k2wG;ic.kJ[wRiyR}+!dALy%Os2-a.b3H|<IaM[0(4' );
define( 'NONCE_SALT',       '/6T3r+:>aJ5o54Y5CCt:i[RdS+VS.L#Yw~A#%?<=R<T2I8-PJ3(3MTZ]8Y6>1No%' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );


/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');

