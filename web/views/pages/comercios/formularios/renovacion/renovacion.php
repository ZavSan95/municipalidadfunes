<div class="row">
    <div class="col-12 px-0 position-relative">
        <div class="container">

            <div id="info-renov">

                <h5>
                    El trámite de Renovación de Habilitación Comercial está diseñado para distinguir
                    entre personas físicas y jurídicas, recuerde que debe terminar de completar los 
                    formularios para que el trámite tenga validez.
                </h5>
                <!-- Botón para iniciar trámite persona física -->
                <button id="startRenovFisica" class="btn btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0 appear">Persona Física</button>

                <!-- Botón para iniciar trámite persona jurídica -->
                <button id="startRenovJuridica" class="btn btn-base-color btn-box-shadow text-center box-shadow-extra-large mt-20px sm-mt-0 appear">Persona Jurídica</button>

            </div>

            <div id="formRenovFisica" class="d-none">
                <?php include 'form-renov-fisica.php'; ?>
            </div>

            <div id="formRenovJuridica" class="d-none">
                <?php include 'form-renov-juridica.php'; ?>
            </div>

        </div>
    </div>
</div>

<script>
    const info = document.getElementById('info-renov');
    const btnBackFisica = document.getElementById('back-fisica');
    const btnBackJuridica = document.getElementById('back-juridica');

    const btnFisica = document.getElementById('startRenovFisica');
    const btnJuridica = document.getElementById('startRenovJuridica');

    const formFisica = document.getElementById('formRenovFisica');
    const formJuridica = document.getElementById('formRenovJuridica');

    btnFisica.addEventListener('click', (event) => {
        event.preventDefault();
        info.classList.add('d-none');
        formFisica.classList.remove('d-none');
    });

    btnJuridica.addEventListener('click', (event) => {
        event.preventDefault();
        info.classList.add('d-none');
        formJuridica.classList.remove('d-none');
    });

    // Agregar el evento para el botón "Regresar" en el formulario de persona física
    if (btnBackFisica) {
        btnBackFisica.addEventListener('click', (event) => {
            event.preventDefault();
            formFisica.classList.add('d-none');
            info.classList.remove('d-none');
        });
    }

    if (btnBackJuridica) {
        btnBackJuridica.addEventListener('click', (event) => {
            event.preventDefault();
            formJuridica.classList.add('d-none');
            info.classList.remove('d-none');
        });
    }
</script>
