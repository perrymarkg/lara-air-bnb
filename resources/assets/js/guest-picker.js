module.exports = function(){
    
    var $input = $('#guests');
    var $clone = $input.clone()
            .removeAttr('id')
            .removeAttr('name')
            .attr('readonly', true)
            .addClass('guest-picker-input');

    var tmpInputVal = $input.val();

    var $dropdown, $adultAdd, $adultMinus, $adultInput, $childAdd, $childMinus, $childInput;

    function init() {

        $clone.appendTo( $input.parent() );
        $input.val( JSON.stringify({'adult':1, 'child':0, 'total': 1}) ).attr('type', 'hidden');

        hideDropDown();
        setupGuestPickerTemplate();
        
        $clone.on('click', function (){            
            $dropdown.css({
                top: $(this).offset().top + $(this).outerHeight() + 3,
                left: $(this).offset().left
            }).show();
        });
    
        $adultAdd.on('click', function (e){
            e.preventDefault();
            $adultInput.val( parseInt($adultInput.val()) + 1 );
            $adultMinus.removeAttr('disabled');
            computeGuests();
        })
    
        $adultMinus.on('click', function(e){
            e.preventDefault();
            val = parseInt($adultInput.val()) - 1;
            min = $adultInput.attr('min');
            
            if( val >= min ){
                $adultInput.val( parseInt($adultInput.val()) - 1 );
            } else {
                $(this).attr('disabled', true);
            }
            computeGuests();
        })
    
        $childAdd.on('click', function (e){
            e.preventDefault();
            $childInput.val( parseInt($childInput.val()) + 1 );
            $childMinus.removeAttr('disabled');
            computeGuests();
        })
    
        $childMinus.on('click', function(e){
            e.preventDefault();
            val = parseInt($childInput.val()) - 1;
            min = $childInput.attr('min');
            
            if( val >= min ){
                $childInput.val( parseInt($childInput.val()) - 1 );
            } else {
                $(this).attr('disabled', true);
            }
            computeGuests();
        })
    }
    
    function setupGuestPickerTemplate() {
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
        $adultAdd = $('.adult-add');
        $adultMinus = $('.adult-minus');
        $adultInput = $('.adult-input');

        $childAdd = $('.child-add');
        $childMinus = $('.child-minus');
        $childInput = $('.child-input');
    }
    
    
    function hideDropDown(){
        $(document).mouseup(function(e){
            $target = $(e.target);
            if( $target.attr('class') != $dropdown.attr('class') && 
            !$dropdown.has($target).length && $dropdown.is(':visible') ){
                
                $dropdown.hide();
                
                if( $input.val() != tmpInputVal ){
                    $input.change();     
                }
                
            }
        });
    }
    
    function computeGuests(){
        total = parseInt($adultInput.val()) + parseInt($childInput.val());
        $clone.val(total + ' Guests');
        values = {'adult': $adultInput.val(), 'child': $childInput.val(), 'total': total};
        $input.val(JSON.stringify(values));
    }

    return {
        init: init
    }

}()
