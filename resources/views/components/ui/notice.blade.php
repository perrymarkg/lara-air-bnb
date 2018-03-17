<?php
    $content = isset( $content ) ? $content : session('notice'); 
?>

@if( $content  )

<div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-3">
                {{ $content }}
            </div>
        </div>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif