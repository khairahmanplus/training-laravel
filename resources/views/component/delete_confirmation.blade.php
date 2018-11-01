<div class="modal" id="delete-confirmation-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form class="p-0 m-0" action="" method="post">
            @csrf
            @method('delete')
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">{{ __('Are you sure you want to do this?') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="my-0">
                        {{ __('This action cannot be undone. This will permanently delete the data. Once you delete a data, there is no going back. Please be certain.') }}
                    </p>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-outline-danger btn-block">{{ __('I understand the consequences, delete this data') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
