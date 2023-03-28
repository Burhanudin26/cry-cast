// Description: This file contains the javascript code for the login page
// login validation function for the login page
$(document).ready(function () {
	//email validation
	$("#name_or_email").keyup(function () {
		let email = $("#name_or_email").val();
		if (email.length > 6 && email.includes("@") && email.includes(".")) {
			$("#name_or_email").removeClass("is-invalid");
			$("#name_or_email").addClass("is-valid");
			$("#name_or_email").next().next().text("");
		} else {
			$("#name_or_email").removeClass("is-valid");
			$("#name_or_email").addClass("is-invalid");
			$("#name_or_email").next().next().text("email must be valid email");
		}
	});

	//password validation must greater than 6 and use regex to check if password contain number and string
	$("#password").keyup(function () {
		let password = $("#password").val();
		let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
		if (password.length > 6 && regex.test(password)) {
			$("#password").removeClass("is-invalid");
			$("#password").addClass("is-valid");
			$("#password").next().next().text("");
			$("#error-message").show();
		} else {
			$("#password").removeClass("is-valid");
			$("#password").addClass("is-invalid");
			$("#password")
				.next()
				.next()
				.text(
					"password length must be greater than 6 and must contain number, lowercase and uppercase"
				);
			$("#rpass").removeClass("is-valid");
			$("#error-message").hide();
		}
	});

	//show password on click
	$(document).ready(function () {
		$("#showpass").click(function () {
			console.log("clicked");
			if ($("#password").attr("type") === "password") {
				$("#password").attr("type", "text");
				$("#rpass").attr("type", "text");
				$("#showpass").text("Hide Password");
			} else {
				$("#password").attr("type", "password");
				$("#rpass").attr("type", "password");
				$("#showpass").text("Show Password");
			}
		});
	});

	//validation on submit
	$("#submit").click(function () {
		let email = $("#name_or_email").val();
		let password = $("#password").val();
		let rpass = $("#rpass").val();
		let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
		if (
			nama.length > 3 &&
			isNaN(nama) &&
			email.length > 6 &&
			email.includes("@") &&
			email.includes(".") &&
			password.length > 6 &&
			regex.test(password) &&
			rpass == password
		) {
			// enable submit button if all validation is true
		} else {
			alert("form invalid");
		}
	});
});

