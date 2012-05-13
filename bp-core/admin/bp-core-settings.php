<?php

/**
 * BuddyPress Admin Settings
 *
 * @package BuddyPress
 * @subpackage CoreAdministration
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Main settings section description for the settings page
 *
 * @since BuddyPress (r2786)
 */
function bp_admin_setting_callback_main_section() { }

/**
 * Throttle setting field
 *
 * @since BuddyPress (r2737)
 *
 * @uses bp_form_option() To output the option value
 */
function bp_admin_setting_callback_admin_bar() {
?>

	<input id="hide-loggedout-adminbar" name="hide-loggedout-adminbar" type="checkbox" value="1" <?php checked( !bp_hide_loggedout_adminbar( false ) ); ?> />
	<label for="hide-loggedout-adminbar"><?php _e( 'Show the admin bar for logged out users', 'buddypress' ); ?></label>

<?php
}

/**
 * Allow subscriptions setting field
 *
 * @since BuddyPress (r2737)
 *
 * @uses checked() To display the checked attribute
 */
function bp_admin_setting_callback_account_deletion() {
?>

	<input id="bp-disable-account-deletion" name="bp-disable-account-deletion" type="checkbox" value="1" <?php checked( !bp_disable_account_deletion( true ) ); ?> />
	<label for="bp-disable-account-deletion"><?php _e( 'Allow registered members to delete their own accounts', 'buddypress' ); ?></label>

<?php
}

/**
 * Use the WordPress editor setting field
 *
 * @since BuddyPress (r3586)
 *
 * @uses checked() To display the checked attribute
 */
function bp_admin_setting_callback_use_wp_editor() {
?>

	<input id="_bp_use_wp_editor" name="_bp_use_wp_editor" type="checkbox" id="_bp_use_wp_editor" value="1" <?php checked( bp_use_wp_editor( true ) ); ?> />
	<label for="_bp_use_wp_editor"><?php _e( 'Use the fancy WordPress editor to create and edit topics and replies', 'buddypress' ); ?></label>

<?php
}

/** Activity *******************************************************************/

/**
 * Groups settings section description for the settings page
 *
 * @since BuddyPress (1.6)
 */
function bp_admin_setting_callback_activity_section() { }

/**
 * Allow Akismet setting field
 *
 * @since BuddyPress (r3575)
 *
 * @uses checked() To display the checked attribute
 */
function bp_admin_setting_callback_activity_akismet() {
?>

	<input id="_bp_enable_akismet" name="_bp_enable_akismet" type="checkbox" value="1" <?php checked( bp_is_akismet_active( true ) ); ?> />
	<label for="_bp_enable_akismet"><?php _e( 'Allow Akismet to scan for activity stream spam', 'buddypress' ); ?></label>

<?php
}

/** XProfile ******************************************************************/

/**
 * Profile settings section description for the settings page
 *
 * @since BuddyPress (1.0)
 */
function bp_admin_setting_callback_xprofile_section() { }

/**
 * Edit lock setting field
 *
 * @since BuddyPress (r2737)
 *
 * @uses bp_form_option() To output the option value
 */
function bp_admin_setting_callback_profile_sync() {
?>

	<input id="bp-disable-profile-sync" name="bp-disable-profile-sync" type="checkbox" value="1" <?php checked( !bp_disable_profile_sync( false ) ); ?> />
	<label for="bp-disable-profile-sync"><?php _e( 'Enable BuddyPress to WordPress profile syncing', 'buddypress' ); ?></label>

<?php
}

/**
 * Allow favorites setting field
 *
 * @since BuddyPress (r2786)
 *
 * @uses checked() To display the checked attribute
 */
function bp_admin_setting_callback_avatar_uploads() {
?>

	<input id="bp-disable-avatar-uploads" name="bp-disable-avatar-uploads" type="checkbox" value="1" <?php checked( !bp_disable_avatar_uploads( true ) ); ?> />
	<label for="bp-disable-avatar-uploads"><?php _e( 'Allow registered members to upload avatars', 'buddypress' ); ?></label>

<?php
}

/** Groups Section ************************************************************/

/**
 * Groups settings section description for the settings page
 *
 * @since BuddyPress (1.6)
 */
function bp_admin_setting_callback_groups_section() { }

/**
 * Allow topic and reply revisions
 *
 * @since BuddyPress (1.6)
 *
 * @uses checked() To display the checked attribute
 */
function bp_admin_setting_callback_group_creation() {
?>

	<input id="bp_restrict_group_creation" name="bp_restrict_group_creation" type="checkbox"value="1" <?php checked( !bp_restrict_group_creation( true ) ); ?> />
	<label for="bp_restrict_group_creation"><?php _e( 'Enable group creation for all users', 'buddypress' ); ?></label>
	<p class="description"><?php _e( 'Administrators can always create groups, regardless of this setting.', 'buddypress' ); ?></p>

<?php
}

