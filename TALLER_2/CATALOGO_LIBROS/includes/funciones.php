<?php
function obtenerLibros() {
    return [
        [
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'ano_publicacion' => 1605,
            'genero' => 'Novela',
            'descripcion' => 'La historia del ingenioso hidalgo Don Quijote de la Mancha.'
        ],
        [
            'titulo' => 'Cien Años de Soledad',
            'autor' => 'Gabriel García Márquez',
            'ano_publicacion' => 1967,
            'genero' => 'Realismo Mágico',
            'descripcion' => 'Una crónica de la historia de la familia Buendía en el pueblo ficticio de Macondo.'
        ],
        [
            'titulo' => 'La Odisea',
            'autor' => 'Homero',
            'ano_publicacion' => -800,
            'genero' => 'Épico',
            'descripcion' => 'El viaje de regreso a casa de Odiseo después de la Guerra de Troya.'
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'ano_publicacion' => 1949,
            'genero' => 'Distopía',
            'descripcion' => 'Una novela sobre un futuro totalitario en el que el Gran Hermano lo ve todo.'
        ],
        [
            'titulo' => 'Matar a un ruiseñor',
            'autor' => 'Harper Lee',
            'ano_publicacion' => 1960,
            'genero' => 'Novela',
            'descripcion' => 'Una historia sobre el racismo y la injusticia en el sur de Estados Unidos.'
        ]
    ];
}

function mostrarDetallesLibro($libro) {
    return "
    <div class='libro'>
        <h2>{$libro['titulo']}</h2>
        <p><strong>Autor:</strong> {$libro['autor']}</p>
        <p><strong>Año de Publicación:</strong> {$libro['ano_publicacion']}</p>
        <p><strong>Género:</strong> {$libro['genero']}</p>
        <p>{$libro['descripcion']}</p>
    </div>
    <hr>";
}
?>
