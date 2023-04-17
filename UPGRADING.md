# Upgrading Guide

When your installation is fresh it is not required to follow this guide.

## From v3.\* to v4.\*

Always upgrade from v2.\* to v3.\* before upgrading to v4.\*

Only execute the following command when:

-   The previous version of this plug-in was v3.\*
-   The commands, described in the upgrading part from v2.\* to v3.\*, are executed.

### Migrate

Since version 4.0.0 this plug-in uses CMB2 instead of the Metabox.io plug-in.
Projects that have used earlier versions need to execute one command to format all the data of the OpenWOO items so that they can work with CMB2.
Open the terminal and execute `wp openwoo migrate-to-cmb2` and all the items are ready to work with the CMB2 plugin.

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
