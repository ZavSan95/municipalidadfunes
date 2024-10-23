document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('multiStepForm');
    const tipoContribuyente = document.getElementById('tipo_contribuyente');
    const next1 = document.getElementById('next-1');
    const next2Fisica = document.getElementById('next-2-fisica');
    const next2Juridica = document.getElementById('next-2-juridica');
    const submitButton = document.getElementById('submit');
    const back1 = document.querySelectorAll('#back-1');
    const back2 = document.getElementById('back-2');
    
    const step1 = document.getElementById('step-1');
    const step2Fisica = document.getElementById('step-2-fisica');
    const step2Juridica = document.getElementById('step-2-juridica');
    const step3 = document.getElementById('step-3');

    // Función para validar si todos los campos están completos y no son inválidos
    function validateStep(step) {
        const inputs = step.querySelectorAll('input, select');
        let isValid = true;
        inputs.forEach(input => {
            if (input.classList.contains('required') && (input.value === '' || input.classList.contains('is-invalid'))) {
                isValid = false;
            }
        });
        return isValid;
    }

    // Mostrar el paso correspondiente
    function showStep(stepToShow) {
        document.querySelectorAll('.form-step').forEach(step => step.classList.remove('form-step-active'));
        stepToShow.classList.add('form-step-active');
    }

    // Habilitar el botón "Siguiente" en el primer paso cuando se seleccione el tipo de contribuyente
    tipoContribuyente.addEventListener('change', function () {
        next1.disabled = !validateStep(step1);
    });

    // Al hacer clic en "Siguiente" en el paso 1
    next1.addEventListener('click', function () {
        if (tipoContribuyente.value === 'persona_fisica') {
            showStep(step2Fisica);
        } else if (tipoContribuyente.value === 'persona_juridica') {
            showStep(step2Juridica);
        }
    });

    // Validar el segundo paso de persona física
    step2Fisica.addEventListener('input', function () {
        next2Fisica.disabled = !validateStep(step2Fisica);
    });

    // Validar el segundo paso de persona jurídica
    step2Juridica.addEventListener('input', function () {
        next2Juridica.disabled = !validateStep(step2Juridica);
    });

    // Al hacer clic en "Siguiente" en el paso 2 para persona física
    next2Fisica.addEventListener('click', function () {
        showStep(step1); // O cambiar al siguiente paso real si es necesario
    });

    // Al hacer clic en "Siguiente" en el paso 2 para persona jurídica
    next2Juridica.addEventListener('click', function () {
        showStep(step3);
    });

    // Validar el paso 3 (para persona jurídica)
    step3.addEventListener('input', function () {
        submitButton.disabled = !validateStep(step3);
    });

    // Manejar el botón "Atrás"
    back1.forEach(button => {
        button.addEventListener('click', function () {
            showStep(step1);
        });
    });

    back2.addEventListener('click', function () {
        showStep(step2Juridica);
    });
});