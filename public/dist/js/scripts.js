
// Delete User
function deleteData(userId) {
	if (confirm('Are you sure you want to delete it?')) {
		document.getElementById('delete-form-' + userId).submit();
	}
}