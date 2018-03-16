module.exports = function(el = '#guests'){
    
    $input = $(el);
    $clone = $input.clone().removeAttr('id').addClass('guest-picker-input');

    $clone.appendTo( $input.parent() );
    $input.hide();

    $('body').append('<div class="guest-picker border rounded p-2">\
    <div class="row mb-3"> \
        <div class="col-md-6">Adults</div>\
        <div class="col-md-2 text-center"><button class="adult-minus btn btn-sm btn-primary" disabled>-</button></div> \
        <div class="col-md-2 text-center p-0"> \
            <input type="number" value="1" min="1" class="adult-input border-0 p-0 text-center" readonly/> \
        </div> \
        <div class="col-md-2 text-center"><button class="adult-add btn btn-sm btn-primary">+</button></div> \
    </div> \
    <div class="row"> \
        <div class="col-md-6">Children</div>\
        <div class="col-md-2 text-center"><button class="child-minus btn btn-sm btn-primary" disabled>-</button></div> \
        <div class="col-md-2 text-center p-0"> \
            <input type="number" value="0" min="0" class="child-input border-0 p-0 text-center" readonly/> \
        </div> \
        <div class="col-md-2 text-center"><button class="child-add btn btn-sm btn-primary">+</button></div> \
    </div> \
    </div>');

    $dropdown = $('.guest-picker');

    $adult_add = $('.adult-add');
    $adult_minus = $('.adult-minus');
    $adult_input = $('.adult-input');

    $child_add = $('.child-add');
    $child_minus = $('.child-minus');
    $child_input = $('.child-input');

    $clone.on('click', function (){
        $dropdown.css({
            top: $(this).offset().top + $(this).outerHeight(),
            left: $(this).offset().left
        }).show();
    });

    $adult_add.on('click', function (e){
        e.preventDefault();
        $adult_input.val( parseInt($adult_input.val()) + 1 );
        $adult_minus.removeAttr('disabled');
    })

    $adult_minus.on('click', function(e){
        e.preventDefault();
        val = parseInt($adult_input.val()) - 1;
        min = $adult_input.attr('min');
        
        if( val >= min ){
            $adult_input.val( parseInt($adult_input.val()) - 1 );
        } else {
            $(this).attr('disabled', true);
        }
            
    })

    $child_add.on('click', function (e){
        e.preventDefault();
        $child_input.val( parseInt($child_input.val()) + 1 );
        $child_minus.removeAttr('disabled');
    })

    $child_minus.on('click', function(e){
        e.preventDefault();
        val = parseInt($child_input.val()) - 1;
        min = $child_input.attr('min');
        
        if( val >= min ){
            $child_input.val( parseInt($child_input.val()) - 1 );
        } else {
            $(this).attr('disabled', true);
        }
            
    })


    
    /* $(el).clone().removeAttr('id').addClass('guest-picker-input').appendTo($(el).parent());
    $(el).hide();
    
    $picker = $('.guest-picker');

    $(el).on('click', function(){
        $(this).val('Changed');
        $picker.css({            
            top: $(this).offset().top + $(this).outerHeight(), 
            left: $(this).offset().left
        })
        .show();
    }); */

    
    
}