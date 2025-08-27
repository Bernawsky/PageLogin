function ClickSliding() {
  const sliding = document.querySelector(".container-sliding");
  const signUp = document.querySelector(".container-SignUp");
  const signIn = document.querySelector(".container-SignIn");

  if (sliding.style.left === "50%" || sliding.style.left === "") {
    sliding.style.left = "0%";
    sliding.style.animation = "slideLeft 1s forwards";

    const signInButton = document.querySelector(".Button-SignUp-sliding");
    signInButton.textContent = "Sign In";

    document.getElementById("firt-h2").textContent = "Welcome Back!";

    if (signUp && signIn) {
      signUp.style.display = "flex";
      signUp.style.pointerEvents = "auto";
      signUp.style.animation = "fadeIn-SignUp 1s forwards";
      signIn.style.animation = "fadeIn-SignIn 1s forwards";
    }
  } else if (sliding.style.left === "0%") {
    sliding.style.left = "50%";
    sliding.style.animation = "slideRight 1s forwards";

    const signInButton = document.querySelector(".Button-SignUp-sliding");
    document.getElementById("firt-h2").textContent = "Hello Friend!";
    signInButton.textContent = "Sign Up";

    if (signUp && signIn) {
      signUp.style.display = "none";
      signUp.style.pointerEvents = "none";
      signIn.style.animation = "fadeOut-SignIn 1s forwards";
    }
    signInButton.onclick = ClickSlidingReverse;
  }
}

const IconEye = document.querySelector(".Icon-Eye");
const IconEyeSlash = document.querySelector(".Icon-EyeSlash");
const PasswordInput = document.getElementById("Password");

IconEye.addEventListener("click", () => {
  if (PasswordInput.type === "password") {
    PasswordInput.type = "text";
    IconEye.style.display = "none";
    IconEyeSlash.style.display = "block";
  } else if (PasswordInput.type === "text" && IconEyeSlash.style.display === "block") {
    PasswordInput.type = "password";
  }
});

IconEyeSlash.addEventListener("click", () => {
  if (PasswordInput.type === "text") {
    PasswordInput.type = "password";
    IconEye.style.display = "block";
    IconEyeSlash.style.display = "none";
  } else if (PasswordInput.type === "password" && IconEye.style.display === "block") {
    PasswordInput.type = "text";
  }
});
