$(function(){
    var isSubmitting = false;
    $('form[data-garbage-cms-form]').on('submit', function(ev){
        ev.preventDefault();
        if(!isSubmitting) {
            isSubmitting = true;

            Axios.post($(this).attr('action')).then(function(response){
                if(response.data.redirect) {
                    window.location = response.data.redirect;
                }
                if(response.data.message) {
                    alert( response.data.message );
                }
                isSubmitting = false;
            }).catch(function(){
                isSubmitting = false;
            });
        }
    });
});