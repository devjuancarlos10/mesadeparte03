document.getElementById('formRegistro').addEventListener('submit', async function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de manera tradicional

    const correoInput = document.getElementById('correo');
    const correo = correoInput.value.trim();
    const mensajeAdvertencia = document.getElementById('mensajeAdvertencia');
    const botonEnviar = document.getElementById('btnValidar');

    // Expresión regular para validar correos de la UNCP
    const regex = /^[a-zA-Z0-9._%+-]+@uncp\.edu\.pe$/;

    // Verificar si el correo es válido
    if (!regex.test(correo)) {
        mensajeAdvertencia.textContent = 'Por favor, ingrese un correo válido de la UNCP (@uncp.edu.pe)';
        mensajeAdvertencia.style.color = 'red';
        return; // Detener ejecución si el correo no es válido
    }

    // Si el correo es válido, verificar si ya está registrado
    try {
        const response = await fetch(verificarCorreoUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ correo })
        });

        const data = await response.json();

        if (data.existe) {
            // Si el correo ya está registrado, mostrar un mensaje y no hacer submit
            mensajeAdvertencia.textContent = 'Este correo ya está registrado, ingrese otro correo';
            mensajeAdvertencia.style.color = 'red';

            // Deshabilitar el botón de enviar
            botonEnviar.disabled = true; // Deshabilitar el botón para evitar múltiples envíos
            window.location.href = rutaCorreo ;
            // Enviar el código al correo registrado
            const envioCodigoResponse = await fetch(enviarCodigoUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ correo }) // Enviar el correo para enviar el código
            });

            const envioCodigoData = await envioCodigoResponse.json();

            if (envioCodigoData.exito) {
                // Si el código fue enviado correctamente, mostrar mensaje de éxito
                mensajeAdvertencia.textContent = 'Código enviado al correo.';
                mensajeAdvertencia.style.color = 'green';
            } else {
                // Si hubo un error al enviar el código, mostrar el error
                mensajeAdvertencia.textContent = 'Error al enviar el código. Intenta nuevamente.';
                mensajeAdvertencia.style.color = 'red';
            }
        } else {
            // Si el correo no está registrado, enviar el formulario (submit)
            mensajeAdvertencia.textContent = ''; // Limpiar mensaje de advertencia
            loader.style.display = 'block';
            loaderText.style.display = 'block';
            botonEnviar.classList.add('disabled');
            botonEnviar.disabled = false;
            // Aquí puedes continuar con el flujo de enviar el formulario normalmente
            event.target.submit(); // Esto realiza el submit si el correo no está registrado
        }
    } catch (error) {
        mensajeAdvertencia.textContent = 'Intente con otro correo o vuelva a intentarlo más tarde.';
        mensajeAdvertencia.style.color = 'red';
    }
});
