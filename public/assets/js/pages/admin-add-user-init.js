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