/** Forums Section ************************************************************/

/**
 * Forums settings section description for the settings page
 *
 * @since BuddyPress (1.6)
 */
function bp_admin_setting_callback_bbpress_section() { }

/**
 * Allow topic and reply revisions
 *
 * @since BuddyPress (1.6)
 * @uses checked() To display the checked attribute
 * @uses bp_get_option() To get the config location
 * @uses bp_form_option() To get the sanitized form option
 */
function bp_admin_setting_callback_bbpress_configuration() {

	$config_location = bp_get_option( 'bb-config-location' );
	$file_exists     = (bool) ( file_exists( $config_location ) || is_file( $config_location ) ); ?>

	<input name="bb-config-location" type="text" id="bb-config-location" value="<?php bp_form_option( 'bb-config-location', '' ); ?>" class="medium-text" style="width: 300px;" />

	<?php if ( false === $file_exists ) : ?>

		<a class="button" href="<?php bp_admin_url( 'admin.php?page=bb-forums-setup&repair=1' ); ?>" title="<?php _e( 'Attempt to save a new config file.', 'buddypress' ); ?>"><?php _e( 'Repair', 'buddypress' ) ?></a>
		<span class="attention"><?php _e( 'File does not exist', 'buddypress' ); ?></span>

	<?php endif; ?>

	<p class="description"><?php _e( 'Absolute path to your bbPress configuration file.', 'buddypress' ); ?></p>

<?php
}

/** Settings Page *************************************************************/

/**
 * The main settings page
 *
 * @since BuddyPress (r2643)
 *
 * @uses screen_icon() To display the screen icon
 * @uses settings_fields() To output the hidden fields for the form
 * @uses do_settings_sections() To output the settings sections
 */
function bp_core_admin_settings() {
	global $wp_settings_fields;

	if ( !empty( $_POST['submit'] ) ) {
		check_admin_referer( 'buddypress-options' );

		// Because many settings are saved with checkboxes, and thus will have no values
		// in the $_POST array when unchecked, we loop through the registered settings
		if ( isset( $wp_settings_fields['buddypress'] ) ) {
			foreach( (array) $wp_settings_fields['buddypress'] as $section => $settings ) {
				foreach( $settings as $setting_name => $setting ) {
					$value = isset( $_POST[$setting_name] ) ? $_POST[$setting_name] : '';

					bp_update_option( $setting_name, $value );
				}
			}
		}

		// Some legacy options are not registered with the Settings API
		$legacy_options = array(
			'bp-disable-profile-sync',
			'hide-loggedout-adminbar',
			'bp-disable-avatar-uploads',
			'bp-disable-account-deletion',
			'bp_restrict_group_creation'
		);

		foreach( $legacy_options as $legacy_option ) {
			// Note: Each of these options is represented by its opposite in the UI
			// Ie, the Profile Syncing option reads "Enable Sync", so when it's checked,
			// the corresponding option should be unset
			$value = isset( $_POST[$legacy_option] ) ? '' : 1;
			bp_update_option( $legacy_option, $value );
		}
	}
	
	// We're saving our own options, until the WP Settings API is updated to work with Multisite
	$form_action = add_query_arg( 'page', 'bp-settings', bp_core_do_network_admin() ? network_admin_url( 'admin.php' ) : admin_url( 'admin.php' ) ); ?>

	<div class="wrap">

		<?php screen_icon( 'buddypress' ); ?>

		<h2 class="nav-tab-wrapper"><?php bp_core_admin_tabs( __( 'Settings', 'buddypress' ) ); ?></h2>

		<form action="<?php echo $form_action ?>" method="post">

			<?php settings_fields( 'buddypress' ); ?>

			<?php do_settings_sections( 'buddypress' ); ?>

			<p class="submit">
				<input type="submit" name="submit" class="button-primary" value="<?php _e( 'Save Changes', 'buddypress' ); ?>" />
			</p>
		</form>
	</div>

<?php
}

/**
 * Output settings API option
 *
 * @since BuddyPress (r3203)
 *
 * @uses bp_get_bp_form_option()
 *
 * @param string $option
 * @param string $default
 * @param bool $slug
 */
function bp_form_option( $option, $default = '' , $slug = false ) {
	echo bp_get_form_option( $option, $default, $slug );
}
	/**
	 * Return settings API option
	 *
	 * @since BuddyPress (r3203)
	 *
	 * @uses bp_get_option()
	 * @uses esc_attr()
	 * @uses apply_filters()
	 *
	 * @param string $option
	 * @param string $default
	 * @param bool $slug
	 */
	function bp_get_form_option( $option, $default = '', $slug = false ) {

		// Get the option and sanitize it
		$value = bp_get_option( $option, $default );

		// Slug?
		if ( true === $slug )
			$value = esc_attr( apply_filters( 'editable_slug', $value ) );

		// Not a slug
		else
			$value = esc_attr( $value );

		// Fallback to default
		if ( empty( $value ) )
			$value = $default;

		// Allow plugins to further filter the output
		return apply_filters( 'bp_get_form_option', $value, $option );
	}

