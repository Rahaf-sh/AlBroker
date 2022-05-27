"use strict";

// Class definition
var KTUserEdit = function () {
	// Base elements
	var avatar;
	var document;

	var initUserForm = function() {
		avatar = new KTAvatar('kt_user_edit_avatar');
        document = new KTAvatar('kt_user_edit_document');
	}

    return {
		// public functions
		init: function() {
			initUserForm();
		}
	};
}();

jQuery(document).ready(function() {
	KTUserEdit.init();
});
