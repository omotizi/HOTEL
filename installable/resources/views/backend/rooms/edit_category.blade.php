<div
  class="modal fade"
  id="editModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Update Room Category') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form
          id="ajaxEditForm"
          class="modal-form"
          action="{{ route('admin.rooms_management.update_category') }}"
          method="post" enctype="multipart/form-data"
        >
          @csrf
          <input type="hidden" name="category_id" id="in_id">

           @if($websiteInfo->theme_version == 'theme_five')
            {{-- featured image start --}}
          <div class="form-group">
            <div class="thumb-preview" id="thumbPreview2">
              <img src="" alt="category image" class="featured-img" width="100">
            </div>
            <br><br>

            <input type="hidden" id="fileInput2" name="image">
            <button
              id="chooseImage2"
              class="choose-image btn btn-primary"
              type="button" data-multiple="false"
              data-toggle="modal"
              data-target="#lfmModal2"
            >{{ __('Choose Image') }}</button>
            <div class="modal fade lfm-modal" id="lfmModal2" tabindex="-1" role="dialog" aria-labelledby="lfmModalTitle" aria-hidden="true">
                <i class="fas fa-times-circle"></i>

                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <iframe
                            src="{{ url('laravel-filemanager') }}?serial=2"
                            style="width: 100%; height: 500px; overflow: hidden; border: none;"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <p id="editErr_image" class="mt-2 mb-0 text-danger em"></p>
          </div>
          {{-- featured image end --}}
          @endif


          <div class="form-group">
            <label for="">{{ __('Category Name*') }}</label>
            <input
              type="text"
              id="in_name"
              class="form-control"
              name="name"
              placeholder="Enter Category Name"
            >
            <p id="editErr_name" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">{{ __('Category Status*') }}</label>
            <select name="status" id="in_status" class="form-control">
              <option disabled>{{ __('Select a Status') }}</option>
              <option value="1">{{ __('Active') }}</option>
              <option value="0">{{ __('Deactive') }}</option>
            </select>
            <p id="editErr_status" class="mt-1 mb-0 text-danger em"></p>
          </div>

          <div class="form-group">
            <label for="">{{ __('Category Serial Number*') }}</label>
            <input
              type="number"
              id="in_serial_number"
              class="form-control ltr"
              name="serial_number"
              placeholder="Enter Category Serial Number"
            >
            <p id="editErr_serial_number" class="mt-1 mb-0 text-danger em"></p>
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
        <button id="updateBtn" type="button" class="btn btn-primary">
          {{ __('Update') }}
        </button>
      </div>
    </div>
  </div>
</div>
