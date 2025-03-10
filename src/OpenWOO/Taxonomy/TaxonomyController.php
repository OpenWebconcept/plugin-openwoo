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
            <h3>' . __('Additionele uitleg', 'openwoo') . '</h3>
            <p>' . __('De waarde van de slug moet het ID zijn van de blog die je wilt toevoegen als term. Het ID wordt gebruikt om de juiste openwoo-items weer te geven op alle blogs.', 'openwoo') . '</p>
            </div>';
    }
}
