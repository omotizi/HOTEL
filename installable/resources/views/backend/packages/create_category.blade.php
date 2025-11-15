<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Add Package Category') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="ajaxForm" class="modal-form"
          action="{{ route('admin.packages_management.store_category', ['language' => request()->input('language')]) }}"
          method="post" enctype="multipart/form-data">
          @csrf

          @if($websiteInfo->theme_version == 'theme_three')
          {{-- featured image start --}}
          <div class="form-group">
            <label for="">{{ __('Featured Image*') }}</label>
            <br>
            <div class="thumb-preview" id="thumbPreview1">
              <img src="{{ asset('assets/img/noimage.jpg') }}" alt="...">
            </div>
            <br><br>

            <input type="hidden" id="fileInput1" name="featured_img">
            <button id="chooseImage1" class="choose-image btn btn-primary" type="button" data-multiple="false"
              data-toggle="modal" data-target="#lfmModal1">{{ __('Choose Image') }}</button>

            {{-- lfm modal --}}
            <div class="modal fade lfm-modal" id="lfmModal1" tabindex="-1" role="dialog"
              aria-labelledby="lfmModalTitle" aria-hidden="true">
              <i class="fas fa-times-circle"></i>

              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <iframe src="{{ url('laravel-filemanager') }}?serial=1"
                      style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- featured image end --}}
          @endif

          <div class="form-group">
            <label for="">{{ __('Category Name*') }}</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
            <p id="err_name" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">{{ __('Category Status*') }}</label>
            <select name="status" class="form-control">
              <option selected disabled>{{ __('Select a Status') }}</option>
              <option value="1">{{ __('Active') }}</option>
              <option value="0">{{ __('Deactive') }}</option>
            </select>
            <p id="err_status" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">{{ __('Category Serial Number*') }}</label>
            <input type="number" class="form-control ltr" name="serial_number"
              placeholder="Enter Category Serial Number">
            <p id="err_serial_number" class="mt-1 mb-0 text-danger em"></p>
            <p class="text-warning mt-2">
              <small>{{ __('The higher the serial number is, the later the category will be shown.') }}</small>
            </p>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          {{ __('Close') }}
        </button>
        <button id="submitBtn" type="button" class="btn btn-primary">
          {{ __('Save') }}
        </button>
      </div>
    </div>
  </div>
</div>
