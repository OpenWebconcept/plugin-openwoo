# Upgrading Guide

## From v2.\* to v3.\*

### Migrate

A migration WP_CLI command is available: `wp openwoo migrate-metabox-values`
This command will replace old meta keys with new ones as described below.
Also this command will replace meta values with references to GravityForms such as uploads and their URL's.
These meta values belong to attachments of an OpenWOO item.
In older versions simple text fields were used with a URL as value.
The URL's will be used for saving the GravityForms uploads to the Wordpress uploads folder.
This enables the editors to update or delete uploads by using the Wordpress uploader.

After the migration check if the OpenWOO items and their uploads are migrated.
When succesful it's advisable to delete the uploads inside the gravity-forms uploads folder.
The folder can be found on the following location: `/wp-content/uploads/gravity_forms`.

:warning: Take notice :warning:  
When you're not sure if it's safe to delete inside, just delete the from entries. This will also delete the connected uploads.

### If the GravityForms plugin is not used in the project this part is not relevant.

When upgrading to v3.\* there is a modification required on some of the Gravity Form fields.
The field labels that needs to be modified, from previous to new label are:

-   'Zaaknummer' to 'Kenmerk'
-   'Titel' to 'Onderwerp'
-   'Upload informatieverzoek' -> 'Bijlage informatieverzoek'
-   'Upload inventarisatielijst' -> 'Bijlage inventarisatielijst'
-   'Upload besluit' -> 'Bijlage besluit'
