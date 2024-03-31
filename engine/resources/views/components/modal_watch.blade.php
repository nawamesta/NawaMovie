<div id="pop-login" class="modal fade modal-cuz " data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body mopie-modal-content p-0 border" style="background-image: url('{{ img_backdrop($backdrop) }}'); padding-top: 5rem;">
                <div class="align-items-center d-flex flex-column justify-content-center position-relative p-3 pt-5 text-center" style="position: relative;">
                    <div class="ex-icon">
                        <i class="fa fa-exclamation fa-4x text-dark" aria-hidden="true"></i>
                    </div>
                    <div class="h3 font-bold mt-3 text-white">{{ __('modal.active_your_account_free') }}</div>
                    <p class="text-white">{{ __('modal.you_must_create') }}</p>
                    <a href="{{ route('loading', ['id' => $id ,'title' => $title]) }}" class="btn btn-lg bg-theme bg-hover-theme mb-4 text-white">{{ __('modal.continue_watch') }}</a>
                </div>
            </div>
            <div class="modal-footer align-items-center d-flex flex-column justify-content-center text-center text-dark">
                <p class="text-large mb-1 text-white"><i class="fa fa-clock-o mr-1" aria-hidden="true" style="margin-right: .5rem"></i><span class="text-large font-bold" style="font-weight: 700">{{ __('modal.quick_sign_up') }}</span></p>
                <p class="small text-white">{{ __('modal.take_less_then') }}</p>
            </div>
        </div>
    </div>
</div>