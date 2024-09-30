<?php
// lectura de contactos
$dataFile = 'data.csv';
$contacts = [];

if (($handle = fopen($dataFile, 'r')) !== false) {
    $header = fgetcsv($handle, 1000, ",");
    
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $contacts[] = array_combine($header, $data); 
    }
    fclose($handle);
}

// criterio de orden: se prioriza por company size 
// funcion para convertir el tamaño de la empresa en un numero que se pueda comparar
function convertCompanySize($size) {
    return (strpos($size, '+') !== false) ? 10000 : intval(explode('-', $size)[0]);
}
// segundo criterio de orden: priorizar los roles de CTO, CFO y CEO
function rolePriority($role) {
    switch ($role) {
        case 'CTO':
            return 1;
        case 'CFO':
            return 2;
        case 'CEO':
            return 3;
        default:
            return 4; // otros roles tienen menor prioridad
    }
}

// orden de los datos
usort($contacts, function($a, $b) {
    // comparar primero por tamaño de empresa
    $sizeA = convertCompanySize($a['Company Size']);
    $sizeB = convertCompanySize($b['Company Size']);

    if ($sizeA == $sizeB) {
        // si los tamaños son iguales, se compara por rol
        return rolePriority($a['Role']) - rolePriority($b['Role']);
    }

    // se ordena por tamaño de empresa de mayor a menor
    return $sizeB - $sizeA;
});
// guardar los datos ordenados en contact_plan.csv
$outputFile = 'contact_plan.csv';
if (($handle = fopen($outputFile, 'w')) !== false) {
    fputcsv($handle, $header, ",");
    
    foreach ($contacts as $contact) {
        fputcsv($handle, $contact, ",");
    }
    fclose($handle);
}

echo "Los contactos se ordenaron y guardaron en '$outputFile'.\n";
?>
