// script.js by ashta -> depending on jquery & bootstrap library
// created at 25/10/2020, updated at 03/11/2020, 08/11/2020

const spin = '<i class="fa fa-spin fa-circle-o-notch"></i>';

const baseUrl = (url) => $('meta[name="base-url"]').attr('content')+'/'+(url || '')
const csrf = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} // for laravel

$.fn.dis = function(value){ $(this).prop('disabled', value); }

class Request {

    /*  GET, parameters -> 
        url(string) required, success(function) optional, error(function) optional
    */

    get(url, params){
        let config = {}

        config = {
            url: url,
            type: 'get',
            success: function(res){
                if(params.success) params.success(res)
            }, error: function(err){
                params.error ? params.error(err) : new OnError().check(err)
            }
        }

        $.ajax(config)
    }

    /*  POST, parameters -> 
        url(string) required, type(string) required, data(object) required,
        success(function) optional, error(function) optional
    */

    post(url, params, t){
        let btn, def, config = {}

        if(params.el){
            btn = params.el, def = btn.html();
            btn.html(spin).dis(true);
        }

        config = {
            headers: csrf,
            url: baseUrl(url),
            type: 'post',
            data: params.data,
            success: function(res){
                if(params.success) params.success(res)
            }, error: function(err){
                params.error ? params.error(err) : new OnError().check(err)
            }
        }

        if(config.data instanceof FormData){
            config.contentType = false
            config.processData = false

            if(t){
                let formData = params.data
                formData.append('_method', 'PUT')

                config['data'] = formData
            }
        }

        $.ajax(config).always(function(){
            if(params.el) btn.html(def).dis(false)
        })
    }

    /*  PUT, parameters -> 
        url(string) required, type(string) required, data(object) required,
        success(function) optional, error(function) optional
    */

    put(url, params){
        this.post(url, params, true)
    }

    /*  DELETE, parameters -> 
        url(string) required, success(function) optional, error(function) optional
    */

    delete(url, params){
        let config = {}

        config = {
            headers: csrf,
            url: url,
            type: 'delete',
            success: function(res){
                if(params.success) params.success(res)
            }, error: function(err){
                params.error ? params.error(err) : new OnError().check(err)
            }
        }

        $.ajax(config)
    }
}

const request = new Request()


// TOAST =====

var ___interval;
function timer(time, callback){
    ___interval = setInterval(function(){
        time -= 1; time <= 0 && clearInterval(___interval) | callback()
    }, 1000);
}

class Toast {
    
    // use: new Toast().view('lorem')
    view(message){
        $('.fn-toast').remove();
        $('body').append( '<div class="fn-toast toast-slide"> '+(message || 'No Message')+' </div>' );

        clearInterval(___interval);
        timer(5, function(){
            $('.fn-toast').fadeOut(500);
        });
    }
}

// ERROR HANDLER =====

class OnError {
    check(error){
        const t = new Toast(),
            status = error.status,
            response = error.responseJSON || status + ' - Unknown Error'

        t.view(response.message || response.error)
        console.log(response)
    }
}


// HELPER =====

    // use: moveTo('home', {delay: 500}), parameter -> delay(int) optional
const moveTo = (url, param = {}) => url == '.' ? location.reload() :
    setTimeout(() => location.href = url, param.delay || 0) 

    // ex: blabla.com?lorem=ipsum -> use: urlp('lorem')
const urlp = (v) => {
    let url = new URLSearchParams(window.location.search)
    return v == null ? location.href : url.get(v)
}

const getAge = (dateString) => {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age < 0 ? '-' : age;
}

    // ex: dataURLtoFile(base64:blabla, 'file.png')
const dataURLtoFile = (dataurl, filename) => {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), 
        n = bstr.length, 
        u8arr = new Uint8Array(n);
        
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    
    return new File([u8arr], filename, {type:mime});
}

    // kelompokkan data object dalam array berdasarkan properti
const groupByKey = (list, key) => list.reduce((hash, obj) => ({...hash, [obj[key]]:( hash[obj[key]] || [] ).concat(obj)}), {})


    // set form pada modal, dengan begitu kita tinggal membuat fungsi submitnya saja
$.fn.setForm = function(action){
    let mb = $(this).find('.modal-body'),
        mf = $(this).find('.modal-footer')

    mb.remove()
    mf.remove()

    $(this).find('.modal-content').append(
        $(`<form> <div class="modal-body">`+mb.html()+`</div>
            <div class="modal-footer">`+mf.html()+`</div>
        </form>`).on('submit', () => {
            if(action) action($(this).find('form')[0])
            return false
        })
    )
}

$.fn.modalConfig = function(action, params){
    let mb = $(this).find('.modal-body'),
        mf = $(this).find('.modal-footer')

    mb.remove()
    mf.remove()

    $(this).find('.modal-content').append(
        $(`<form> <div class="modal-body">`+mb.html()+`</div>
            <div class="modal-footer">`+mf.html()+`</div>
        </form>`).on('submit', () => {
            if(action) action($(this).find('form')[0])
            return false
        })
    )

    if(params.title) $(this).find('.modal-title').html(params.title)

    if(params.initData){
        let data = params.initData

        for (const key in data) {
            $(this).find('input').each(function(){
                switch ($(this).attr('type')) {
                    case 'radio':
                        $(this).each(function(){
                            if($(this).attr('name') == key && $(this).attr('value') == data[key]) $(this).prop('checked', true)
                        })
                        break;
                
                    default: if($(this).attr('name') == key) $(this).val(data[key])
                        break;
                }
            })
        }

    }
}

$.fn.onConfirm = function(action){
    let btn = $(this).find('button:submit'), def = btn.html()

    btn.on('click', () => {
        btn.html(spin).dis(true)
        action({'button': btn[0], 'default': def})
    })
}

// random array, use: [].random()
Array.prototype.random = function () {
    return this[Math.floor((Math.random()*this.length))];
}

