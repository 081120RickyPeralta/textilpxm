<?php
/**
 * Modelo SiteContent
 * Contenido del sitio (navbar, footer, meta, home) almacenado en BD.
 * Claves planas; se construye estructura anidada para loadContent().
 */

class SiteContent extends Model {
    /** Mensaje por defecto para enlace WhatsApp */
    const WHATSAPP_DEFAULT_MESSAGE = 'Hola,%20me%20interesa%20información%20sobre%20sus%20productos';

    /**
     * Obtener todos los registros como array clave => valor
     */
    public function getAll() {
        $rows = $this->fetchAll("SELECT `key`, value FROM site_content");
        $out = [];
        foreach ($rows as $row) {
            $out[$row['key']] = $row['value'] ?? '';
        }
        return $out;
    }

    /**
     * Construir estructura anidada igual que content_data.php para loadContent()
     */
    public function getNested() {
        $flat = $this->getAll();
        if (empty($flat)) {
            return [];
        }
        $get = function($key, $default = '') use ($flat) {
            return isset($flat[$key]) ? $flat[$key] : $default;
        };

        return [
            'navbar' => [
                'brand' => $get('navbar_brand'),
            ],
            'footer' => [
                'brand' => $get('footer_brand'),
                'description' => $get('footer_description'),
                'contact' => [
                    'title' => $get('footer_contact_title'),
                    'address' => [
                        'street' => $get('footer_contact_street'),
                        'city' => $get('footer_contact_city'),
                    ],
                    'phone' => $get('footer_contact_phone'),
                    'email' => $get('footer_contact_email'),
                ],
                'schedule' => [
                    'title' => $get('footer_schedule_title'),
                    'weekdays' => [
                        'days' => $get('footer_schedule_days'),
                        'hours' => $get('footer_schedule_hours'),
                    ],
                ],
                'social' => [
                    'facebook' => $get('footer_social_facebook'),
                    'instagram' => $get('footer_social_instagram'),
                    'whatsapp' => $get('footer_social_whatsapp'),
                ],
                'copyright' => [
                    'text' => $get('footer_copyright_text'),
                    'made_with' => $get('footer_copyright_made_with'),
                ],
            ],
            'meta' => [
                'site' => [
                    'name' => $get('meta_site_name'),
                    'default_title' => $get('meta_site_default_title'),
                    'description' => $get('meta_site_description'),
                    'location' => $get('meta_site_location'),
                ],
            ],
            'home' => [
                'hero' => [
                    'location' => $get('home_hero_location'),
                    'title' => $get('home_hero_title'),
                    'description' => $get('home_hero_description'),
                ],
                'collection' => [
                    'title' => $get('home_collection_title'),
                    'description' => $get('home_collection_description'),
                    'no_products' => $get('home_collection_no_products'),
                ],
                'about' => [
                    'badge' => $get('home_about_badge'),
                    'title' => $get('home_about_title'),
                    'description1' => $get('home_about_description1'),
                    'description2' => $get('home_about_description2'),
                    'stats' => [
                        'years' => [
                            'value' => $get('home_about_stats_years_value'),
                            'label' => $get('home_about_stats_years_label'),
                        ],
                        'countrys' => [
                            'value' => $get('home_about_stats_countrys_value'),
                            'label' => $get('home_about_stats_countrys_label'),
                        ],
                        'products' => [
                            'value' => $get('home_about_stats_products_value'),
                            'label' => $get('home_about_stats_products_label'),
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Guardar un valor por clave (INSERT o UPDATE)
     */
    public function set($key, $value) {
        $key = trim($key);
        if ($key === '') {
            return false;
        }
        $stmt = $this->prepare("INSERT INTO site_content (`key`, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)");
        $stmt->execute([$key, (string) $value]);
        return true;
    }

    /**
     * Guardar múltiples claves
     */
    public function setBulk(array $data) {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }
        return true;
    }

    /**
     * Extraer número de WhatsApp desde URL wa.me/NUMERO
     */
    public static function whatsappUrlToNumber($url) {
        if (!is_string($url) || $url === '') {
            return '';
        }
        if (preg_match('#wa\.me/([0-9]+)#', $url, $m)) {
            return $m[1];
        }
        return $url;
    }

    /**
     * Construir URL completa de WhatsApp desde número (solo dígitos)
     */
    public static function numberToWhatsAppUrl($number) {
        $number = preg_replace('/[^0-9]/', '', $number);
        if ($number === '') {
            return '';
        }
        return 'https://wa.me/' . $number . '?text=' . self::WHATSAPP_DEFAULT_MESSAGE;
    }
}
