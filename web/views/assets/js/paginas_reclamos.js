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

    function handleNavigation(event) {
        const button = event.target;
        const action = button.getAttribute('data-action');
        const targetId = button.getAttribute('data-target');

        if (action === 'next') {
            currentStepIndex++;
        } else if (action === 'prev') {
            currentStepIndex--;
        } else if (action === 'submit') {
            // Handle form submission
            document.getElementById('main-form').submit();
            return; // Prevent further processing
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
