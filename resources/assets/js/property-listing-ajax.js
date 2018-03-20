module.exports = function () {

    var $body = $('body');
    var $properties = $('.property-listing');
    var $paginationLink;
    var callback;


    function init(){
        getProperties( getUrlParameter('page') );
        onPaginate();
    }

    function onPaginate() {
        $body.on('click', '.page-link', function(e){
            e.preventDefault();
            var $el = $(this)
            var url = $el.attr('href');

            window.history.pushState("", "", url );
            getProperties( getUrlParameter('page') );
        })
    }

    function getProperties(page = 1) {
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

    // https://davidwalsh.name/query-string-javascript
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    

    return {
        init: init,
        onRender: onRender
    }
    
}()