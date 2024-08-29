<?php

class NewController {

    /**
     * Traduce el nombre del mes al español.
     *
     * @param int $mes Número del mes (1-12).
     * @return string Nombre del mes en español.
     */
    private function getMesEnEspanol($mes) {
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre'
        ];

        return $meses[$mes];
    }

    /**
     * Formatea una fecha en el formato deseado en español.
     *
     * @param string $fecha La fecha en formato Y-m-d (por ejemplo, '2024-08-09').
     * @return string La fecha formateada en español (por ejemplo, '9 de agosto de 2024').
     */
    public function dateFormat($fecha) {
        // Convertir la fecha a un timestamp
        $timestamp = strtotime($fecha);
        
        // Extraer el día, mes y año
        $dia = date('j', $timestamp);
        $mes = date('n', $timestamp);
        $ano = date('Y', $timestamp);

        // Formatear la fecha en español
        $fecha_formateada = $dia . ' de ' . $this->getMesEnEspanol($mes) . ' de ' . $ano;
        
        return $fecha_formateada;
    }
}

?>
