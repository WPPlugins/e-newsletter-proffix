$ = jQuery;
function initProffixNewsletter(element)
{
    $(function() {
        $(element).submit(function( event ) {
            event.preventDefault();
            _this= this;

            loading(_this ,1);

            var posting = $.post( '', $(this).serialize() );
            posting.done(function(e){
                e = $.parseJSON(e);
                if(e.success == '1'){
                    message = '<div class="proffixnewsletter-success">'+e.message+'</div>';
                    showSuccess(_this,message);
                }else{
                    $("fieldset.pxnewsletter-field span").remove();
                    $.each(e.message,function(field, error) {
                        $(element).find(".pxnewsletter-field-"+field).append('<span class="error">'+error+'</span>');
                    });

                }
                loading(_this,0);
            });
        });
    });
}

function showSuccess(element, message)
{
    var showon = $(element).parent().data('showon');
    $(element).find('.error').remove();

    switch(showon){
        case 'append':
            $(element).parent().append(message);
            return 0;
            break;

        case 'prepend':
            $(element).parent().prepend(message);
            return 0;
            break;

        case 'substitute':
        default:
            $(element).parent().html(message);
            return 0;
            break;
    }

}

function loading(element, method) {
    if (method == 0) {
        $(element).show();
        $(element).parent().find('.proffixnewsletter_spinner').hide();
        return 0;
    }

    $(element).hide();
    $(element).parent().find('.proffixnewsletter_spinner').show();
    return 0;
}