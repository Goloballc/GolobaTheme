/**
 * Extensión de VeeValidate para GolobaTheme
 * Agrega soporte para mostrar errores del servidor y reglas de validación personalizadas
 */

// Extender las reglas de validación de VeeValidate
if (typeof window.defineRule !== 'undefined') {
    // Regla para validar números de teléfono (compatible con estándar Bagisto)
    window.defineRule('phone', function (value) {
        if (!value || !value.length) {
            return true; // El campo requerido se maneja por separado
        }
        
        // Usar la misma expresión regular que Bagisto oficial
        if (!/^\+?\d+$/.test(value)) {
            return 'El formato del teléfono no es válido';
        }
        
        return true;
    });
}

// Función para mostrar errores del servidor en los campos
window.showServerErrors = function(errors) {
    if (typeof errors === 'object') {
        Object.keys(errors).forEach(fieldName => {
            const errorMessages = errors[fieldName];
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (field && errorMessages.length > 0) {
                // Crear o actualizar el mensaje de error
                let errorElement = field.parentNode.querySelector('.server-error');
                if (!errorElement) {
                    errorElement = document.createElement('div');
                    errorElement.className = 'server-error text-red-500 text-xs italic mt-1';
                    field.parentNode.appendChild(errorElement);
                }
                errorElement.textContent = errorMessages[0];
                errorElement.style.display = 'block';
            }
        });
    }
};

// Limpiar errores del servidor cuando el usuario interactúa con el campo
document.addEventListener('input', function(e) {
    const serverError = e.target.parentNode.querySelector('.server-error');
    if (serverError) {
        serverError.style.display = 'none';
    }
});

console.log('GolobaTheme VeeValidate extension loaded with phone validation');
