$(document).ready(function () {

    var $modalOverlay = $('.modal-overlay'),
        $modalContainer = $('.modal-container'),
        $modalTrigger = $('.modal-trigger'),
        $modalClose = $('.modal-close');

    $modalTrigger.on('click', function () {
        $modalContainer.toggleClass('modal--show');
    });

    $modalOverlay.on('click', function () {
        $modalContainer.toggleClass('modal--show');
    });

    $modalClose.on('click', function () {
        $modalContainer.removeClass('modal--show');
    });

    $('.menu-nav__multi').click(function () {
        if ($(this).find('.menu-nav__dropdown').hasClass('active')) {
            $(this).find('.menu-nav__dropdown').removeClass('active');
        }
        else {
            $('.menu-nav__dropdown').removeClass('active');
            $(this).find('.menu-nav__dropdown').addClass('active');
        }
    });

    $('.menu-mobile-nav').click(function () {
        $('.mobile-menu').addClass('active');
        $('body').addClass('overlay-close');
    });

    $('.mobile-menu__close').click(function () {
        $('.mobile-menu').removeClass('active');
        $('body').removeClass('overlay-close');
    });

    $('.mobile-filter').click(function () {
        $('.filter').addClass('active');
        $('.mobile-menu').removeClass('active');
    });

    $('.filter__close').click(function () {
        $('.filter').removeClass('active');
    });

});

