queryString = require('query-string');
module.exports = function () {

    var $body = $('body');
    var $properties = $('.property-listing');
    var callback = function(data, icons){};
    var ajaxUrl = '/p';
    var Turl;

    function init(){
        getProperties();
        onPaginate();
    }

    function onPaginate() {
        $body.on('click', '.page-link', function(e){
            e.preventDefault();
            var $el = $(this)
            var url = $el.attr('href');

            window.history.pushState("", "", url );
            getProperties();
        })
    }

    function buildUrl() {
        var q = queryString.parseUrl(location.search);
        console.log(q);
    }

    function getProperties(page = 1) {
        buildUrl();
        
        axios.get('/p?page=' + page).then(function(result) {
            $properties.html(result.data.html);
            
            renderCompleted( result.data.markers, result.data.marker_icons );
        });
    }

    function onRender( _callback ){
        callback = _callback ? _callback : '';
    }

    function renderCompleted( data, icons ) {
        callback( data, icons );
    }

    function propertySearch(checkIn, checkOut, guests, location) {
        var url = '/p?page=1&check_in=' + encodeURI(checkIn) + 
        '&check_out=' + encodeURI(checkOut) +
        '&guests=' + encodeURI(guests) +
        '&location=' + encodeURI(location);

        axios.get( url ).then(function(result) {
            $properties.html(result.data.html);
            
            renderCompleted( result.data.markers, result.data.marker_icons );
        });
    }

    // https://davidwalsh.name/query-string-javascript
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    

    return {
        init: init,
        onRender: onRender,
        propertySearch: propertySearch
    }
    
}()