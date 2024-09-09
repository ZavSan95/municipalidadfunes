document.addEventListener("DOMContentLoaded", () => {
    const formSteps = document.querySelectorAll('.form-step');
    const stepContainers = document.querySelectorAll('[id^="step-"]'); // Selects all step containers
    let currentStepIndex = 0;

    function showStep(index) {
        formSteps.forEach((step, i) => {
            step.classList.toggle('d-none', i !== index);
            step.classList.toggle('active', i === index);
        });
        
        stepContainers.forEach((container, i) => {
            container.classList.toggle('active', i === index);
        });
    }

    function validateCurrentStep() {
        const currentStep = formSteps[currentStepIndex];
        let isValid = true;

        // Check all required fields in the current step
        currentStep.querySelectorAll('.required').forEach(field => {
            const fieldValue = field.value.trim();
            const type = field.getAttribute('type');
            const textFormat = /^[a-zA-Z\s]+$/; // Example for text validation
            const emailFormat = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            const telFormat = /[0-9 -()+]+$/;

            if (fieldValue === '') {
                field.classList.add('is-invalid');
                isValid = false;
            } else if (type === 'text' && !textFormat.test(fieldValue)) {
                field.classList.add('is-invalid');
                isValid = false;
            } else if (type === 'email' && !emailFormat.test(fieldValue)) {
                field.classList.add('is-invalid');
                isValid = false;
            } else if (type === 'tel' && !telFormat.test(fieldValue)) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
            }
        });

        return isValid;
    }

    function handleNavigation(event) {
        const button = event.target;
        const action = button.getAttribute('data-action');
        const targetId = button.getAttribute('data-target');

        // Validate current step if the action is "next" or "submit"
        if ((action === 'next' || action === 'submit') && !validateCurrentStep()) {
            return; // Stop the navigation or form submission if validation fails
        }

        if (action === 'next') {
            currentStepIndex++;
        } else if (action === 'prev') {
            currentStepIndex--;
        } else if (action === 'submit') {
            // Check the last step's validation before submitting
            if (validateCurrentStep()) {
                // Submit the form if the last step is valid
                document.getElementById('main-form').submit();
            }
            return; // Prevent further processing if the form is invalid
        }

        if (targetId) {
            currentStepIndex = Array.from(formSteps).findIndex(step => step.id === targetId);
        }

        if (currentStepIndex >= 0 && currentStepIndex < formSteps.length) {
            showStep(currentStepIndex);
        }
    }

    document.querySelectorAll('[data-action]').forEach(button => {
        button.addEventListener('click', handleNavigation);
    });

    // Initialize with the first step
    showStep(currentStepIndex);
});
