# CHANGELOG

## Version 4.2

- Feat: implement setting for configuring a fileserver URL

## Version 4.1.5

- Feat: add publication date to the api response

## Version 4.1.4

- Fix: file size and URL's of attachments in the api response
- Fix: composing $uploadFullPath inside GravityFormsUploadToMediaLibrary trait

## Version 4.1.3

- Feat: add file size of attachments to the api response

## Version 4.1.2

- Refactor: hide taxonomies from quick edit menu

## Version 4.1.1

- Refactor: show on taxonomy method for explanation was called statically

## Version 4.1.0

- Feat: Add show on taxonomy

## Version 4.0.2

- Refactor: display 'Ontvangstdatum' and 'Besluitdatum' date fields in English format within API
- Refactor: use 'woo_Onderwerp' for filling the title inside the 'wp_insert_post_data' hook

## Version 4.0.1

- Fix: use CURL instead of file_get_contents

## Version 4.0.0

- Feat: implement CMB2 and replace Metabox.io

## Version 3.0.1

- Fix: bijlageEntity

## Version 3.0.0

- Refactor: api output compliant with new metabox fields
- Feat: migration of existing items
- Feat: add address metabox group
- Chore: revisit metabox fields
- Feat: replace GF uploads with WP attachments admin

## Version 2.0.0

- Chore: clean-up, php8 and compliant with new version of ElasticPress.

## Version 1.0.13

- Fix: improper casting

## Version 1.0.12

- Feat: disable Elasticpress filters when `yard-elasticsearch` is active.

## Version 1.0.11

- Refactor: config metaboxes array key

## Version 1.0.10

- Refactor: name change OpenWOB becomes OpenWOO

## Version 1.0.9

- Fix: Elasticpress filter 'epwr_decay' expects float value instead of int.

## Version 1.0.8

- Feat: add config taxonomies and register per CPT.

## Version 1.0.7

- Fix: don't overwrite UUID after generation

## Version 1.0.6

- Chore: add per_page as alias for limit

## Version 1.0.5

- Chore: format labels in admin.

## Version 1.0.4

- Fix: remove OpenWOB items from the global post_type indexing for Elasticpress.

## Version 1.0.3

- Add UUID for identifier
- RestAPI: findBy UUID instead of custom ID

## Version 1.0.2

- Cleanup duplicate code in OpenWOBSyncManager
- Update dependency versions

## Version 1.0.1

- Add excerpt to OpenWOB
- Upgrade PHP-CS-Fixer to version 3.0

## Version 1.0.0

- Initial release
