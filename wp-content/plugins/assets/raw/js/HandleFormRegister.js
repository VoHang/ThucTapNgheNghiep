/**
 * HandleFormRegister JavaScript asset.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
// ( function( $ ) {

 

 jQuery(document).ready(function ($) {
    $('form#ajax.ajax').on('submit', function (e) {
       
       
        var that = $(this),
        url = that.attr('action'),
        type = that.attr('method');
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var avatar = jQuery('form#ajax.ajax').find('input[type=file]').$('#avatar').val();
        var birthday = $('#birthday').val();
        var getid = $('#getid').val();
        
    
        const  data = {
            action: 'set_form',
            name:name,
            getid:getid,
            email :email,
            address:address,
            phone:phone,
            avatar:avatar,
            birthday:birthday,
            
        };

        $.ajax({
            url: object.ajax_url,
            type: "post",
            dataType: '',
            data:data,
            
            success: function (response) {
               
                alert("Đăng ký thành công");  
               
            }, 
            error: function (error) {
                console.log(error); 
                alert("Đăng ký lỗi");
            }
           
        });
        $('form#ajax.ajax')[0].reset();
        e.preventDefault();
    });
});

// } )( jQuery );

