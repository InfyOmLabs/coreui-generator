$('#editProfileForm').submit(function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#btnPrEditSave')
    loadingButton.button('loading')
    $.ajax({
        url: usersUrl + 'profile-update',
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#EditProfileModal').modal('hide')
                location.reload()
            }
        },
        error: function (result) {
            manageAjaxErrors(result, 'editProfileValidationErrorsBox')
        },
        complete: function () {
            loadingButton.button('reset')
        },
    })
})

$('#changePasswordForm').submit(function (event) {
    event.preventDefault()
    isValidate = validatePassword()
    if (!isValidate) {
        return false
    }
    let loadingButton = jQuery(this).find('#btnPrPasswordEditSave')
    loadingButton.button('loading')
    $.ajax({
        url: usersUrl + 'change-password',
        type: 'post',
        data: new FormData($(this)[0]),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#ChangePasswordModal').modal('hide')
                location.reload()
            }
        },
        error: function (result) {
            manageAjaxErrors(result, 'editPasswordValidationErrorsBox')
        },
        complete: function () {
            loadingButton.button('reset')
        },
    })
})

$('#EditProfileModal').on('hidden.bs.modal', function () {
    resetModalForm('#editProfileForm', '#editProfileValidationErrorsBox')
})

$('#ChangePasswordModal').on('hidden.bs.modal', function () {
    resetModalForm('#changePasswordForm', '#editPasswordValidationErrorsBox')
})

// open edit user profile model
$(document).on('click', '.edit-profile', function (event) {
    let userId = $(event.currentTarget).data('id')
    renderProfileData(usersUrl + userId + '/edit')
})
$(document).on('change', '#pfImage', function () {
    let ext = $(this).val().split('.').pop().toLowerCase()
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(this).val('')
        $('#editProfileValidationErrorsBox').
            html('The profile image must be a file of type: jpeg, jpg, png.').
            show()
    } else {
        displayPhoto(this, '#edit_preview_photo')
    }
})

window.renderProfileData = function (usersUrl) {
    $.ajax({
        url: usersUrl,
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let user = result.data
                $('#pfUserId').val(user.id)
                $('#pfName').val(user.name)
                $('#pfEmail').val(user.email)
                $('#pfPhone').val(user.phone)
                $('#edit_preview_photo').attr('src', user.image_path)
                $('#EditProfileModal').modal('show')
            }
        },
    })
}
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

$(document).on('keyup', '#name', function (e) {
    let txtVal = $(this).val().trim()
    if ((e.charCode === 8 || (e.charCode >= 65 && e.charCode <= 90) ||
        (e.charCode >= 95 && e.charCode <= 122)) ||
        (e.charCode === 0 || (e.charCode >= 48 && e.charCode <= 57))) {
        if (txtVal.length <= 4) {
            $('#prefix').val(txtVal.toLocaleUpperCase())
        }
    }
})

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

function validatePassword () {
    let currentPassword = $('#pfCurrentPassword').val().trim()
    let password = $('#pfNewPassword').val().trim()
    let confirmPassword = $('#pfNewConfirmPassword').val().trim()

    if (currentPassword == '' || password == '' || confirmPassword == '') {
        $('#editPasswordValidationErrorsBox').
            show().
            html('Please fill all the required fields.')
        return false
    }
    return true
}

$('.changeType').click(function () {
    let inputField = $(this).parent().siblings()
    let oldType = inputField.attr('type')
    if (oldType == 'password') {
        $(this).children().addClass('icon-eye')
        $(this).children().removeClass('icon-ban')
        inputField.attr('type', 'text')
    } else {
        $(this).children().removeClass('icon-eye')
        $(this).children().addClass('icon-ban')
        inputField.attr('type', 'password')
    }
})
$('#ChangePasswordModal').on('shown.bs.modal', function () {
  $('#pfCurrentPassword').focus()
});
$('#EditProfileModal').on('shown.bs.modal', function () {
  $('#pfName').focus()
});
