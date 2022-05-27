@if (session('status'))
    <div class="row mt-2">

        <div class="col-sm-12">
            <div class="alert alert-primary fade show" role="alert">
                <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
                <div class="alert-text"><span>{{session('status')}}</span></div>
                <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
