module.exports = function(el = '#guests'){
    
    $input = $(el);
    $clone = $input.clone().removeAttr('id').attr('readonly', true).addClass('guest-picker-input');

    $clone.appendTo( $input.parent() );
    $input.attr('type', 'hidden');

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
            top: $(this).offset().top + $(this).outerHeight() + 3,
            left: $(this).offset().left
        }).show();
    });

    $adult_add.on('click', function (e){
        e.preventDefault();
        $adult_input.val( parseInt($adult_input.val()) + 1 );
        $adult_minus.removeAttr('disabled');
        compute_guests();
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
        compute_guests();
    })

    $child_add.on('click', function (e){
        e.preventDefault();
        $child_input.val( parseInt($child_input.val()) + 1 );
        $child_minus.removeAttr('disabled');
        compute_guests();
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
        compute_guests();
    })
    
    // Hide dropdown
    $(document).mouseup(function(e){
        $target = $(e.target);
        if( $target.attr('class') != $dropdown.attr('class') && !$dropdown.has($target).length ){
            $dropdown.hide();
        }
    });

    const compute_guests = function(){
        total = parseInt($adult_input.val()) + parseInt($child_input.val());
        $clone.val(total + ' Guests');
        $input.val(total);
        $input.change();
    }

}
