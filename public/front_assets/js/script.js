$(document).ready(function(){
    $('.offer-modal .close-btn').click(function(){
        $(this).parents('.offer-modal').removeClass('active');
    });
    $(document).mouseup(function(e) {
        var container = $(".offer-modal.active .inner");
        (!container.is(e.target) && container.has(e.target).length === 0) ? container.parents('.offer-modal').removeClass('active') : "";
    });
    var TourID = null;
    var Lang = $('#LangLocal').html();
    // login popup
    $('.log-in-btn').click(function(){
        $('.sign-form').addClass('active');
    });
    $('.sign-form .close-btn').click(function(){
        $('.sign-form').removeClass('active');
    });
    $(document).mouseup(function(e) {
        var container = $(".sign-form.active .sign-inner");
        (!container.is(e.target) && container.has(e.target).length === 0) ? container.parents('.sign-form').removeClass('active') : "";
    });
    // choose language
    $('.langs').click(function(){
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
    })
    $('.langs li').click(function(){
        $(this).parents('.langs').find('span').text($(this).text());
    });
    $(document).mouseup(function(e) {
        var container = $(".langs");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.removeClass('active');
        }
    });
    // change tabs
    $('.our-fleet .top-tab li').click(function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        var thisID = $(this).data('id');
        $('.our-fleet .bottom-tab li').removeClass('active');
        $('.our-fleet .bottom-tab').find("[data-id='"+ thisID +"']").addClass('active');
        $('.our-fleet .tab li').hide(300);
        $('.our-fleet .tab').find("[data-id='"+ thisID +"']").show(300);
    });
    // offer page transport types check
    $('.transport-info .list input').on('change', function(){
        $('.transport-info .list .item').removeClass('active');
        $('.transport-info .list .item input').not($(this)).prop("checked", false);
        // $(this).prop("checked", true);
        ($(this).is(':checked')) ? $(this).parents('.item').addClass('active') : $(this).parents('.item').removeClass('active');
    });
    $('.dropdown .selected').click(function(){
        $(this).parent().toggleClass('active');
        $(this).attr('tabinex', 1).focus();
    });
    $('.dropdown li').click(function(){
        $(this).parents('.dropdown').removeClass('active');
        $(this).parents('.dropdown').find('.selected span').text($(this).text());
        $(this).parents('.dropdown').find('.selected').addClass('focused');
    });
    $(document).mouseup(function(e) {
        var container = $(".dropdown .selected");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.parent().removeClass('active');
        }
    });
    $('header .open').click(function(){
        $('.menu-wrap').addClass('active');
    });
    $('header .close-btn').click(function(){
        $('.menu-wrap').removeClass('active');
    });
    $(document).mouseup(function(e) {
        var container = $(".menu-wrap.active");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.removeClass('active');
        }
    });
    $('.return-way input').change(function(){
        ($(this).is(':checked')) ? $(this).parents('.search').find('.append').addClass('active') : $(this).parents('.search').find('.append').removeClass('active');
    });
    $('.dropdown .select').click(function(){
        $(this).parent().toggleClass('active');
        $(this).attr('tabinex', 1).focus();
    });
    $('.child-seat.dropdown li').click(function(){
        $(this).parents('.dropdown').addClass('active');
    })
    $('.child-seat.dropdown li .number-wrap button').click(function(){
        if( $(this).parents('.number-wrap').find('.detail-input').val() <= 0 ){
            $(this).parents('.number-wrap').find('.detail-input').val(0);
        }
        var text = '';
        $('.child-seat.dropdown li .number-wrap .detail-input').each(function() {
            if ($(this).val() > 0) {
                text += $(this).parents('li').find('h5').text() + ' ' + $(this).val() + '; ';
            }
        });
        var resetText = $(this).parents('.dropdown').find('.select span').data('text');
        if(text == ''){
            $(this).parents('.dropdown').find('.select span').removeClass('focused').text(resetText);
        } else {
            $(this).parents('.dropdown').find('.select span').addClass('focused').text(text);
        }
    })
    $(document).mouseup(function(e) {
        var container = $(".child-seat .select");
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.parent().removeClass('active');
        }
    });
    $('#datetimepicker1').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY/MM/DD',
        sideBySide: false
    });
    $('#datetimepicker3').datetimepicker({
        defaultDate: new Date(),
        format: 'H:mm',
        sideBySide: false
    });
    $('#datetimepicker2').datetimepicker({
        //defaultDate: new Date(),
        format: 'YYYY/MM/DD',
        sideBySide: false
    });
    $('#datetimepicker4').datetimepicker({
       // defaultDate: new Date(),
        format: 'H:mm',
        sideBySide: false
    });
    $('#datetimepicker5').datetimepicker({
        //defaultDate: new Date(),
        format: 'YYYY/MM/DD',
        sideBySide: false
    });
    $('#datetimepicker6').datetimepicker({
        //defaultDate: new Date(),
        format: 'H:mm',
        sideBySide: false
    });
    $('.promo input[type="checkbox"]').change(function(){
        ($(this).is(':checked')) ? $(this).parent().find('.promo-code').addClass('active') : $(this).parent().find('.promo-code').removeClass('active');
    });
    // offer page slider
    $('.offer-page .slider .owl-carousel').owlCarousel({
        loop:true,
        margin:0,
        smartSpeed: 500,
        nav:false,
        responsive:{
            0:{
                items:1
            }
        }
    })
    $('.close-mod').click(function(){
        $('#myModal').removeClass('active');
    });
    var offerSlider = $('.offer-page .slider .owl-carousel').owlCarousel();
    $(document).on('click', '.slider .left.arrow' ,function () {
        offerSlider.trigger('prev.owl.carousel');
    })
    $(document).on('click', '.slider .right.arrow' ,function () {
        offerSlider.trigger('next.owl.carousel');
    });
    $('.offer-page .input-form.phone .dropdown li').click(function(){
        var thisSrc = $(this).find('img').attr('src');
        $(this).parents('.dropdown').find('.flag').attr('src', thisSrc)
    });
    $('.autopark .owl-carousel').owlCarousel({
        loop:false,
        margin: 10,
        dots: true,
        nav: false,
        responsive:{
            0:{
                items:1
            }
        }
    })
    $('.search .btn-wrapper button').click(function(){
        var thisID = $(this).data('id');
        // $(this).parent().find('input[type=hidden]').val(thisID);
        $(this).parent().find('button').removeClass('active');
        $(this).addClass('active');
        $(this).parents('.find').find('.display-none').removeClass('active');
        $(this).parents('.find').find("[data-id='"+ thisID +"']").addClass('active');

    })
    //offer search
    $('.intro .search .search-input').each(function () {
        // $(this).parent().find('input.checked').parent().addClass('d-n');
        var checkedText = $(this).parent().find('input.checked').parent().find('span').text();
        $(this).val(checkedText);
    })
    function checkedFrom (){
        var data =  $('.intro .search .search-input.from').parent().find('input.checked').data('lat') + "," + $('.intro .search .search-input.from').parent().find('input.checked').data('lng');
        return data;
    }
    function checkedTo () {
        var data =  $('.intro .search .search-input.to').parent().find('input.checked').data('lat') + "," + $('.intro .search .search-input.to').parent().find('input.checked').data('lng');
        return data;
    }

    if(checkedFrom()!= "undefined,undefined" && checkedTo()!= "undefined,undefined"){
            myMap(checkedFrom(), checkedTo());
    }
    $('.search-input').click(function () {
        $(this).parents('.input-wrapper').find('.appended').addClass('d-none');
        $(this).parent().find('.appended').removeClass('d-none');
    })
    var checkedID;
    var checked1;
    var checked2;
    $(document).on('click', '.appended' ,function () {
        // $(this).parents('.inner').find('.search-input').focus();
        $(this).parents('.inner').find('.search-input').val($(this).find('a span').text());
        $(this).parents('.inner').find('.search-input-hidden').val($(this).find('input').val());
        var appendedID = $(this).find('input[type=hidden]').attr('id');
        $(this).parents('.inner').find('.search-from').val(appendedID);
        $(this).siblings().removeClass('d-n');
        $(this).addClass('d-n');
        $(this).siblings().addClass('d-none');
        $(this).siblings().find('input[type=hidden]').removeClass('checked');
        $(this).find('input[type=hidden]').addClass('checked');
    });
    $(document).on('click', '.inner.first .appended' ,function () {
        var oldID = $(this).parent().find('input.checked').attr('id');
        checkedID = $(this).find('input[type=hidden]').attr('id');
        var secondID = $('.inner.sec .search-result').find('input.checked').attr('id');
        // $('.inner.sec .search-result').find('.appended').removeClass('d-n');
        // $('.inner.sec .search-result').find("[id='"+ checkedID +"']").parent().addClass('d-n');
        checked1 =  $(this).find('.checked').data('lat')+","+$(this).find('.checked').data('lng');
        checked1title =  $(this).find('.checked').data('id');
        mapsearch()
        if(checkedID == secondID){
            $('.inner.sec').find('input.checked').removeClass('checked');
        }
    })
    $(document).on('click', '.inner.sec .appended' ,function () {
        checked2 =  $(this).find('.checked').data('lat')+","+$(this).find('.checked').data('lng');
        checked2title =  $(this).find('.checked').data('id');
        mapsearch()
    })
    $(document).on('click', '.tours .appended' ,function () {
        var fromChecked =  $(this).find("[data-name='from']").data('id');
        var toChecked =  $(this).find("[data-name='to']").data('id');
        var fromCheckedtitle =  $(this).find("[data-name='from']").data('title');
        var toCheckedtitle =  $(this).find("[data-name='to']").data('title');
        var Idfrom = $(this).find("[data-name='from']").data('id');
        var Idto = $(this).find("[data-name='to']").data('id');
        var tourid = $(this).find("[data-name='from']").data('tour');
        $('.tourid').val(tourid);
        $('.input-data').find("[name='from']").val(fromCheckedtitle);
        $('.input-data').find("[name='to']").val(toCheckedtitle);
        $('.input-data').find("[name='fromvalue']").val(Idfrom);
        $('.input-data').find("[name='tovalue']").val(Idto);
        checked1title = fromChecked;
        checked2title = toChecked;
        TourID = tourid;
        checked1 =  $(this).find("[data-name='from']").data('lat')+","+$(this).find("[data-name='from']").data('lng');
        checked2 =  $(this).find("[data-name='to']").data('lat')+","+$(this).find("[data-name='to']").data('lng');

        if (typeof myMap == 'function') {
            mapsearch();
            setTimeout(function(){
                myMap(checked1, checked2);
            }, 1000);
        }
    })
    $(document).mouseup(function(e) {
        var container = $(".inner .search-input");
        (!container.is(e.target) && container.has(e.target).length === 0) ? container.parents('.inner').find('.appended').addClass('d-none') : "";
    });





    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    function mapsearch(){
        if (typeof myMap == 'function') {
            if(checked1!=null && checked2!=null && checked1!="undefined,undefined" && checked2!="undefined,undefined"){
                myMap(checked1, checked2);
                // console.log(checked1title,checked2title)
                $.get('/offersas', {from: checked1title, to: checked2title, tourId:TourID}, function(d){
                    if(d.item) {
                        $.each(d.item.car_prices_by_location , function( index, value ) {
                            $('#cost-'+value.cat_id).empty().append(`<span>From <strong>${value.price}<b>₾</b></strong></span>`);
                        });
                    } else {
                        $.each(d.Category , function( index, value ) {
                            $('#cost-'+value.id).empty().append(`<span>From <strong>${value.price}<b>₾</b></strong></span>`);
                        });
                    }
                    if(d.cartour.length>0) {
                        $.each(d.cartour , function( index, value ) {
                            $('#Tourcost-'+value.cat_id).empty().append(`<span>From <strong>${value.price}<b>₾</b></strong></span>`);
                        });
                    }else{
                        $.each(d.Category , function( index, value ) {
                            $('#Tourcost-'+value.id).empty().append(`<span>From <strong>${value.price}<b>₾</b></strong></span>`);
                        });
                    }
                    if(d.Tour) {
                        var images = '';
                        $.each(d.Tour.images , function( index, value ) {
                            images+=`<div class="item">
                                        <div class="img-container">
                                            <img src="/uploads/${value.route_name}/large/${value.name}" alt="">
                                        </div>
                                     </div>`;
                        });
                        $('#Tourdiv').empty().append(`<div class="rightside">
                            <div class="slider">
                                <button type="button" class="left arrow">
                                    <img src="/front_assets/img/arrow-left.svg" alt="">
                                </button>
                                <button type="button" class="right arrow">
                                    <img src="/front_assets/img/arrow-right.svg" alt="">
                                </button>
                                <div class="owl-carousel owl-theme owl-appended">
                                    ${images}
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <button type="button">
                                    <img src="/front_assets/img/distance.svg" alt="">
                                    Distance:  <span class="distancetext2"> 377km </span>
                                </button>
                                <button type="button">
                                    <img src="/front_assets/img/duration.svg" alt="">
                                    Tour duration: <span class="durationtext2"> 5H 0 min</span>
                                </button>
                            </div>
                            <h2 class="title" id="Tour_title">${d.Tour.title[Lang]}</h2>
                            <div class="text">
                                ${d.Tour.descr[Lang]}
                            </div>
                            <div class="btn-wrap special">
                                <button type="button" onclick="openOffersModal();">
                                    Get a special tour
                                </button>
                            </div>
                        </div>`);
                        // myMap(checked1, checked2);
                        $('.owl-carousel.owl-appended').owlCarousel({
                            loop:true,
                            margin:0,
                            smartSpeed: 500,
                            nav:true,
                            responsive:{
                                0:{
                                    items:1
                                }
                            }
                        })
                        $(document).on('click', '.slider .left.arrow' ,function () {
                            $('.owl-appended .owl-prev').trigger('click');
                        })
                        $(document).on('click', '.slider .right.arrow' ,function () {
                            $('.owl-appended .owl-next').trigger('click');
                        })
                    }else{
                        $('#Tourdiv').empty();
                    }
                });
            }
        }
    }
    // $(document).click(function () {
    //     console.log(checkedID);
    // })
    // $('.search-input').focusout(function () {
    //     $(this).parent().find('.appended').addClass('d-none');
    // })

});
function changeclass(text){
        $('.routeortour').each(function(){
            if($(this).hasClass('active')){
                $('.routeor').val(text);
            }
        });
    }
