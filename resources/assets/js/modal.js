(function($){
    $(document).ready(function(){
        $('a.prompt-delete').click( function(e){
            e.preventDefault();

            $id = '#promptDeleteModal'
            $el = $(this);
            $modal = $($id);
            $modalForm = $modal.find('form');
            $title = $modal.find('.title');
            $name = $modal.find('.modal-body span');
            
            $modal.modal('show');
            $modalForm.attr('action', $el.attr('href'));
            $title.html('Delete ' + $el.data('type') );
            $name.html( $el.data('name') );
            
        })

        $('#promptDeleteModal .proceed').click(function($e){
            $('#promptDeleteForm').submit();
        });
    })
})(jQuery)