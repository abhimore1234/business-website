// Modal logic for Sign Up and Login
const signupBtn = document.querySelector('.auth-buttons .signup');
const loginBtn = document.querySelector('.auth-buttons .login');
const signupModal = document.getElementById('signupModal');
const loginModal = document.getElementById('loginModal');
const closeSignup = document.getElementById('closeSignup');
const closeLogin = document.getElementById('closeLogin');

// Open modals
if (signupBtn && signupModal) {
    signupBtn.addEventListener('click', function(e) {
        e.preventDefault();
        signupModal.style.display = 'block';
    });
}
if (loginBtn && loginModal) {
    loginBtn.addEventListener('click', function(e) {
        e.preventDefault();
        loginModal.style.display = 'block';
    });
}
// Close modals
if (closeSignup && signupModal) {
    closeSignup.onclick = () => signupModal.style.display = 'none';
}
if (closeLogin && loginModal) {
    closeLogin.onclick = () => loginModal.style.display = 'none';
}
// Close modal when clicking outside content
window.onclick = function(event) {
    if (event.target === signupModal) signupModal.style.display = 'none';
    if (event.target === loginModal) loginModal.style.display = 'none';
};