<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5"
    style="background-image: url()">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px"
                    data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Comercios</h1>
            </div>
            <div class="down-section text-center"
                data-anime='{ "translateY": [-15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <a href="#down-section" aria-label="scroll down" class="section-link">
                    <div
                        class="d-flex justify-content-center align-items-center mx-auto rounded-circle fs-30 text-white">
                        <i class="feather icon-feather-chevron-down"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- Portal de Trámites -->
<section class="bg-solitude-blue">
    <div class="container" id="tramitesComercio">
        <div class="row align-items-center"
            data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-xl-3 col-lg-4 col-md-12 tab-style-05 md-mb-30px sm-mb-20px">
                <!-- start tab navigation -->
                <ul class="nav nav-tabs justify-content-center border-0 text-left fw-500 fs-18 alt-font">
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four1"
                            class="nav-link d-flex align-items-center active"><i
                                class="feather icon-feather-credit-card icon-extra-medium text-dark-gray"></i><span>RENOVACIÓN
                                HABILITACIÓN COMERCIAL</span></a></li>
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four2"
                            class="nav-link d-flex align-items-center"><i
                                class="feather icon-feather-shopping-bag icon-extra-medium text-dark-gray"></i><span>REGISTRO
                                COMERCIOS PUBLICACIÓN APP</span></a></li>
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four3"
                            class="nav-link d-flex align-items-center"><i
                                class="feather icon-feather-file-text icon-extra-medium text-dark-gray"></i><span>PREINSCRIPCIÓN
                                TRANSPORTISTAS</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four4"><i
                                class="feather icon-feather-calendar icon-extra-medium text-dark-gray"></i><span>PREINSCRIPCIÓN
                                COMERCIOS</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four5"><i
                                class="feather icon-feather-calendar icon-extra-medium text-dark-gray"></i><span>REGISTRO
                                PROVEEDORES</span></a>
                    </li>
                </ul>
                <!-- end tab navigation -->
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="tab-content">
                    <!-- start tab content for TGI -->
                    <div class="tab-pane fade in active show" id="tab_four1">
                        <div class="d-flex flex-column justify-content-center align-items-center d-col">
                            <h5>
                                El trámite de Renovación de Habilitación Comercial consta de 2 pasos para personas
                                físicas y de 3 pasos para personas jurídicas,
                                recuerde que debe terminar de completar los formularios para que el trámite tenga
                                validez.
                            </h5>
                            <button
                                class="inicioTramite btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0 pe-50px appear"
                                data-formulario="formulario-renovacion">
                                INICIAR TRÁMITE
                            </button>
                        </div>
                    </div>
                    <!-- end tab content -->

                    <script>
                    document.addEventListener("DOMContentLoaded", () => {

                        const container = document.querySelector('#tramitesComercio');
                        const contenidoContainerOrig = container.innerHTML;

                        const buttonsInicio = document.querySelectorAll('.inicioTramite');
                        console.log('Botones inicio:', buttonsInicio
                        .length); // Ver cuántos botones se encuentran

                        buttonsInicio.forEach(button => {
                            console.log('Se ha encontrado un botón:',
                            button); // Para verificar si se encuentran los botones
                            button.addEventListener('click', (event) => {
                                console.log('click al botón');
                                const tipoFormulario = event.target.getAttribute(
                                    'data-formulario');

                                if (tipoFormulario == "formulario-renovacion") {
                                    container.innerHTML = '';

                                    container.innerHTML =
                                        `<?php include 'formularios/renovacion/renovacion.php';  ?>`;

                                    initializeFormSteps();


                                }
                            });
                        });
                    });

                    function initializeFormSteps() {
                        const formSteps = document.querySelectorAll('.form-step');
                        const stepContainers = document.querySelectorAll('[id^="page-"]');
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

                            currentStep.querySelectorAll('.required').forEach(field => {
                                const fieldValue = field.value.trim();
                                const type = field.getAttribute('type');
                                const textFormat = /^[a-zA-Z\s]+$/;
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
                            const tipoPersonaSelect = document.querySelector('#tipo_contribuyente');
                            const tipoPersona = tipoPersonaSelect ? tipoPersonaSelect.value : null;

                            if (currentStepIndex === 0 && action === 'next') {
                                const pag2Fisica = document.querySelector('#paso2Fisica');
                                const pag2Juridica = document.querySelector('#paso2Juridica');
                                const pag3Juridica = document.querySelector('#paso3Juridica');

                                if (tipoPersona === "1") {
                                    pag2Fisica.style.display = 'block';
                                    pag2Juridica.style.display = 'none';
                                    pag3Juridica.style.display = 'none';
                                } else if (tipoPersona === "2") {
                                    pag2Fisica.style.display = 'none';
                                    pag2Juridica.style.display = 'block';
                                    pag3Juridica.style.display = 'block';
                                }
                            }

                            if ((action === 'next' || action === 'submit') && !validateCurrentStep()) {
                                return;
                            }

                            if (action === 'next') {
                                currentStepIndex++;
                            } else if (action === 'prev') {
                                currentStepIndex--;
                            } else if (action === 'submit') {
                                if (validateCurrentStep()) {
                                    document.getElementById('form-renovacion').submit();
                                }
                                return;
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

                        showStep(currentStepIndex); // Inicializa con el primer paso
                    }
                    </script>




                    <div class="tab-pane fade" id="tab_four2">

                    </div>

                    <div class="tab-pane fade" id="tab_four3">

                    </div>

                    <div class="tab-pane fade" id="tab_four4">

                    </div>

                    <div class="tab-pane fade" id="tab_four5">

                    </div>

                    <div class="tab-pane fade" id="tab_four6">

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>