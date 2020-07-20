function ConfirmDelete(nexturl){
	var result = confirm("Are you sure you want to delete this data?");
	if (result) {
		window.location = nexturl;
	}else{
		return false;
	}
};
function ConfirmReset(nexturl){
	var result = confirm("Are you sure you want to reset this data?");
	if (result) {
		window.location = nexturl;
	}else{
		return false;
	}
};
function ConfirmApproval(nexturl){
	var result = confirm("Apakah anda setuju untuk melanjutkan ke process Approval?");
	if (result) {
		window.location = nexturl;
	}else{
		return false;
	}
};