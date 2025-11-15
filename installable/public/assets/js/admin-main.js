$(function ($) {
  "use strict";

  WebFont.load({
    google: { "families": ["Lato:300,400,700,900"] },
    custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: [mainURL + '/assets/css/fonts.min.css'] },
    active: function () {
      sessionStorage.fonts = true;
    }
  });

  /* ***************************************************
  ==========datatables start==========
  ******************************************************/
  $('#basic-datatables').DataTable();
  /* ***************************************************
  ==========datatables end==========
  ******************************************************/

  // sidebar search start
  $(".sidebar-search").on('input', function () {
    let term = $(this).val().toLowerCase();

    if (term.length > 0) {
      $(".sidebar ul li.nav-item").each(function (i) {
        let menuName = $(this).find("p").text().toLowerCase();
        let $mainMenu = $(this);

        // if any main menu is matched
        if (menuName.indexOf(term) > -1) {
          $mainMenu.removeClass('d-none');
          $mainMenu.addClass('d-block');
        } else {
          let matched = 0;
          let count = 0;
          // search sub-items of the current main menu (which is not matched)
          $mainMenu.find('span.sub-item').each(function (i) {
            // if any sub-item is matched of the current main menu, set the flag
            if ($(this).text().toLowerCase().indexOf(term) > -1) {
              count++;
              matched = 1;
            }
          });

          // if any sub-item is matched  of the current main menu (which is not matched)
          if (matched == 1) {
            $mainMenu.removeClass('d-none');
            $mainMenu.addClass('d-block');
          } else {
            $mainMenu.removeClass('d-block');
            $mainMenu.addClass('d-none');
          }
        }
      });
    } else {
      $(".sidebar ul li.nav-item").addClass('d-block');
    }
  });
  // sidebar search end

  /*****************************************************************
  ==========disabling default behave of form submits start==========
  *****************************************************************/
  $("#ajaxEditForm").attr('onsubmit', 'return false');
  $("#ajaxForm").attr('onsubmit', 'return false');
  /***************************************************************
  ==========disabling default behave of form submits end==========
  ***************************************************************/


  /******************************************************
  ==========bootstrap datepicker start==========
  ******************************************************/
  $('.datepicker').datepicker({
    autoclose: true
  });

  $('.timepicker').each(function () {
    let interval = $(this).data('interval') ? $(this).data('interval') : 60;
    let start = $(this).data('start') ? $(this).data('start') : 60;

    $(this).timepicker({
      timeFormat: 'h:mm p',
      interval: interval,
      startTime: start
    });
  });
  /*****************************************************
  ==========bootstrap datepicker end==========
  ******************************************************/


  /*****************************************************
  ==========fontawesome icon picker start==========
  ******************************************************/
  $('.icp-dd').iconpicker();
  /* ***************************************************
  ==========fontawesome icon picker end============
  ******************************************************/

  /*****************************************************
  ==========lfm image icon for summernote start=========
  ******************************************************/
  var ImageButton = function (context) {
    var ui = $.summernote.ui;
    var button = ui.button({
      contents: '<i class="far fa-images"></i>',
      tooltip: 'File Manager',
      click: function () {
        let id = context.$note[0].id;
        $('#lfmModalSummernote').find('iframe').attr('src', '');
        $('#lfmModalSummernote').find('iframe').attr('src', mainURL + '/laravel-filemanager?summernote=' + id);
        $('#lfmModalSummernote').modal('show');
      }
    });

    return button.render();
  }
  /*****************************************************
  ==========lfm image icon for summernote end=========
  ******************************************************/


  // summernote initialization start
  $(".summernote").each(function (i) {
    let textareaHeight;
    let $summernote = $(this);

    if ($(this).data('height')) {
      textareaHeight = $(this).data('height');
    } else {
      textareaHeight = 200;
    }


    $('.summernote').eq(i).summernote({
      height: textareaHeight,
      dialogsInBody: true,
      dialogsFade: false,
      inheritPlaceholder: true,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['height', ['height']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'image', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
      ],
      popover: {
        image: [
          ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
          ['float', ['floatLeft', 'floatRight', 'floatNone']],
          ['remove', ['removeMedia']]
        ],
        link: [
          ['link', ['linkDialogShow', 'unlink']]
        ],
        table: [
          ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
          ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
        ],
        air: [
          ['color', ['color']],
          ['font', ['bold', 'underline', 'clear']],
          ['para', ['ul', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture']]
        ]
      },
      callbacks: {
        onImageUpload: function (files) {
          $('.request-loader').addClass('show');

          let imgUploadURL = mainURL + '/admin/summernote/upload-image';

          let fd = new FormData();
          fd.append('image', files[0]);

          $.ajax({
            url: imgUploadURL,
            method: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function (data) {
              $summernote.summernote('insertImage', data);
              $('.request-loader').removeClass('show');
            }
          });
        },
        onMediaDelete: function (target) {
          let imgRemoveURL = mainURL + '/admin/summernote/remove-image';

          let imageInfo = target[0].src;
          let imageInfoArray = imageInfo.split('/');
          let imageName = imageInfoArray.pop();

          let fd = new FormData();
          fd.append('image', imageName);

          $.ajax({
            url: imgRemoveURL,
            method: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
              alert(response.data);
            }
          });
        }
      }
    });
  });


  $(document).on('click', ".note-video-btn", function () {
    let i = $(this).index();

    if ($(".summernote").eq(i).parents(".modal").length > 0) {
      setTimeout(() => {
        $("body").addClass('modal-open');
      }, 500);
    }
  });
  // summernote initialization end


  /*****************************************************
  ==========Bootstrap Notify start==========
  ******************************************************/
  function bootnotify(message, title, type) {
    var content = {};

    content.message = message;
    content.title = title;
    content.icon = 'fa fa-bell';

    $.notify(content, {
      type: type,
      placement: {
        from: 'top',
        align: 'right'
      },
      showProgressbar: true,
      time: 1000,
      allow_dismiss: true,
      delay: 4000
    });
  }
  /*****************************************************
  ==========Bootstrap Notify end==========
  ******************************************************/


  // select2 start
  $('.select2').select2();
  // select2 end


  /******************************************************
  ==========Form Submit with AJAX Request Start==========
  ******************************************************/
  $("#submitBtn").on('click', function (e) {
    $(e.target).attr('disabled', true);
    $(".request-loader").addClass("show");

    if ($(".iconpicker-component").length > 0) {
      $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
    }

    let ajaxForm = document.getElementById('ajaxForm');
    let fd = new FormData(ajaxForm);
    let url = $("#ajaxForm").attr('action');
    let method = $("#ajaxForm").attr('method');

    if ($("#ajaxForm .summernote").length > 0) {
      $("#ajaxForm .summernote").each(function (i) {
        let content = $(this).summernote('code');

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      });
    }

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        })

        if (data == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('err_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });

  $("#permissionBtn").on('click', function () {
    $("#permissionsForm").trigger("submit");
  });
  /******************************************************
  ==========Form Submit with AJAX Request End==========
  ******************************************************/


  /********************************************************************
  ==========Form Prepopulate After Clicking Edit Button Start=========
  ********************************************************************/
  $(".editBtn").on('click', function () {
    let datas = $(this).data();
    // console.log(datas)
    delete datas['toggle'];

    for (let x in datas) {
      if ($("#in_" + x).hasClass('summernote')) {
        $("#in_" + x).summernote('code', datas[x]);
      } else if ($("#in_" + x).data('role') == 'tagsinput') {
        if (datas[x].length > 0) {
          let arr = datas[x].split(" ");
          for (let i = 0; i < arr.length; i++) {
            $("#in_" + x).tagsinput('add', arr[i]);
          }
        } else {
          $("#in_" + x).tagsinput('removeAll');
        }
      } else if ($("input[name='" + x + "']").attr('type') == 'radio') {
        $("input[name='" + x + "']").each(function (i) {
          if ($(this).val() == datas[x]) {
            $(this).prop('checked', true);
          }
        });
      } else if ($("#in_" + x).hasClass('select2')) {
        $("#in_" + x).val(datas[x]);
        $("#in_" + x).trigger('change');
      } else {
        $("#in_" + x).val(datas[x]);
        $('.brand-img').attr('src', datas['brand_img']);
        $('.gallery-img').attr('src', datas['gallery_img']);
        $('.featured-img').attr('src', datas['featured_img']);
      }
    }


    // focus & blur colorpicker inputs
    setTimeout(() => {
      $(".jscolor").each(function () {
        $(this).focus();
        $(this).blur();
      });
    }, 300);
  });
  /******************************************************************
  ==========Form Prepopulate After Clicking Edit Button End==========
  ******************************************************************/


  /******************************************************************
  ==========Form Prepopulate After Clicking Location Button Start====
  ******************************************************************/
  $('.locationBtn').on('click', function () {
    let info = $(this).data();

    $('#package-id-location').val(info.id);
  });
  /******************************************************************
  ==========Form Prepopulate After Clicking Location Button End======
  ******************************************************************/


  /******************************************************************
  ==========Form Prepopulate After Clicking Plan Button Start========
  ******************************************************************/
  $('.planBtn').on('click', function () {
    let info = $(this).data();

    if (info.plan_type == 'daywise') {
      $('#addDaywisePlanModal').modal('show');
      $('#package-id-daywise-plan').val(info.id);
    } else if (info.plan_type == 'timewise') {
      $('#addTimewisePlanModal').modal('show');
      $('#package-id-timewise-plan').val(info.id);
    }
  });
  /******************************************************************
  ==========Form Prepopulate After Clicking Plan Button End==========
  ******************************************************************/


  /**************************************************************
  ==========Form Prepopulate After Clicking Mail Button Start====
  **************************************************************/
  $('.mailBtn').on('click', function () {
    let info = $(this).data();

    $('#mail-id').val(info.customer_email);
  });
  /**************************************************************
  ==========Form Prepopulate After Clicking Mail Button End======
  **************************************************************/


  /***********************************************************************
  ==========Form Submit with AJAX Request For Daywise Plan Start==========
  ***********************************************************************/
  $('#daywise-plan-submit-btn').on('click', function (e) {
    $(e.target).attr('disabled', true);
    $('.request-loader').addClass('show');

    let ajaxForm = document.getElementById('daywise-plan-ajax-form');
    let fd = new FormData(ajaxForm);
    let url = $('#daywise-plan-ajax-form').attr('action');
    let method = $('#daywise-plan-ajax-form').attr('method');

    if ($('#ajaxForm .summernote').length > 0) {
      $('#ajaxForm .summernote').each(function (i) {
        let content = $(this).summernote('code');

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      });
    }

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        })

        location.reload();
      },
      error: function (error) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('err_' + x).innerHTML = error.responseJSON.errors[x][0];
        }
      }
    });
  });
  /*********************************************************************
  ==========Form Submit with AJAX Request For Daywise Plan End==========
  *********************************************************************/


  /***********************************************************************
  ==========Form Submit with AJAX Request For Timewise Plan Start=========
  ***********************************************************************/
  $('#timewise-plan-submit-btn').on('click', function (e) {
    $(e.target).attr('disabled', true);
    $('.request-loader').addClass('show');

    let ajaxForm = document.getElementById('timewise-plan-ajax-form');
    let fd = new FormData(ajaxForm);
    let url = $('#timewise-plan-ajax-form').attr('action');
    let method = $('#timewise-plan-ajax-form').attr('method');

    if ($('#ajaxForm .summernote').length > 0) {
      $('#ajaxForm .summernote').each(function (i) {
        let content = $(this).summernote('code');

        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      });
    }

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        })

        location.reload();
      },
      error: function (error) {
        $(e.target).attr('disabled', false);
        $('.request-loader').removeClass('show');

        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('err_' + x).innerHTML = error.responseJSON.errors[x][0];
        }
      }
    });
  });
  /***********************************************************************
  ==========Form Submit with AJAX Request For Timewise Plan End===========
  ***********************************************************************/


  /******************************************************
  ==========Form Update with AJAX Request Start==========
  ******************************************************/
  $("#updateBtn").on('click', function (e) {
    $(".request-loader").addClass("show");

    if ($(".iconpicker-component").length > 0) {
      $("#inputIcon").val($(".iconpicker-component").find('i').attr('class'));
    }

    let ajaxEditForm = document.getElementById('ajaxEditForm');
    let fd = new FormData(ajaxEditForm);
    let url = $("#ajaxEditForm").attr('action');
    let method = $("#ajaxEditForm").attr('method');

    if ($("#ajaxEditForm .summernote").length > 0) {
      $("#ajaxEditForm .summernote").each(function (i) {
        let content = $(this).summernote('code');
        fd.delete($(this).attr('name'));
        fd.append($(this).attr('name'), content);
      })
    }

    $.ajax({
      url: url,
      method: method,
      data: fd,
      contentType: false,
      processData: false,
      success: function (data) {
        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);

        $('.em').each(function () {
          $(this).html('');
        })

        if (data == 'success') {
          location.reload();
        }
      },
      error: function (error) {
        $('.em').each(function () {
          $(this).html('');
        });

        for (let x in error.responseJSON.errors) {
          document.getElementById('editErr_' + x).innerHTML = error.responseJSON.errors[x][0];
        }

        $('.request-loader').removeClass('show');
        $(e.target).attr('disabled', false);
      }
    });
  });
  /******************************************************
  ==========Form Update with AJAX Request End==========
  ******************************************************/


  /******************************************************
  ==========Delete Using AJAX Request Start==========
  ******************************************************/
  $('.deleteBtn').on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, delete it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(this).parent(".deleteForm").trigger('submit');
      } else {
        swal.close();
        $(".request-loader").removeClass("show");
      }
    });
  });
  /******************************************************
  ==========Delete Using AJAX Request End==========
  ******************************************************/


  /*****************************************************
  ==========Close Ticket Using AJAX Request Start======
  ******************************************************/
  $('.close-ticket').on('click', function (e) {
    e.preventDefault();
    $(".request-loader").addClass("show");

    swal({
      title: 'Are you sure?',
      text: "You want to close this ticket",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, close it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        swal.close();
        $(".request-loader").removeClass("show");
      } else {
        swal.close();
        $(".request-loader").removeClass("show");
      }
    });
  });
  /******************************************************
  ==========Close Ticket Using AJAX Request End==========
  ******************************************************/


  /*****************************************************
  ==========Bulk Delete Using AJAX Request Start========
  ******************************************************/
  $(".bulk-check").on('change', function () {
    let val = $(this).data('val');
    let checked = $(this).prop('checked');

    // if selected checkbox is 'all' then check all the checkboxes
    if (val == 'all') {
      if (checked) {
        $(".bulk-check").each(function () {
          $(this).prop('checked', true);
        });
      } else {
        $(".bulk-check").each(function () {
          $(this).prop('checked', false);
        });
      }
    }


    // if any checkbox is checked then flag = 1, otherwise flag = 0
    let flag = 0;

    $(".bulk-check").each(function () {
      let status = $(this).prop('checked');

      if (status) {
        flag = 1;
      }
    });

    // if any checkbox is checked then show the delete button
    if (flag == 1) {
      $(".bulk-delete").addClass('d-inline-block');
      $(".bulk-delete").removeClass('d-none');
    } else {
      // if no checkbox is checked then hide the delete button
      $(".bulk-delete").removeClass('d-inline-block');
      $(".bulk-delete").addClass('d-none');
    }
  });

  $('.bulk-delete').on('click', function () {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this",
      type: 'warning',
      buttons: {
        confirm: {
          text: 'Yes, delete it',
          className: 'btn btn-success'
        },
        cancel: {
          visible: true,
          className: 'btn btn-danger'
        }
      }
    }).then((Delete) => {
      if (Delete) {
        $(".request-loader").addClass('show');
        let href = $(this).data('href');
        let ids = [];

        // take ids of checked one's
        $(".bulk-check:checked").each(function () {
          if ($(this).data('val') != 'all') {
            ids.push($(this).data('val'));
          }
        });

        let fd = new FormData();
        for (let i = 0; i < ids.length; i++) {
          fd.append('ids[]', ids[i]);
        }

        $.ajax({
          url: href,
          method: 'POST',
          data: fd,
          contentType: false,
          processData: false,
          success: function (data) {
            $(".request-loader").removeClass('show');
            if (data == "success") {
              location.reload();
            }
          }
        });
      } else {
        swal.close();
      }
    });
  });
  /*****************************************************
  ==========Bulk Delete Using AJAX Request End==========
  *****************************************************/


  // LFM scripts START
  window.lfmSliders = [];

  window.closeLfmModal = function (serial) {
    $('#lfmModal' + serial).modal('hide');
    // if any modal is open, then add 'modal-open' class to body
    if ($(".modal.show").length > 0) {
      setTimeout(function () {
        $('body').addClass('modal-open');
      }, 500);
    }
  };

  window.closeLfmModalSummernote = function () {
    $('#lfmModalSummernote').modal('hide');
    // if any modal is open, then add 'modal-open' class to body
    setTimeout(function () {
      if ($(".modal.show").length > 0) {
        $('body').addClass('modal-open');
      }
    }, 500);
  };

  $(`.lfm-modal .fas.fa-times-circle`).on('click', function () {
    $(this).parents('.lfm-modal').modal('hide');
    // if any modal is open, then add 'modal-open' class to body
    setTimeout(function () {
      if ($(".modal.show", parent.document).length > 0) {
        $('body', parent.document).addClass('modal-open');
      }
    }, 500);
  });

  $(`.lfm-modal`).on('click', function (e) {
    if (!$(e.target).hasClass('modal-dialog') && !$(e.target).parents('.modal-dialog').length) {
      // if any modal is open, then add 'modal-open' class to body
      setTimeout(function () {
        if ($(".modal.show", parent.document).length > 0) {
          $('body', parent.document).addClass('modal-open');
        }
      }, 500);
    }
  });

  window.insertImage = function (id, items) {
    items.forEach(function (item) {
      $("#" + id).summernote('insertImage', item);
    });
  };

  $(document).on('click', ".rmvLfmSliderImgs", function () {
    let index = $(this).data('index');
    let serial = $(this).data('serial');

    window.lfmSliders.splice(index, 1);
    window.prevLfmSliderImgs(serial);
  });


  window.prevLfmSliderImgs = function (serial) {
    let imagesDiv = ``;
    let sliderValues = [];

    if (window.lfmSliders.length > 0) {
      window.lfmSliders.forEach(function (slider, index) {

        imagesDiv += `<div class="thumb-preview mr-2 mb-2">
                <i class="fas fa-times-circle rmvLfmSliderImgs" data-index="${index}" data-serial="${serial}"></i>
                <img src="${slider}" alt="Slider Image">
            </div>`;

        sliderValues.push(slider.replace(mainURL + '/', ""));

      });
    }

    $("#sliderThumbs" + serial).html(imagesDiv);

    $("#fileInput" + serial).val(sliderValues);
  };
  // LFM scripts END


  // Uploaded Image Preview Start
  $('.img-input').on('change', function (event) {
    let file = event.target.files[0];
    let reader = new FileReader();

    reader.onload = function (e) {
      $('.uploaded-img').attr('src', e.target.result);
    };

    reader.readAsDataURL(file);
  });
  // Uploaded Image Preview End
});
