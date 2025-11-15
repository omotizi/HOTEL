@extends('backend.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">{{ __('Home Page Version') }}</h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{ route('admin.dashboard') }}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{ __('Home Page Version') }}</a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title">{{ __('Home Settings') }}</div>
            </div>
          </div>
        </div>

        <div class="card-body pt-5 pb-5">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <form id="ajaxForm" action="{{ route('admin.theme.update_version') }}" method="post">
                @csrf
                <div class="form-group">
                  <label class="form-label">Theme *</label>
                  <div class="row">
                    <div class="col-6 col-sm-4">
                      <label class="imagecheck mb-4">
                        <input name="theme_version" type="radio" value="multipurpose" class="imagecheck-input"
                          {{ $data->theme_version == 'multipurpose' ? 'checked' : '' }}>
                        <figure class="imagecheck-figure">
                          <img src="{{ asset('assets/img/themes/1.png') }}" alt="title" class="imagecheck-image">
                        </figure>
                      </label>
                    </div>

                    <div class="col-6 col-sm-4">
                      <label class="imagecheck mb-4">
                        <input name="theme_version" type="radio" value="multipurpose_two" class="imagecheck-input"
                          {{ $data->theme_version == 'multipurpose_two' ? 'checked' : '' }}>
                        <figure class="imagecheck-figure">
                          <img src="{{ asset('assets/img/themes/2.png') }}" alt="title" class="imagecheck-image">
                        </figure>
                      </label>
                    </div>
                    <div class="col-6 col-sm-4">
                      <label class="imagecheck mb-4">
                        <input name="theme_version" type="radio" value="theme_three" class="imagecheck-input"
                          {{ $data->theme_version == 'theme_three' ? 'checked' : '' }}>
                        <figure class="imagecheck-figure">
                          <img src="{{ asset('assets/img/themes/3.png') }}" alt="title" class="imagecheck-image">
                        </figure>
                      </label>
                    </div>
                     <div class="col-6 col-sm-4">
                      <label class="imagecheck mb-4">
                        <input name="theme_version" type="radio" value="theme_four" class="imagecheck-input"
                          {{ $data->theme_version == 'theme_four' ? 'checked' : '' }}>
                        <figure class="imagecheck-figure">
                          <img src="{{ asset('assets/img/themes/4.png') }}" alt="title" class="imagecheck-image">
                        </figure>
                      </label>
                    </div>
                      <div class="col-6 col-sm-4">
                      <label class="imagecheck mb-4">
                        <input name="theme_version" type="radio" value="theme_five" class="imagecheck-input"
                          {{ $data->theme_version == 'theme_five' ? 'checked' : '' }}>
                        <figure class="imagecheck-figure">
                          <img src="{{ asset('assets/img/themes/5.png') }}" alt="title" class="imagecheck-image">
                        </figure>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group Home_version">
                  <label>Home *</label>
                  <select name="home_version" class="form-control">
                    <option value="static" {{ $data->home_version == 'static' ? 'selected' : '' }}>
                      Static
                    </option>
                    <option value="slider" {{ $data->home_version == 'slider' ? 'selected' : '' }}>
                      Slider
                    </option>
                    <option value="video" {{ $data->home_version == 'video' ? 'selected' : '' }}>
                      Video
                    </option>
                    <option value="particles" {{ $data->home_version == 'particles' ? 'selected' : '' }}>
                      Particles
                    </option>
                    <option value="water" {{ $data->home_version == 'water' ? 'selected' : '' }}>
                      Water
                    </option>
                    <option value="parallax" {{ $data->home_version == 'parallax' ? 'selected' : '' }}>
                      Parallax
                    </option>
                  </select>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" id="submitBtn" class="btn btn-success">
                {{ __('Update') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
    $(document).ready(function() {



      function themeExtrafeature() {
        const selectedTheme = $('input[name="theme_version"]:checked').val();
        console.log(selectedTheme)
        if (selectedTheme == "multipurpose") {
          $('.Home_version').css({
            'display': 'block'
          });
        } else if (selectedTheme == "multipurpose_two") {
          $('.Home_version').css({
            'display': 'block'
          });
        } else {
          $('.Home_version').css({
            'display': 'none'
          });
          console.log('else')
        }
      }


      themeExtrafeature();

      $(".imagecheck").on("change", function() {
        themeExtrafeature();
      });



    });
  </script>
@endsection
