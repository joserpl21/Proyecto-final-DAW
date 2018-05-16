<?php
/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function efor_form_install_configure_form_alter(&$form, $form_state) {
  // Pre-populate the site name with the server name.
    $form['site_information']['site_name']['#default_value'] = 'Nuevo Sitio Web';
    $form['site_information']['site_mail']['#default_value'] = 'eformedia@efor.es';
    
	$form['admin_account']['account']['name']['#default_value'] = 'Efor';
    $form['admin_account']['account']['mail']['#default_value'] = '[usuario]@efor.es';
    $form['admin_account']['account']['pass']['#default_value'] = 'Efor.' . date("my");
    $form['admin_account']['account']['pass']['#type'] = 'textfield';
    $form['admin_account']['account']['pass']['#title'] = t('Password');
    
    $form['server_settings']['site_default_country']['#default_value'] = 'ES';
    
    $form['update_notifications']['update_status_module'][1]['#default_value'] = false;

}
