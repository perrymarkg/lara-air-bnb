<template>
    <div class="property-search">
        <HotelDatePicker></HotelDatePicker>
        <GuestPicker></GuestPicker>
    </div>
</template>

<script>
    import HotelDatePicker from 'vue-hotel-datepicker';
    import GuestPicker from './GuestPickerComponent';
    export default {
        components: {
            HotelDatePicker,
            GuestPicker
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>