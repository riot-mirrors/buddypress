<?php

/**
 * BuddyPress Blogs Streams Loader
 *
 * An blogs stream component, for users, groups, and blog tracking.
 *
 * @package BuddyPress
 * @subpackage Blogs Core
 */

class BP_Blogs_Component extends BP_Component {

	/**
	 * Start the blogs component creation process
	 *
	 * @since BuddyPress {unknown}
	 */
	function BP_Blogs_Component() {
		parent::start(
			'blogs',
			__( 'Blogs Streams', 'buddypress' ),
			BP_PLUGIN_DIR
		);
	}

	/**
	 * Setup globals
	 *
	 * The BP_BLOGS_SLUG constant is deprecated, and only used here for
	 * backwards compatibility.
	 *
	 * @since BuddyPress {unknown}
	 * @global obj $bp
	 */
	function _setup_globals() {
		global $bp;

		if ( !defined( 'BP_BLOGS_SLUG' ) )
			define ( 'BP_BLOGS_SLUG', $this->id );

		// Global tables for messaging component
		$global_tables = array(
			'table_name'          => $bp->table_prefix . 'bp_user_blogs',
			'table_name_blogmeta' => $bp->table_prefix . 'bp_user_blogs_blogmeta',
		);

		// All globals for messaging component.
		// Note that global_tables is included in this array.
		$globals = array(
			'path'                  => BP_PLUGIN_DIR,
			'slug'                  => BP_BLOGS_SLUG,
			'root_slug'             => isset( $bp->pages->blogs->slug ) ? $bp->pages->blogs->slug : BP_BLOGS_SLUG,
			'notification_callback' => 'bp_blogs_format_notifications',
			'search_string'         => __( 'Search Blogs...', 'buddypress' ),
			'autocomplete_all'      => defined( 'BP_MESSAGES_AUTOCOMPLETE_ALL' ),
			'global_tables'         => $global_tables,
		);

		// Setup the globals
		parent::_setup_globals( $globals );
	}

	/**
	 * Include files
	 */
	function _includes() {
		// Files to include
		$includes = array(
			'cache',
			'actions',
			'screens',
			'classes',
			'template',
			'activity',
			'functions',
		);

		if ( is_multisite() )
			$includes[] = 'widgets';

		// Include the files
		parent::_includes( $includes );
	}

	/**
	 * Setup BuddyBar navigation
	 *
	 * @global obj $bp
	 */
	function _setup_nav() {
		global $bp;

		/**
		 * Blog/post/comment menus should not appear on single WordPress setups.
		 * Although comments and posts made by users will still show on their
		 * activity stream.
		 */
		if ( !is_multisite() )
			return false;

		// Add 'Blogs' to the main navigation
		$main_nav =  array(
			'name'                => sprintf( __( 'Blogs <span>(%d)</span>', 'buddypress' ), bp_blogs_total_blogs_for_user() ),
			'slug'                => $this->slug,
			'position'            => 30,
			'screen_function'     => 'bp_blogs_screen_my_blogs',
			'default_subnav_slug' => 'my-blogs',
			'item_css_id'         => $this->id
		);

		// Setup navigation
		parent::_setup_nav( $main_nav );
	}
	
	/**
	 * Sets up the title for pages and <title>
	 *
	 * @global obj $bp
	 */
	function _setup_title() {
		global $bp;

		// Set up the component options navigation for Blog
		if ( bp_is_blogs_component() ) {
			if ( bp_is_my_profile() ) {
				if ( bp_is_active( 'xprofile' ) ) {
					$bp->bp_options_title = __( 'My Blogs', 'buddypress' );
				}

			// If we are not viewing the logged in user, set up the current
			// users avatar and name
			} else {
				$bp->bp_options_avatar = bp_core_fetch_avatar( array(
					'item_id' => $bp->displayed_user->id,
					'type'    => 'thumb'
				) );
				$bp->bp_options_title = $bp->displayed_user->fullname;
			}
		}

		parent::_setup_title();
	}
}
// Create the blogs component
$bp->blogs = new BP_Blogs_Component();

?>
