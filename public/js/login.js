// login.js

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    const usernameInput = document.querySelector('#username');
    const passwordInput = document.querySelector('#password');

    loginForm.addEventListener('submit', function(e) {
        // Reset pesan error sebelumnya
        const errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
            errorMessage.remove();
        }

        let hasError = false;
        let errorText = '';

        // Validasi username
        if (usernameInput.value.trim() === '') {
            hasError = true;
            errorText += 'Username tidak boleh kosong.<br>';
        }

        // Validasi password
        if (passwordInput.value.trim() === '') {
            hasError = true;
            errorText += 'Password tidak boleh kosong.';
        }

        if (hasError) {
            e.preventDefault();
            // Tampilkan pesan error
            const errorDiv = document.createElement('div');
            errorDiv.classList.add('error-message');
            errorDiv.innerHTML = errorText;
            loginForm.prepend(errorDiv);
        }
    });
});
