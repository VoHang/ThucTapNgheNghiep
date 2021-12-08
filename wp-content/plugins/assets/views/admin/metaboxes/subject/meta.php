<?php

/**
 * Post type admin.metaboxes.subject.meta meta fields form.
 * Automated metabox.
 *
 * @author VoHang
 * @package nana_fresher
 * @version 1.0.0
 */
?>
<!-- <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script> -->

<form class="ajax" method="POST" action="" id="ajax" name="contact-me">
    <h2> Đăng ký môn học </h2>
    <div class="form-outline  mb-4 ">
        <label class="form-label" for="form3Example1cg">Tên</label><br>
        <input type="text" name="name" id="name" class="form-control form-control" required class="name" />

    </div>

    <div class="form-outline  mb-4 ">
        <label class="form-label" for="avatar" for="form3Example1cg">Ảnh</label><br>
        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">

    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example3cg">Ngày sinh</label><br>
        <input type="date" id="birthday" name="birthday" class="form-control form-control"  required class="birthday" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example3cg">Số điện thoại</label><br>
        <input type="tel" name="phone" id="phone" class="form-control form-control"  required class="phone" />
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example3cg"> Email</label><br>
        <input type="email" name="email" id="email" class="form-control form-control" required class="email" />
    </div>

    <div class="form-outline mb-4">

        <label class="form-label" for="form3Example4cg">Địa chỉ</label><br>
        <input type="diachi" name="address" id="address" class="form-control form-control-lg" required class="address" />
    </div>

    <div class="form-outline mb-4">
        <input type="hidden" name=" getid" id="getid" class="form-control form-control" value="<?php echo get_the_ID() ?>"/>
    </div>
    <br>
    <div>
        <button type="submit" name="subject_register" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Đăng ký</button>
    </div>

</form>