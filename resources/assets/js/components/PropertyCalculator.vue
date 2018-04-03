<template>
<div class="row property-calculator">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8 p-0">
                <HotelDatePicker></HotelDatePicker>
            </div>
            <div class="col-md-4 p-0">
                <guest-picker 
                v-bind:max="5"
                v-bind:elems="elems"
                v-bind:elname="'Guests'"
                ></guest-picker>
            </div>
        </div>
    </div>
    
    
</div>
</template>


<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import ItemPicker from '../vue-ui/ItemPicker'
export default {
    components: {
        HotelDatePicker,
        ItemPicker
    },
    props: {
        elems: {
            default: function() {return []},
            type: Array
        }
    },
    data: function() {
        return {

        }
    },
    mounted: function() {
    
    }
}
</script>