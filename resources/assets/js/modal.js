module.exports = function(){
    
    var $modal = $('#promptDeleteModal');
    var $form = $modal.find('form');
    var $title = $modal.find('.modal-title');
    var $name = $modal.find('.modal-body span');

    function init() {
        $('a.prompt-delete').on('click', function(e){
            e.preventDefault();
            showModal(this);
        });
    
        $modal.find('.proceed').on('click', function(){
            $form.submit();
        });
    }

    function showModal(el){
        $modal.modal('show');
        $form.attr('action', $(el).attr('href') );
        $title.html('Delete ' + $(el).data('type') );
        $name.html( '"' + $(el).data('name') + '"');
    }

    return {
        init: init
    }
}()

