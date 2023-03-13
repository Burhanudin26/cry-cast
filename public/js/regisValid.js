$(document).ready(function () {
	//nama validation
	$("#nama").keyup(function () {
		let nama = $("#nama").val();
		if (nama.length > 3 && isNaN(nama)) {
			$("#nama").removeClass("is-invalid");
			$("#nama").addClass("is-valid");
			$("#nama").next().next().text("");
		} else {
			$("#nama").removeClass("is-valid");
			$("#nama").addClass("is-invalid");
			$("#nama")
				.next()
				.next()
				.text("nama must be string and length must be greater than 3");
		}
	});

	//email validation
	$("#email").keyup(function () {
		let email = $("#email").val();
		if (email.length > 6 && email.includes("@") && email.includes(".")) {
			$("#email").removeClass("is-invalid");
			$("#email").addClass("is-valid");
			$("#email").next().next().text("");
		} else {
			$("#email").removeClass("is-valid");
			$("#email").addClass("is-invalid");
			$("#email").next().next().text("email must be valid email");
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
			$("#pashelp").show();
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
			$("#pashelp").hide();
		}
	});

	// confirm password validation
	$("#rpass").keyup(function () {
		let rpass = $("#rpass").val();
		let password = $("#password").val();
		if (rpass == password) {
			$("#rpass").removeClass("is-invalid");
			$("#rpass").addClass("is-valid");
			$("#rpass").next().next().text("");
		} else {
			$("#rpass").removeClass("is-valid");
			$("#rpass").addClass("is-invalid");
			$("#rpass").next().next().text("password not match");
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
		let nama = $("#nama").val();
		let email = $("#email").val();
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

