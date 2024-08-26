window.addEventListener('load', function () {
    // Muestra el spinner durante 1.5 segundos
    setTimeout(function () {
        // Oculta el preloader
        document.getElementById('preloader').style.display = 'none';

        // Verifica si el elemento con clase .layout__turnos existe
        var layoutTurnos = document.querySelector('.layout__turnos');
        if (layoutTurnos) {
            // Muestra el iframe si se encuentra .layout__turnos
            layoutTurnos.style.opacity = '1';
        } else {
            // Si no se encuentra .layout__turnos, busca el elemento con ID down-section
            var downSection = document.getElementById('down-section');
            if (downSection) {
                // Muestra el contenido de down-section
                downSection.style.opacity = '1';
            }
        }
    }, 1500); 
});
