    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>    
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMaps&libraries=places" async defer></script>
</body>
</html>
