<?php

namespace Yard\OpenWOO\Taxonomy;

class TaxonomyController
{
    /**
     * Add 'show on' additional explanation.
     */
    public function addShowOnExplanation(string $taxonomy): void
    {
        if ('openwoo-show-on' !== $taxonomy) {
            return;
        }

        echo '<div class="form-field">
            <h3>' . __('Additional explanation', OWO_LANGUAGE_DOMAIN) . '</h3>
            <p>' . __('The slug value must be the ID of the blog you want to add as term. The ID is used for displaying the correct openwoo-items on every blog.', OWO_LANGUAGE_DOMAIN) . '</p>
            </div>';
    }
}
