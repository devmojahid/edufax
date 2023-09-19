(function( $ ){
    "use scrict";

    $(document).ready(function(){
        $('.tm-select-field').each(function(){
            $(this).select2();
        })
    })

    $('.tm-switch input').on('change', function(){
        var isHiddenField = $(this).parent().children('input[type="hidden"]');
        var thisClassName = $(this).attr('class').trim();
        console.log(isHiddenField, thisClassName)
  
        if($(this).is(':checked')){
            $(this).val('on')
            if(isHiddenField.length){
                isHiddenField.val('on')
            }
        }else{
            $(this).val('off')
            if(isHiddenField.length){
                isHiddenField.val('off')
            }
        }
    })

    $('.tm-select-field').each(function(){
        $(this).select2();
    })

    $('.tm-datepicker-input').datepicker()

    $('.tm-colorpicker-input').wpColorPicker({});

    $(document).on('click', '.tp-metabox-repeater-collapse', function(x){
        x.preventDefault();
        $(this).parent().find('.tp-metabox-repeater-item-wrapper').slideToggle();
    })

    $(document).ready(function(){
        $('.tp-metabox-repeater-row .tp-metabox-repeater-item-wrapper').slideUp('300');
    })
    
})( jQuery )