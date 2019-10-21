const $ = require('jquery');


$(function(){
    var isSubmitting = false;
    $('form[data-garbage-cms-form]').on('submit', function(ev){
        ev.preventDefault();
        if(!isSubmitting) {
            isSubmitting = true;

            var formData = {};
            var $inputs = $(this).find('[name][type!=\'submit\']');
            $inputs.each(function(input){
                formData[$(this).attr('name')] = $(this).val()||$(this).html();
            });

            Axios[$(this).attr('method').toLowerCase()]($(this).attr('action'), $.param(formData)).then(function(res){
                if(res.data.redirect) {
                    window.location = res.data.redirect;
                }
                if(res.data.message) {
                    $.notify({
                        title: res.data.title||'',
                        message: res.data.message,
                    },
                    {
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        type: res.data.type||'danger',
                        z_index: 1031,
                        delay: res.data.delay||2500,
                        animate: {
                            enter: 'animated fadeIn',
                            exit: 'animated fadeOutRight'
                        },
                    });
                }
                isSubmitting = false;
            }).catch(function(){
                isSubmitting = false;
            });
        }
    });
});
