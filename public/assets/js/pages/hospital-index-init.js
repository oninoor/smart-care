$(document).ready(function () {
  $('#datatable').DataTable();

  $(".dataTables_length select").addClass('form-select form-select-sm');
});

//Inisialisasi konfirmasi hapus pada tombol delete Lab
$(document).ready(function () {
  $('#delete-hospital').on('click', function (e) {
    e.preventDefault();

    id = $(this).data('id');

    Swal.fire({
      title: "Are you sure?",
      text: "You wil delete hospital data!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#2ab57d",
      cancelButtonColor: "#fd625e",
      confirmButtonText: "Yes, delete!"
    }).then(function (result) {
      if (result.isConfirmed) {
        $("#delete-hospital-" + id).submit();
      }
    });
  });
});