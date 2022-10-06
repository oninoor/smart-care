$(document).ready(function () {
  $('#datatable').DataTable();

  $(".dataTables_length select").addClass('form-select form-select-sm');
});

$(document).on('click', '#delete-user', function (e) {
  e.preventDefault();
  const id = $(this).data('id');
  Swal.fire({
    title: "Anda yakin?",
    text: "Anda akan menghapus permintaan data user!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#2ab57d",
    cancelButtonColor: "#fd625e",
    confirmButtonText: "Ya, hapus!"
  }).then(function (result) {
    if (result.isConfirmed) {
      $("#delete-user-" + id).submit();
    }
  });
})