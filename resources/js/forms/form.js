import Axios from "axios";

$(function(){
    $('form[data-garbage-cms-form]').on('submit', function(ev){
        ev.preventDefault();

        var formData = {};

        $(this).find('input[name]').each(function(input){
            formData[$(this).attr('name')] = $(this).val();
        });


        Axios.post($(this).attr('action'));
    });
});

