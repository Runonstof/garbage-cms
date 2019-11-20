const $ = require('jquery');
var isSubmitting = false;

function submitGarbageForm(action, data, method, ignoreSubmit) {
    //alert('keok3');
    if(!isSubmitting || ignoreSubmit) {
        //alert('keok4');
        isSubmitting = true;
        Axios[(method||'post').toLowerCase()](action, data).then(function(res){
            isSubmitting = false;
            
            if(res.data.redirect) {
                window.location = res.data.redirect;
            }
            
            var msgs = (res.data.messages||[]);
            if(res.data.message) { msgs.push(red.data.message) }
            
            for(var i = 0; i < msgs.length; i++) {
                $.notify({
                    title: msgs[i].title||'',
                    message: msgs[i].body||(typeof msgs[i] === 'string' ? msgs[i] : false)||'',
                },
                {
                    placement: {
                        from: "top",
                        align: "right"
                    },
                    type: msgs[i].type||'danger',
                    z_index: 1031,
                    delay: msgs[i].delay||2500,
                    animate: {
                        enter: 'animated fadeIn',
                        exit: 'animated fadeOutRight'
                    },
                });
            }
            
            if(res.data.submit) {
                submitGarbageForm(res.data.submit.url, res.data.submit.data||{}, res.data.submit.method||'post')
            }
        }).catch(function(){
            isSubmitting = false;
        });
    }
}

$(function(){
    $('form[data-garbage-cms-form]').on('submit', function(ev){
        ev.preventDefault();
        //alert('keok');
        if(!isSubmitting) {
            //alert('keok2');

            var formData = {};
            var $inputs = $(this).find('[name][type!=\'submit\']');
            $inputs.each(function(input){
                formData[$(this).attr('name')] = $(this).val()||$(this).html();
            });

            submitGarbageForm($(this).attr('action'),$.param(formData),$(this).attr('method'));
            
        }
    });
});