function openOffersModal(){
    let OffersModal = $("#SpecialOffers");
    OffersModal.addClass('active')
}
function savePostContact(obj) {
    _form.checkFields(obj, function() {
        if (_form.response.StatusCode === 1) {
            swal('ოპერაცია წარმატებით შესრულდა!')
        } else {
            $.toast({
                heading: 'დაფიქსირდა შეცდომა',
                text: _form.response.StatusMessage,
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: 'danger',
                hideAfter: 2500,
                stack: 6
            });
        }
    });
    return false;
}
const _form = {
    response: {},
    data: {
        files: [],
    },
    fields: {
        captchaVal: '#CaptchaVal',
        files: '.files-list',
    },
    tags: {
        filesList: 'li:not(:last-child)',
    },

    checkFields: function(obj, callback) {
        var error = false;
        var field = false;
        var name = '';
        var parent;
        $.each($(obj).find(':text:visible, :password:visible, select:visible, textarea:visible'), function() { /*:checkbox:visible,*/
            parent = $(this).parent('p').length ? $(this).parent('p') : $(this).parents('div').first();
            if (($(this).is(':checkbox') && !$(this).is(':checked')) ||
                ($(this).data('error') && $.trim($(this).val()) == '') ||
                ($(this).data('type') == 'email' && !isEmail($(this).val())) ||
                ($(this).data('type') == 'int' && !isInt($(this).val())) ||
                ($(this).data('type') == 'double' && !isFloat($(this).val())) ||
                ($(this).data('minlength') && $.trim($(this).val()).length < $(this).data('minlength')) ||
                ($(this).data('min') && $(this).val() <= $(this).data('min')) ||
                ($(this).data('lengths') && $(this).data('lengths').indexOf($.trim($(this).val()).length) == -1) ||
                ($(this).data('equals') && $(this).val() != $(obj).find('[name="' + $(this).data('equals') + '"]').val())
            ) {
                name = $(this).attr('name') != undefined ? $(this).attr('name').replace('[]', '') : '';
                parent.next('#input-error-' + name).remove();
                parent.after('<p class="input-error" id="input-error-' + name + '">' + $(this).data('error') + '</p>');
                error = true;
                field = field == false ? $(this) : field;
            } else {
                name = $(this).attr('name') != undefined ? $(this).attr('name').replace('[]', '') : '';
                parent.next('#input-error-' + name).remove();
            }
        });
        if (field) {
            field.focus();
        }
        if (!error) {
            var formdata = new FormData();

            $.each($(obj).serializeArray(), function(k,v){
                formdata.append(v.name, v.value);
            })
            console.log($(obj).attr('action'));
            $.ajax({
                url: $(obj).attr('action'),
                data: formdata,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if ((data = _form.parseJSON(data)) === false) {
                        return false;
                    }
                    if ((data = _form.parseJSON(data)) === false) {
                        return false;
                    }
                    if (data.StatusCode === 0) {
                        $.toast({
                            heading: 'დაფიქსირდა შეცდომა',
                            text: data.StatusMessage,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 4000,
                            stack: 8
                        });
                        return false;
                    }else if (data.StatusCode === 3) {
                        $.each(data.StatusMessage, function(i) {
                            $.toast({
                                heading: 'დაფიქსირდა შეცდომა',
                                text: data.StatusMessage[i],
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 10000,
                                stack: 8
                            });
                        });

                        return false;
                    }
                    _form.response = data;
                    if (typeof callback == 'function') {
                        callback();
                    } else {
                        $.toast({
                            heading: Lang.get('JsTrans.error'),
                            text: Lang.get('JsTrans.error_appeared'),
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 2500,
                            stack: 6
                        });
                    }
                }
            });
        }
        return error;
    },
    removeInputErrors: function(obj) {
        $(obj).find('.input-error').remove();
    },
    parseJSON: function(data) {
        try {
            data = $.parseJSON(data);
        } catch (e) {}
        if (['boolean', 'number', 'string', 'symbol', 'function'].indexOf(typeof data) == -1) {
            return data;
        } else {
            swal('Error');
            return false;
        }
    },
    focus: function() {
        var text = $('form').last().find(':text').first();
        var val = text.val();
        text.val('').val(val).focus();
    }
}
const user = {
    fields: {
        email: '#Email',
        password: '#Password',
        phone: '#Phone',
        message: '#Message',
        currentPassword: '#CurrentPassword',
    },
    logIn: function(obj) {
        _form.checkFields(obj, function() {
            if (_form.response.StatusCode === 1) {
                location.href = $(obj).data('success-url');
            } else {
                $.toast({
                    heading: 'დაფიქსირდა შეცდომა',
                    text: _form.response.StatusMessage,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'danger',
                    hideAfter: 2500,
                    stack: 6
                });
            }
        });
        return false;
    },
    changePassword: function(obj, newPassword) {
        _form.checkFields(obj, function() {
            jAlert(_form.response.StatusMessage, null, function(){
                if (_form.response.StatusCode == 1) {
                    if (newPassword) {
                        location.href = $(obj).data('success-url');
                    } else {
                        $(obj)[0].reset();
                    }
                } else if(_form.response.StatusCode == 2) {
                    $(user.fields.currentPassword).focus();
                }
            });
        });
        return false;
    },
    recover: function(obj) {
        _form.checkFields(obj, function() {
            jAlert(_form.response.StatusMessage, null, function() {
                if (_form.response.StatusCode == 1) {
                    location.href = $(obj).data('success-url');
                } else if (_form.response.StatusCode == 2) {
                    $(obj).find(user.fields.email).focus();
                }
            });
        });
        return false;
    },
    register: function(obj) {
        _form.checkFields(obj, function(){
            if (_form.response.StatusCode === 1) {
                location.href = $(obj).data('success-url');
            } else {
                $.toast({
                    heading: 'დაფიქსირდა შეცდომა',
                    text: _form.response.StatusMessage,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'danger',
                    hideAfter: 2500,
                    stack: 6
                });
            }
        });
        return false;
    },
    resendActEmail: function(obj) {
        _form.checkFields(obj, function() {
            jAlert(_form.response.StatusMessage, null, function() {
                if (_form.response.StatusCode === 1) {
                    location.href = $(obj).data('success-url');
                } else if (_form.response.StatusCode === 2) {
                    $(obj).find(user.fields.email).focus();
                }
            });
        });
        return false;
    },
    savePost: function(obj) {
        _form.checkFields(obj, function() {
            if (_form.response.StatusCode === 1) {
                swal('ოპერაცია წარმატებით შესრულდა!')
            } else {
                $.toast({
                    heading: 'დაფიქსირდა შეცდომა',
                    text: _form.response.StatusMessage,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'danger',
                    hideAfter: 2500,
                    stack: 6
                });
            }
        });
        return false;
    }

};

