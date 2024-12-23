// Function to open the signup modal
function openSignupModal() {
    document.getElementById('signupModal').style.display = 'flex';
    document.getElementById('loginModal').style.display = 'none'; // Close login modal if open
}

// Function to open the login modal
function openLoginModal() {
    document.getElementById('loginModal').style.display = 'flex';
    document.getElementById('signupModal').style.display = 'none'; // Close signup modal if open
}

// Function to close the modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close the modal if the user clicks outside the modal content
window.onclick = function(event) {
    const signupModal = document.getElementById('signupModal');
    const loginModal = document.getElementById('loginModal');
    if (event.target == signupModal) {
        signupModal.style.display = 'none';
    } else if (event.target == loginModal) {
        loginModal.style.display = 'none';
    }
};
function openSignupPage() {
    window.location.href = "login.html";
}

function openLoginPage() {
    window.location.href = "login.html";
}

