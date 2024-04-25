
//Comment error popup
jQuery(document).ready(function($) {
    $('#commentform').validate({
        rules: {
          author: {
            required: true,
            minlength: 2,
            alphaRegex: true
          },
    
          email: {
            required: true,
            email: true
          },
    
          comment: {
            required: true,
            minlength: 10
          }
        },

        messages: {
            "author": {
                required: "Họ tên không được bỏ trống",
                minlength: "Họ tên phải từ {0} ký tự trở lên", 
                alphaRegex:"Chỉ cho phép nhập chữ",
            },
            "email": {
                required: "Email không được bỏ trống",
                email: "Email chưa đúng định dạng",
            },
            "comment": {
                required: "Vui lòng nhập nội dung bình luận của bạn",
                minlength: "Độ dài của bình luận phải từ {0} ký tự trở lên ",
            }
        },
    
        errorElement: "div",
        errorPlacement: function(error, element) {
          element.after(error);
        }

    });
    //function
    $.validator.addMethod("alphaRegex", function (value, element) {
        return this.optional(element) || /^[a-z\-]+$/i.test(value);
    });
});