// register
$(function () {
    $("form[name='register']").validate({
        rules: {
            nameSurname: {
                required: true,
            },
            userName: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            password: {
                required: "Şifre alanını doldurunuz",
                minlength: "Minimum 5 karakter uzunluğunda olmalı."
            },
            email: "E-posta adresininiz doğru yazdığınızdan emin olunuz.",
            nameSurname: "İsim ve soyisim alanını doldurunuz.",
            userName: "Kullanıcı adını doldurunuz."
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});


// login
$(function () {
    $("form[name='login']").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            password: {
                required: "Şifre alanını doldurunuz",
                minlength: "Şifreniz minimum 5 karakter uzunluğunda olmalıdır."
            },
            email: "E-posta adresininiz doğru yazdığınızdan emin olunuz."
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});


// upload skin
$(function () {
    $("form[name='upload']").validate({
        rules: {
            nameSurname: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            company: {
                required: true,
            },
            credits: {
                required: true,
            },
            title: {
                required: true,
            },
            description: {
                required: true,
            },
            screenShot: {
                required: true,
            },
            skin: {
                required: true,
            },
        },
        messages: {
            nameSurname: "Ad Soyad alanını doldurunuz.",
            email: "E-posta adresininiz doğru yazdığınızdan emin olunuz.",
            company: "Şirket adını doldurunuz",
            credits: "Kredi alanını doldurunuz.",
            title: "Başlık alanını doldurunuz.",
            description: "Açıklama alanını doldurunuz",
            screenShot: "ScreenShot alanını doldurunuz",
            skin: "Skin alanını doldurunuz",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
var _URL = window.URL || window.webkitURL;
$(":file").change(function () {
    var orjThis = $(this);
    var file, img;
    var imgWidth;
    var imgHeight;
    var filename = $(this).val();
    var ext = filename.split('.').pop().toLowerCase();
    if (this.files[0].type !== 'image/png' && this.files[0].type !== 'image/jpeg') {
        $(this).parent().find(".noFile").text("Only PNG/JPG");
        $(this).parent().find(".noFile").addClass('text-danger');
    }
    else {
        $(this).parent().find(".noFile").removeClass('text-danger');
        if (/^\s*$/.test(filename)) {
            $(this).parent().parent().removeClass('active');
            $(this).parent().find(".noFile").text("No file chosen...");
        }
        else {
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    imgWidth = this.width;
                    imgHeight = this.height;
                    if (imgWidth > 2048 || imgHeight > 2048) {
                        orjThis.parent().find(".noFile").text("Maksimum 2048px çözünürlükte görsel yükleyebilirsiniz.");
                        orjThis.parent().find(".noFile").addClass('text-danger');
                        orjThis.parent().parent().removeClass('active');
                    }
                    else {
                        orjThis.parent().parent().addClass('active');
                        orjThis.parent().find(".noFile").text(filename.replace("C:\\fakepath\\", ""));
                    }
                };
                img.onerror = function () {
                    //alert( "not a valid file: " + file.type);
                };
                img.src = _URL.createObjectURL(file);

            }
        }
    }
});

$(function() {
    var _URL = window.URL || window.webkitURL;

    $(":file").change(function() {

        var orjThis = $(this);

        var file, img;

        var imgWidth;
        var imgHeight;

        var filename = $(this).val();

        var ext = filename.split('.').pop().toLowerCase();

        if(this.files[0].type !== 'image/png' && this.files[0].type !== 'image/jpeg' && this.files[0].type !== 'application/pdf') {
            $(this).parent().find(".noFile").text("Only PNG/JPG");
            $(this).parent().find(".noFile").addClass('text-danger');
        }
        else{
            $(this).parent().find(".noFile").removeClass('text-danger');
            if (/^\s*$/.test(filename)) {
                $(this).parent().parent().removeClass('active');
                $(this).parent().find(".noFile").text("No file chosen...");
            }
            else {
                if(this.files[0].type !== 'application/pdf'){
                    if ((file = this.files[0])) {
                        img = new Image();
                        img.onload = function() {
                            imgWidth = this.width;
                            imgHeight = this.height;

                            if(imgWidth > 2048 || imgHeight > 2048){
                                orjThis.parent().find(".noFile").text("Maksimum 2048px çözünürlükte görsel yükleyebilirsiniz.");
                                orjThis.parent().find(".noFile").addClass('text-danger');
                                orjThis.parent().parent().removeClass('active');
                            }
                            else{
                                orjThis.parent().parent().addClass('active');
                                orjThis.parent().find(".noFile").text(filename.replace("C:\\fakepath\\", ""));
                            }

                        };
                        img.onerror = function() {
                            //alert( "not a valid file: " + file.type);
                        };
                        img.src = _URL.createObjectURL(file);

                    }
                }
                else{
                    orjThis.parent().parent().addClass('active');
                    orjThis.parent().find(".noFile").text(filename.replace("C:\\fakepath\\", ""));
                }
            }
        }
    });

    $("form[name='dmca']").validate({
        rules: {
            nameSurname: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            company: {
                required: true,
            },
            mod: {
                required: true,
            },
            document: {
                required: true,
            },
            complaint: {
                required: true,
            },
        },
        messages: {
            nameSurname: "Ad ve soyad alanını doldurunuz.",
            email: "E-posta adresininiz doğru yazdığınızdan emin olunuz.",
            company: "Şirket adını doldurunuz.",
            mod: "Link alanını doldurunuz.",
            document: "Dosya seçiniz.",
            complaint: "Şikayet alanını doldurunuz."
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

var i = 0;
function insert() {
    i = i + 1;
    if (i == 1) {
        $('#more-skins').append('<div class="form-group custom-border-top">'
            + ' <label for="title' + i + '">Title* </label>'
            + '<input type="text" name="title[]" class="form-control" id="title' + i + '" placeholder="Required">'
            + '</div>');
    }
    else {
        $('#more-skins').append('<div class="form-group">'
            + ' <label for="title' + i + '">Title* </label>'
            + '<input type="text" name="title[]" class="form-control" id="title' + i + '" placeholder="Required">'
            + '</div>');
    }
    /* $('#more-skins').append('<div class="form-group" id="manufacturers-group-' + i + '">'
        + ' <label for="title' + i + '">Manufacturers* </label>'
        + '</div>'); */
    /* $('#manufacturers').clone().attr('id', 'manufacturersSelect' + i).attr('name', 'manufacturers[]').appendTo($('#manufacturers-group-' + i)); */
    $('#more-skins').append('<div class="form-group" id="model-group-' + i + '">'
        + ' <label for="title' + i + '">Model* </label>'
        + '</div>');
    $('#model').clone().attr('id', 'modelSelect' + i).attr('name', 'model[]').appendTo($('#model-group-' + i));
    $('#more-skins').append('<div class="form-group p-relative">'
        + '<label for="skinFile' + i + '">Skin* <span>Only PNG/JPG</span></label>'
        + '<div class="input-group">'
        + '<div class="file-upload">'
        + '<div class="file-select" id="skin-' + i + '">'
        + '<div class="file-select-name noFile">No file chosen...</div>'
        + '<div class="file-select-button">Choose File</div>'
        + '</div>'
        + '</div>'
        + '</div>'
        + '</div>'
        + '</div>');
    $('#skin').clone().attr('id', 'skinFile' + i).attr('name', 'skin[]').appendTo($('#skin-' + i)).each(function () {
        bindClickToLink();
    });
    $('#more-skins').append('<div class="form-group p-relative">'
        + '<label for="screenshot' + i + '">Screenshot* <span>Only PNG/JPG</span></label>'
        + '<div class="input-group">'
        + '<div class="file-upload">'
        + '<div class="file-select" id="screenshot-' + i + '">'
        + '<div class="file-select-name noFile">No file chosen...</div>'
        + '<div class="file-select-button">Choose File</div>'
        + '</div>'
        + '</div>'
        + '</div>'
        + '</div>'
        + '</div>');
    $('#screenShot').clone().attr('id', 'screenshotFile' + i).attr('name', 'screenshot[]').appendTo($('#screenshot-' + i)).each(function () {
        bindClickToLink();
    });;
    $('#more-skins').append('<div class="form-group custom-border-bottom">'
        + '<label for="description">Description*</label>'
        + '<textarea class="form-control" id="description' + i + '" name="description[]" rows="10" placeholder="Required"></textarea>'
        + '</div>');
}

function bindClickToLink() {
    var _URL = window.URL || window.webkitURL;
    $(":file").change(function () {
        var orjThis = $(this);
        var file, img;
        var imgWidth;
        var imgHeight;
        var filename = $(this).val();
        var ext = filename.split('.').pop().toLowerCase();
        if (this.files[0].type !== 'image/png' && this.files[0].type !== 'image/jpeg') {
            $(this).parent().find(".noFile").text("Only PNG/JPG");
            $(this).parent().find(".noFile").addClass('text-danger');
        }
        else {
            $(this).parent().find(".noFile").removeClass('text-danger');
            if (/^\s*$/.test(filename)) {
                $(this).parent().parent().removeClass('active');
                $(this).parent().find(".noFile").text("No file chosen...");
            }
            else {
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onload = function () {
                        imgWidth = this.width;
                        imgHeight = this.height;

                        if (imgWidth > 2048 || imgHeight > 2048) {
                            orjThis.parent().find(".noFile").text("Maksimum 2048px çözünürlükte görsel yükleyebilirsiniz.");
                            orjThis.parent().find(".noFile").addClass('text-danger');
                            orjThis.parent().parent().removeClass('active');
                        }
                        else {
                            orjThis.parent().parent().addClass('active');
                            orjThis.parent().find(".noFile").text(filename.replace("C:\\fakepath\\", ""));
                        }

                    };
                    img.onerror = function () {
                        //alert( "not a valid file: " + file.type);
                    };
                    img.src = _URL.createObjectURL(file);

                }
            }
        }
    });
}