/**
 * Used to check if a BuddyPress slug conflicts with an existing known slug.
 *
 * @since BuddyPress (r3306)
 *
 * @param string $slug
 * @param string $default
 *
 * @uses bp_get_form_option() To get a sanitized slug string
 */
function bp_form_slug_conflict_check( $slug, $default ) {

	// Only set the slugs once ver page load
	static $the_core_slugs = array();

	// Get the form value
	$this_slug = bp_get_form_option( $slug, $default, true );

	if ( empty( $the_core_slugs ) ) {

		// Slugs to check
		$core_slugs = apply_filters( 'bp_slug_conflict_check', array(

			/** WordPress Core ****************************************************/

			// Core Post Types
			'post_base'       => array( 'name' => __( 'Posts'         ), 'default' => 'post',          'context' => 'WordPress' ),
			'page_base'       => array( 'name' => __( 'Pages'         ), 'default' => 'page',          'context' => 'WordPress' ),
			'revision_base'   => array( 'name' => __( 'Revisions'     ), 'default' => 'revision',      'context' => 'WordPress' ),
			'attachment_base' => array( 'name' => __( 'Attachments'   ), 'default' => 'attachment',    'context' => 'WordPress' ),
			'nav_menu_base'   => array( 'name' => __( 'Menus'         ), 'default' => 'nav_menu_item', 'context' => 'WordPress' ),

			// Post Tags
			'tag_base'        => array( 'name' => __( 'Tag base'      ), 'default' => 'tag',           'context' => 'WordPress' ),

			// Post Categories
			'category_base'   => array( 'name' => __( 'Category base' ), 'default' => 'category',      'context' => 'WordPress' ),

		) );

		/** bbPress Core ******************************************************/

		if ( bp_forums_is_bbpress_active() ) {

			// Forum archive slug
			$core_slugs['_bbp_root_slug']          = array( 'name' => __( 'Forums base', 'buddypress' ), 'default' => 'forums', 'context' => 'buddypress' );

			// Topic archive slug
			$core_slugs['_bbp_topic_archive_slug'] = array( 'name' => __( 'Topics base', 'buddypress' ), 'default' => 'topics', 'context' => 'buddypress' );

			// Forum slug
			$core_slugs['_bbp_forum_slug']         = array( 'name' => __( 'Forum slug',  'buddypress' ), 'default' => 'forum',  'context' => 'buddypress' );

			// Topic slug
			$core_slugs['_bbp_topic_slug']         = array( 'name' => __( 'Topic slug',  'buddypress' ), 'default' => 'topic',  'context' => 'buddypress' );

			// Reply slug
			$core_slugs['_bbp_reply_slug']         = array( 'name' => __( 'Reply slug',  'buddypress' ), 'default' => 'reply',  'context' => 'buddypress' );

			// User profile slug
			$core_slugs['_bbp_user_slug']          = array( 'name' => __( 'User base',   'buddypress' ), 'default' => 'users',  'context' => 'buddypress' );

			// View slug
			$core_slugs['_bbp_view_slug']          = array( 'name' => __( 'View base',   'buddypress' ), 'default' => 'view',   'context' => 'buddypress' );

			// Topic tag slug
			$core_slugs['_bbp_topic_tag_slug']     = array( 'name' => __( 'Topic tag slug', 'buddypress' ), 'default' => 'topic-tag', 'context' => 'buddypress' );
		}

		/** BuddyPress Core *******************************************************/

		global $bp;

		// Loop through root slugs and check for conflict
		if ( !empty( $bp->pages ) ) {
			foreach ( $bp->pages as $page => $page_data ) {
				$page_base    = $page . '_base';
				$page_title   = sprintf( __( '%s page', 'buddypress' ), $page_data->title );
				$core_slugs[$page_base] = array( 'name' => $page_title, 'default' => $page_data->slug, 'context' => 'buddypress' );
			}
		}

		// Set the static
		$the_core_slugs = apply_filters( 'bp_slug_conflict', $core_slugs );
	}

	// Loop through slugs to check
	foreach( $the_core_slugs as $key => $value ) {

		// Get the slug
		$slug_check = bp_get_form_option( $key, $value['default'], true );

		// Compare
		if ( ( $slug != $key ) && ( $slug_check == $this_slug ) ) : ?>

			<span class="attention"><?php printf( __( 'Possible %1$s conflict: <strong>%2$s</strong>', 'buddypress' ), $value['context'], $value['name'] ); ?></span>

		<?php endif;
	}
}

?>