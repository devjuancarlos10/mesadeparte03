document.querySelectorAll('.digit-input').forEach((input, index, inputs) => {
    // Función para mover el foco al siguiente campo
    function moveFocus(currentInput, nextInputId) {
        if (currentInput.value.length === currentInput.maxLength) {
            const nextInput = document.getElementById(nextInputId);
            if (nextInput) {
                nextInput.focus();
            }
        }
    }

    // Función para manejar el evento de pegar texto
    function handlePaste(e) {
        // Obtiene el código pegado
        const paste = e.clipboardData.getData('text').trim();
        
        // Verifica que el texto pegado tenga exactamente 6 caracteres (en este caso)
        if (paste.length === 6 && /^[0-9]+$/.test(paste)) {
            // Asigna el valor de cada carácter del código a los inputs
            const inputs = document.querySelectorAll('.digit-input');
            for (let i = 0; i < paste.length; i++) {
                inputs[i].value = paste[i];
            }
        } else {
            alert("El código pegado no es válido. Asegúrese de que sea de 6 dígitos.");
        }
        
        e.preventDefault(); // Evita el comportamiento por defecto del evento de pegar
    }

    // Asociar el evento de pegar a los inputs
    inputs.forEach(input => {
        input.addEventListener('paste', handlePaste);

        // Llamar a la función de mover foco cuando el campo es llenado
        input.addEventListener('input', function() {
            const nextInputId = this.id.replace(/\d+$/, match => parseInt(match) + 1);
            moveFocus(this, nextInputId);
        });
    });
    input.addEventListener('input', () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });
    input.addEventListener('keydown', (event) => {
        if (event.key === 'Backspace' && !input.value && index > 0) {
            inputs[index - 1].focus();
        }
    });
});

// Inicia el cronómetro
const countdownElement = document.getElementById('countdown');
const timerElement = document.getElementById('timer');
const resendContainer = document.getElementById('resend-container');
const btnValidar = document.querySelector('.btnValidar');
let timeLeft = 60;

const timer = setInterval(() => {
    timeLeft--;
    countdownElement.textContent = timeLeft;

    if (timeLeft <= 0) {
        clearInterval(timer);
        timerElement.style.display = 'none';
        resendContainer.classList.remove('hidden'); // Muestra el botón de reenviar
        btnValidar.classList.add('btnValidar-disabled');
        btnValidar.disabled = true;
    }
}, 1000);

document.querySelector('.formularioCodigo').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita el recargo de la página

    const mensajeValidacion = document.getElementById('mensajeValidacion');
    mensajeValidacion.classList.add('hidden'); // Oculta mensajes anteriores

    // Obtener los valores del código
    const codigo = Array.from(document.querySelectorAll('.digit-input')).map(input => input.value).join('');
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Enviar datos al servidor con AJAX
    fetch(rutaVerificarCodigo, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        },
        body: JSON.stringify({ codigo: codigo.split('') }) // Convertir en array
    })
    .then(response => response.json()) // Procesamos la respuesta como JSON
    .then(data => {
        if (data.success) {
            // Si el código es correcto, redirigimos
            window.location.href = rutaRegistrarDatos;
        } else {
            // Mostrar el mensaje de error si el código es incorrecto o ha expirado
            mensajeValidacion.textContent = data.message || "Código incorrecto o expirado.";
            mensajeValidacion.classList.remove('hidden'); // Mostrar el mensaje
        }
    })
    .catch(error => {
        console.error('Error al validar el código:', error);  // Muestra detalles del error en la consola
        mensajeValidacion.textContent = "Ocurrió un error al validar el código.";
        mensajeValidacion.classList.remove('hidden'); // Mostrar el mensaje de error
    });
});
