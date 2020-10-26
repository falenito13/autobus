var nSliderObj = null;
$.fn.nSlider = function() {
    try {
        nSliderObj = vipTours;
        if (nSliderObj.length != undefined) {
            return false;
        }
    } catch (e) {
        return false;
    }
    var f_time = 500;
    var f_set_time_out;
    var f_slide_interval = 10000;
    var sl = $(this);
    var f_i = sl.find('.n-slider-points').find('i:first-child');
    f_i.addClass('active');
    sl.find('.n-slider-img').html('<a><img src="/uploads/photos/tours1/thumbs/' + nSliderObj[f_i.data('id')].id + '_1.jpg" alt="" style="display:none;"/></a>');
    sl.find('.n-slider-img img').first().load(function() {
        $(this).fadeIn(f_time, function() {
            sl.find('.n_slide_info h2').text(nSliderObj[f_i.data('id')].comp);
            sl.find('.n_slide_info h3 a').text(nSliderObj[f_i.data('id')].title).attr('href', 'tours_' + nSliderObj[f_i.data('id')].cat + '?id=' + nSliderObj[f_i.data('id')].id + '#content').show();
            sl.find('.n_slide_info div').html(nSliderObj[f_i.data('id')].descr).addClass('active-1');
            sl.find('.n_slide_info a').attr('href', 'tours_' + nSliderObj[f_i.data('id')].cat + '?id=' + nSliderObj[f_i.data('id')].id + '#content').show();
            sl.find('.n-slider-img a').attr('href', 'tours_' + nSliderObj[f_i.data('id')].cat + '?id=' + nSliderObj[f_i.data('id')].id + '#content').show();
        });
        f_set_time_out = setTimeout('f_next()', f_slide_interval);
    });
    sl.find('.n-slider-points').find('i').click(function(e) {
        var i = $(this);
        if (i.hasClass('active')) {
            return false;
        }
        sl.find('.n-slider-img').append('<a><img src="/uploads/photos/tours1/thumbs/' + nSliderObj[i.data('id')].id + '_1.jpg" alt="" style="display:none;"/></a>');
        sl.find('.n-slider-img img').last().load(function() {
            sl.find('.n-slider-points').find('i').removeClass('active');
            i.addClass('active');
            sl.find('.n-slider-img img').first().fadeOut(f_time, function() {
                $(this).remove();
            });
            $(this).fadeIn(f_time, function() {
                sl.find('.n_slide_info h2').text(nSliderObj[i.data('id')].comp);
                sl.find('.n_slide_info h3 a').text(nSliderObj[i.data('id')].title).attr('href', 'tours_' + nSliderObj[f_i.data('id')].cat + '?id=' + nSliderObj[f_i.data('id')].id + '#content').show();
                sl.find('.n_slide_info div').html(nSliderObj[i.data('id')].descr).addClass('active-1');
                sl.find('.n_slide_info a').attr('href', 'tours_' + nSliderObj[i.data('id')].cat + '?id=' + nSliderObj[i.data('id')].id + '#content').show();
                sl.find('.n-slider-img a').attr('href', 'tours_' + nSliderObj[i.data('id')].cat + '?id=' + nSliderObj[i.data('id')].id + '#content').show();
            });
            f_set_time_out = setTimeout('f_next()', f_slide_interval);
        });
    });
    sl.mouseover(function() {
        clearTimeout(f_set_time_out);
    }).mouseleave(function() {
        f_set_time_out = setTimeout('f_next()', f_slide_interval);
    });
    f_next = function() {
        var p_index = ($('.n-slider-points i').index($('.n-slider-points i.active')));
        if (p_index == $('.n-slider-points i').length - 1) {
            p_index = 0;
        } else {
            p_index++;
        }
        $('.n-slider-points i').eq(p_index).click();
    }
}
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
$.fn.addLoader = function() {
    if ($(this).css('position') == 'static') {
        $(this).css('position', 'relative');
    }
    $(this).append('<div class="plugin-loader" id="" style="z-index: ' + maxZ() + ';"><i></i></div>');
};
$.fn.removeLoader = function() {
    $(this).find('.plugin-loader').fadeOut(150, function() {
        $(this).remove();
    });
};
var _form = {
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
        var myDropzone = Dropzone.forElement(".dropzone");
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
            var file = myDropzone.files;
            var formdata = new FormData();

            let ins = file.length;
            for (let x = 0; x < ins; x++) {
                if(file && !(file[x] instanceof File)){
                    Object.keys(file[x]).forEach(key => {
                        let image = 'File['+x+']'+'['+(key)+']';
                        formdata.append(image, file[x][key]);
                    });
                }
            }
            $.each($(obj).serializeArray(), function(k,v){
                formdata.append(v.name, v.value);
            })
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
                    if (data.StatusCode == 0) {
                        $.toast({
                            heading: Lang.get('JsTrans.error'),
                            text: data.StatusMessage,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 4000,
                            stack: 6
                        });
                        return false;
                    }else if (data.StatusCode == 3) {
                        $.each(data.StatusMessage, function(i) {
                            $.toast({
                                heading: Lang.get('JsTrans.error'),
                                text: data.StatusMessage[i],
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 10000,
                                stack: 10
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
var cookieHelper = {
    checkInCookie: function(key, id) {
        return id === null || this.getDataFromCookie(key).indexOf(id.toString()) === -1;
    },
    getDataFromCookie: function(key) {
        var data = $.cookie(key);
        if (data === null || data === '') {
            return [];
        }
        return data.split(',');
    },
    setDataInCookie: function(key, id) {
        if (id !== null && id !== '') {
            var arr = this.getDataFromCookie(key);
            arr.push(id);
            $.cookie(key, arr, { expires: 30, path: '/', domain: '', secure: false });
        }
    }
}
var iblock = {
    key: 'iblock',
    show: function() {
        var that = this;
        $.each($('[data-iblock]'), function() {
            try {
                var data = $(this).data('iblock');
                if (typeof data === 'object') {
                    if (cookieHelper.checkInCookie(that.key, data.id)) {
                        $(this).addClass('iblock-cloud-block').append(
                            '<div class="iblock-cloud __' + data.side + ' active">' +
                            '<div class="iblock-cloud-cnt">' + data.text + '</div>' +
                            '<span class="iblock-cloud-close" onclick="iblock.close(this, ' + (data.id === '' ? 0 : data.id) + ', event)" title="' + langs.Close + '"></span>' +
                            '</div>');
                        return false;
                    }
                }
            } catch (e) {}
        });
    },
    close: function(obj, id, event) {
        $(obj).parent().removeClass('active');
        cookieHelper.setDataInCookie(this.key, id);
        this.show();
        event.preventDefault();
    }
}
var tooltip = {
    show: function() {
        $.each($('[data-tooltip]'), function() {
            try {
                var data = $(this).data('tooltip');
                if (typeof data !== 'object') {
                    data = { text: data, side: 'top' }
                }
                $(this).mouseover(function() {
                    $(this).addClass('iblock-cloud-block').append(
                        '<div class="iblock-cloud iblock-tooltip __' + data.side + ' active">' +
                        '<div class="iblock-cloud-cnt">' + data.text + '</div>' +
                        '</div>');
                }).mouseout(function() {
                    $(this).find('.iblock-cloud').remove();
                });
            } catch (e) {}
        });
    }
}
