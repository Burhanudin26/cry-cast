// screen
$(window).on("load", function () {
    $("body").addClass("loaded");
});
// navar
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 0);
});

// Profile Image
const profileImageInput = document.getElementById('profileImageInput');
const profileImage = document.querySelector('#userDropdown img');

profileImageInput.addEventListener('change', () => {
  const file = profileImageInput.files[0];
  const reader = new FileReader();

  reader.onload = () => {
    profileImage.src = reader.result;
  };

  reader.readAsDataURL(file);
});
