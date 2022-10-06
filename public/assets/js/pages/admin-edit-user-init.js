// Preview Image Edit Admin
function previewImgLab(id) {
  const lab_result = document.querySelector('#user_image');
  const imgPreview = document.querySelector('.img-preview');

  const file_lab_image = new FileReader();
  file_lab_image.readAsDataURL(lab_result.files[0]);

  file_lab_image.onload = function (e) {
    imgPreview.src = e.target.result;
  }
}


$(document).on('change', '#active', function (e) {
  href = $(this).data('href');
  id = $(this).data('id');

  $.ajax({
    url: href,
    type: 'post',
    data: { id: id },
    success: function (data) {
      if (data.status == 'success') {
        alertify.success(data.message);
      } else if (data.status == 'failed') {
        alertify.error(data.message);
      }
    }
  })
})

$(document).on('change', '#role', function (e) {
  href = $(this).data('href');
  id = $(this).data('id');
  value = $(this).val();

  $.ajax({
    url: href,
    type: 'post',
    data: { id: id, value: value },
    success: function (data) {
      if (data.status == 'success') {
        alertify.success(data.message);
      } else if (data.status == 'failed') {
        alertify.error(data.message);
      }
    }
  })
})

$(document).ready(function () {
  $('#btn-delete-user').on('click', function (e) {
    e.preventDefault();

    id = $(this).data('id');

    Swal.fire({
      title: "Are you sure?",
      text: "You wil delete this user data!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#2ab57d",
      cancelButtonColor: "#fd625e",
      confirmButtonText: "Yes, delete!"
    }).then(function (result) {
      if (result.isConfirmed) {
        $("#form-delete-user").submit();
      }
    });
  });
});