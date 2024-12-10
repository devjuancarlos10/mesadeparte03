document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.formularioIniciarSesion');
    const btn = form.querySelector('.btnIniciarSesion');
    const errorContainer = document.createElement('p');
    errorContainer.className = 'mensajeError';
    form.appendChild(errorContainer);

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Evita la recarga de la página

        // Limpia mensajes previos
        errorContainer.textContent = '';
        errorContainer.style.color = 'red';

        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                errorContainer.textContent = errorData.message;
                return;
            }

            const data = await response.json();
            if (data.success) {
                window.location.href = data.redirect; // Redirige al dashboard
            }
        } catch (error) {
            errorContainer.textContent = 'Ocurrió un error inesperado. Inténtalo nuevamente.';
        }
    });
});

let fa_eye_slash = document.querySelector('.boxInputContrasenia').querySelector('.fa-eye-slash');
let fa_eye = document.querySelector('.boxInputContrasenia').querySelector('.fa-eye');
let inputContrasenia = document.querySelector('.inputContrasenia');
fa_eye.addEventListener('click', () => {
    inputContrasenia.type = 'text';
    fa_eye.style.display = 'none';
    fa_eye_slash.style.display = 'block';
});

fa_eye_slash.addEventListener('click', () => {
    inputContrasenia.type = 'password';
    fa_eye_slash.style.display = 'none';
    fa_eye.style.display = 'block';
});