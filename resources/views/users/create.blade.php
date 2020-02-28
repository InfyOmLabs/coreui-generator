@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('users.index') !!}">User</a>
        </li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                            <strong>Create User</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'users.store','files'=>true]) !!}

                            @include('users.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
      $('#roleId').select2({
        width: '100%',
        placeholder: "Select Role"
      });
      $(function () {

        $(document).on('change', '#userImage', function () {
          let ext = $(this).val().split('.').pop().toLowerCase()
          if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $(this).val('')
            $('#editProfileValidationErrorsBox').
              html('The profile image must be a file of type: jpeg, jpg, png.').
              show()
          } else {
            displayPhoto(this, '#edit_preview')
          }
        })

        window.displayPhoto = function (input, selector) {
          let displayPreview = true
          if (input.files && input.files[0]) {
            let reader = new FileReader()
            reader.onload = function (e) {
              let image = new Image()
              image.src = e.target.result
              image.onload = function () {
                $(selector).attr('src', e.target.result)
                displayPreview = true
              }
            }
            if (displayPreview) {
              reader.readAsDataURL(input.files[0])
              $(selector).show()
            }
          }
        }

        $('.confirm-pwd').hide()
        $(document).on('blur', '#pfCurrentPassword', function () {
          let currentPassword = $('#pfCurrentPassword').val()
          if (currentPassword == '' || currentPassword.trim() == '') {
            $('.confirm-pwd').hide()
            return false
          }

          $('.confirm-pwd').show()
        })
        $('.confirm-pwd').hide()
        $(document).on('blur', '#pfNewPassword', function () {
          let password = $('#pfNewPassword').val()
          if (password == '' || password.trim() == '') {
            $('.confirm-pwd').hide()
            return false
          }

          $('.confirm-pwd').show()
        })
        $(document).on('blur', '#pfNewConfirmPassword', function () {
          let confirmPassword = $('#pfNewConfirmPassword').val()
          if (confirmPassword == '' || confirmPassword.trim() == '') {
            $('.confirm-pwd').hide()
            return false
          }

          $('.confirm-pwd').show()
        })
      })
    </script>
@endsection