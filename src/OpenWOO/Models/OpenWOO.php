<?php

declare(strict_types=1);

namespace Yard\OpenWOO\Models;

/**
 * @OA\Schema(
 *   title="OpenWOO model",
 *   type="object"
 * )
 */
class OpenWOO
{
    protected array $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $this->cleanupData($data);
    }

    protected function cleanupData(array $data): array
    {
        $data['meta'] = array_filter(\get_post_meta($data['ID']), function ($key) {
            return ! preg_match('/^_(.+)/', $key);
        }, ARRAY_FILTER_USE_KEY);

        $data['meta'] = array_map(function ($item) {
            if (is_array($item) and (1 === count($item))) {
                return \maybe_unserialize($item[0]);
            }

            return \maybe_unserialize($item);
        }, $data['meta']);

        return $data;
    }

    /**
     * Transform a single WP_Post item.
     */
    public function transform(): array
    {
        $data = [
            'UUID' => $this->meta('UUID', ''),
            'ID' => $this->meta('Kenmerk', ''),
            'Object_ID' => $this->data['ID'],
            'Publicatie_datum' => $this->data['post_date'] ?? '',
            'Portal_url' => $this->composePortalURL(),
            'Behandelend_bestuursorgaan' => $this->meta('Behandelend_bestuursorgaan'),
            'Ontvanger_informatieverzoek' => $this->meta('Ontvanger_informatieverzoek', ''),
            'Volgnummer' => $this->meta('Volgnummer', ''),
            'Titel' => $this->meta('Onderwerp', ''),
            'Beschrijving' => $this->field('post_content', ''),
            'Samenvatting' => $this->meta('Samenvatting', '') ?: $this->field('post_excerpt', ''),
            'Verzoeker' => $this->meta('Verzoeker', ''),
            'Ontvangstdatum' => $this->meta('Ontvangstdatum') ? $this->transformToEnglishDateFormat($this->meta('Ontvangstdatum')) : '',
            'Besluitdatum' => $this->meta('Besluitdatum') ? $this->transformToEnglishDateFormat($this->meta('Besluitdatum')) : '',
            'Behandelstatus' => $this->meta('Behandelstatus', ''),
            'Besluit' => $this->meta('Besluit'),
            'Termijnoverschrijding' => $this->meta('Termijnoverschrijding', ''),
            'URL_informatieverzoek' => $this->getAttachmentURL('Bijlage_informatieverzoek'),
			'URL_informatieverzoek__is_upload' => !!$this->meta('Bijlage_informatieverzoek'),
            'URL_inventarisatielijst' => $this->getAttachmentURL('Bijlage_inventarisatielijst'),
			'URL_inventarisatielijst__is_upload' => !!$this->meta('Bijlage_inventarisatielijst'),
            'URL_besluit' => $this->getAttachmentURL('Bijlage_besluit'),
			'URL_besluit__is_upload' => !!$this->meta('Bijlage_besluit'),
            'Geografisch_gebied' => $this->meta('Geografisch_gebied', ''),
            'BAG_ID' => $this->meta('BAG_ID', ''),
            'BGT_ID' => $this->meta('BGT_ID', ''),
            'Postcodegebied' => $this->meta('Postcodegebied', ''),
        ];

        foreach ($this->meta('Adres', []) as $adres) {
            if (is_array($adres) && AdresEntity::make($adres)->get()) {
                $data['Adres'] = AdresEntity::make($adres)->get();
            }
        }

        foreach ($this->meta('COORDS', []) as $coords) {
            $coords = COORDSEntity::make(is_array($coords) ? $coords : [])->get();

            if (is_array($coords) && ! empty($coords)) {
                $data['COORDS'] = $coords;

                break;
            }
        }

        foreach ($this->meta('Geografische_positie', []) as $geografischePositie) {
            $geografischePositie = GeografischePositieEntity::make(is_array($geografischePositie) ? $geografischePositie : [])->get();

            if (is_array($geografischePositie) && ! empty($geografischePositie)) {
                $data['Geografische_positie'] = $geografischePositie;

                break;
            }
        }

        foreach ($this->meta('Bijlagen', []) as $bijlage) {
            $bijlage = BijlageEntity::make(is_array($bijlage) ? $bijlage : [])->get();

            if (is_array($bijlage) && ! empty($bijlage)) {
                $data['Bijlagen'][] = $bijlage;
            }
        }

        foreach ($this->meta('Themas', []) as $thema) {
            $thema = ThemaEntity::make(is_array($thema) ? $thema : [])->get();
            if (is_array($thema) && ! empty($thema)) {
                $data['Themas'][] = $thema;
            }
        }

        return array_filter($data);
    }

    /**
     * WordPress uploads are connected in the database by an object its ID.
     * Use this ID to get the URL of the upload.
     * External URLs are a URL already so there is no further action required.
     */
    protected function getAttachmentURL(string $internalMetaKeyURL): string
    {
        $url = $this->meta($internalMetaKeyURL, '');

        if (empty($url)) {
            $externalMetaKeyURL = str_replace('Bijlage', 'URL', $internalMetaKeyURL);
            $url = $this->meta($externalMetaKeyURL, '');
        }

        if (empty($url)) {
            return '';
        }

        if (is_numeric($url)) {
            return \wp_get_attachment_url($url);
        }

        return $url;
    }

    protected function composePortalURL(): string
    {
        if (! class_exists('\OWC\OpenPub\Base\Settings\SettingsPageOptions')) {
            return '';
        }

        $options = \OWC\OpenPub\Base\Settings\SettingsPageOptions::make();

        $urlParts = array_filter([
            \untrailingslashit($options->getPortalURL()),
            'openwoo',
            \sanitize_title($this->meta('Onderwerp', '')),
            $this->meta('UUID', ''),
        ]);

        if (count($urlParts) < 4) {
            return '';
        }

        return vsprintf('%s/%s/%s/%s', $urlParts);
    }

    public function field(string $field, $default = null)
    {
        if (! array_key_exists($field, $this->data)) {
            return $default;
        }

        return trim($this->data[$field]);
    }

    public function meta(string $key, $default = null)
    {
        $separator = '.';
        $key = sprintf('%s_%s', 'woo', $key);
        $data = $this->data['meta'];
        // @assert $key is a non-empty string
        // @assert $data is a loopable array
        // @otherwise return $default value
        if (! is_string($key) || empty($key) || ! count($data)) {
            return $default;
        }

        // @assert $key contains a dot notated string
        if (false !== strpos($key, $separator)) {
            $keys = array_map(function ($key) {
                if (! preg_match('/^woo_/', $key)) {
                    return sprintf('%s_%s', 'woo', $key);
                }

                return $key;
            }, explode($separator, $key));

            foreach ($keys as $innerKey) {
                // @assert $data[$innerKey] is available to continue
                // @otherwise return $default value
                if (! array_key_exists($innerKey, $data)) {
                    return $default;
                }

                $data = $data[$innerKey];
            }

            return $data;
        }

        // @fallback returning value of $key in $data or $default value
        $data = $data[$key] ?? $default;

        // If there is a default but the types do not match, return default
        if (! is_null($default) && gettype($data) !== gettype($default)) {
            return $default;
        }

        return $data;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function transformToEnglishDateFormat(string $date): string
    {
        $formattedDate = \DateTime::createFromFormat('d-m-Y', $date);

        if (! $formattedDate instanceof \DateTime) {
            return $date;
        }

        return $formattedDate->format('Y-m-d');
    }
}
