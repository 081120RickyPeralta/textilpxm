<?php
/**
 * Contenido central (marca, contacto, meta, home).
 * El resto de textos está en el HTML de cada vista.
 */

return [
    'navbar' => [
        'brand' => 'PRENDAS PUERTO ESCONDIDO',
    ],

    'footer' => [
        'brand' => 'PRENDAS TÍPICAS OAXACA',
        'description' => 'Prendas artesanales de la costa chica de Oaxaca. Tejiendo tradición desde Puerto Escondido.',
        'contact' => [
            'title' => 'Contacto',
            'address' => [
                'street' => 'Punta Zicatela',
                'city' => 'Puerto Escondido, Oaxaca',
            ],
            'phone' => '+52 954 181 78 23',
            'email' => 'prendastipicasoaxaca@gmail.com',
        ],
        'schedule' => [
            'title' => 'Horario',
            'weekdays' => [
                'days' => 'Fines de semana',
                'hours' => '10:00 AM - 7:00 PM',
            ],
        ],
        'social' => [
            'facebook' => 'https://www.facebook.com/profile.php?id=61573404236218',
            'instagram' => 'https://www.instagram.com/prendastipicasoaxaca/',
            'whatsapp' => 'https://wa.me/529541817823?text=Hola,%20me%20interesa%20información%20sobre%20sus%20productos',
        ],
        'copyright' => [
            'text' => 'Oaxaca Textiles. Todos los derechos reservados.',
            'made_with' => 'Hecho con amor en Puerto Escondido, Oaxaca',
        ],
    ],

    'meta' => [
        'site' => [
            'name' => 'Oaxaca Textiles',
            'default_title' => 'Oaxaca Textiles | Ropa Típica de Puerto Escondido',
            'description' => 'Descubre la belleza de la ropa típica oaxaqueña. Prendas artesanales hechas a mano en Puerto Escondido, Oaxaca.',
            'location' => 'Puerto Escondido, Oaxaca',
        ],
    ],

    'home' => [
        'hero' => [
            'location' => 'Puerto Escondido, Oaxaca',
            'title' => 'Tradición Textil Oaxaqueña',
            'description' => 'Descubre prendas únicas tejidas a mano por artesanas de la costa chica de Oaxaca. Cada pieza cuenta una historia de tradición, color y amor por nuestras raíces.',
            'cta' => 'Explorar Colección',
        ],
        'collection' => [
            'badge' => 'Nuestra Colección',
            'title' => 'Prendas Artesanales',
            'description' => 'Cada pieza es elaborada con técnicas ancestrales transmitidas de generación en generación.',
            'cta' => 'Ver Todas las Categorías',
            'no_products' => 'No hay productos disponibles en este momento.',
        ],
        'about' => [
            'badge' => 'Nuestra Historia',
            'title' => 'Raíces que Visten',
            'description1' => 'Desde el corazón de Puerto Escondido, trabajamos directamente con artesanas de la región, preservando técnicas milenarias de tejido en telar de cintura y bordado a mano.',
            'description2' => 'Cada prenda que ofrecemos representa semanas de trabajo dedicado, usando tintes naturales extraídos de la grana cochinilla, el añil y otras plantas de la región.',
            'stats' => [
                'years' => [
                    'value' => '15+',
                    'label' => 'Años de tradición',
                ],
                'countrys' => [
                    'value' => '10+',
                    'label' => 'Paises exportados',
                ],
                'products' => [
                    'value' => '120+',
                    'label' => 'Productos tejidos',
                ],
            ],
        ],
    ],
];
