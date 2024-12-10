function validarContrasenia() {
    const contrasenia = document.getElementById('contrasenia').value;
    const progresoSeguridad = document.getElementById('progresoSeguridad');
    const mensajeSeguridad = document.getElementById('mensajeSeguridad');
    const criteriosFaltantes = document.getElementById('criteriosFaltantes');
    const btnCrearCuenta = document.getElementById('btnCrearCuenta');

    let nivelSeguridad = 0;
    let criterios = [];

    // Validar longitud
    if (contrasenia.length >= 8) {
        nivelSeguridad++;
    } else {
        criterios.push("Debe tener al menos 8 caracteres.");
    }

    // Validar si tiene un número
    if (/[0-9]/.test(contrasenia)) {
        nivelSeguridad++;
    } else {
        criterios.push("Debe incluir al menos un número.");
    }

    // Validar si tiene una letra mayúscula
    if (/[A-Z]/.test(contrasenia)) {
        nivelSeguridad++;
    } else {
        criterios.push("Debe incluir al menos una letra mayúscula.");
    }

    // Validar si tiene un carácter especial
    if (/[^A-Za-z0-9]/.test(contrasenia)) {
        nivelSeguridad++;
    } else {
        criterios.push("Debe incluir al menos un carácter especial.");
    }

    // Actualizar barra de progreso y mensaje
    switch (nivelSeguridad) {
        case 0:
        case 1:
            progresoSeguridad.style.width = '25%';
            progresoSeguridad.style.backgroundColor = 'red';
            mensajeSeguridad.textContent = 'Contraseña no segura';
            mensajeSeguridad.style.color = 'red';
            break;
        case 2:
            progresoSeguridad.style.width = '50%';
            progresoSeguridad.style.backgroundColor = 'orange';
            mensajeSeguridad.textContent = 'Contraseña poco segura';
            mensajeSeguridad.style.color = 'orange';
            break;
        case 3:
            progresoSeguridad.style.width = '75%';
            progresoSeguridad.style.backgroundColor = 'yellow';
            mensajeSeguridad.textContent = 'Contraseña segura';
            mensajeSeguridad.style.color = 'yellow';
            break;
        case 4:
            progresoSeguridad.style.width = '100%';
            progresoSeguridad.style.backgroundColor = 'green';
            mensajeSeguridad.textContent = 'Contraseña muy segura';
            mensajeSeguridad.style.color = 'green';
            break;
    }

    // Actualizar criterios faltantes
    criteriosFaltantes.innerHTML = '';
    criterios.forEach(criterio => {
        const li = document.createElement('li');
        li.textContent = criterio;
        criteriosFaltantes.appendChild(li);
    });

    // Deshabilitar botón si faltan criterios
    btnCrearCuenta.disabled = criterios.length > 0;
}

function validarCoincidencia() {
    const contrasenia = document.getElementById('contrasenia').value;
    const confirmarContrasenia = document.getElementById('confirmar_contrasenia').value;
    const mensajeCoincidencia = document.getElementById('mensajeCoincidencia');
    const btnCrearCuenta = document.getElementById('btnCrearCuenta');

    if (contrasenia === confirmarContrasenia) {
        mensajeCoincidencia.textContent = 'Las contraseñas coinciden';
        mensajeCoincidencia.style.color = 'green';
        btnCrearCuenta.disabled = false; // Habilitar solo si coinciden y todos los criterios están cumplidos
    } else {
        mensajeCoincidencia.textContent = 'Las contraseñas no coinciden';
        mensajeCoincidencia.style.color = 'red';
        btnCrearCuenta.disabled = true;
    }
}
