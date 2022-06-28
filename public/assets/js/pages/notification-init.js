// Notification Init
const pesan = $('#pesan').data('pesan');
if (pesan) {
  const arr = pesan.split("|");
  if (arr[1] == 'success') {
    alertify.success(arr[0]);
  } else if (arr[1] == 'error') {
    alertify.error(arr[0]);
  }
}