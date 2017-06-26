<?php
/**
 * @package The_Big_Picture
 * @version 1.0
 */
/*
Plugin Name: Analytics by The Big Picture
Plugin URI: https://wordpress.org/plugins/big-picture-analytics/
Description: Codeless analytics, conversion and event tracking. Easily track and manage events and send them to your favorite services. For more information visit https://thebigpicture.io/
Author: Jordan Skole
Version: 1.0
Author URI: https://thebigpicture.io
*/

// function render_the_big_picture ($tbp_id) {
//   echo "<!-- Big Picture --><script>!function(a,b,c){var d=a.bigPicture=a.bigPicture||{};d.SNIPPET_VERSION=1,d.handler=function(a){if(void 0!==d.callback)try{return d.callback(a)}catch(a){}},d.eventList=[\"mousedown\",\"mouseup\",\"click\",\"submit\"],d._q=[],d.methods=["integration","intelReady","on","off"],d.factory=function(a){return function(){var b=Array.prototype.slice.call(arguments);return b.unshift(a),d._q.push(b),d}};for(var e=0;e<d.methods.length;e++){var f=d.methods[e];d[f]=d.factory(f)}d.getCookie=function(a){var c="; "+b.cookie,d=c.split("; "+a+"=");return 2==d.length&&d.pop().split(";").shift()};var g=d.isEditor=function(){try{return a.self!==a.top&&(new RegExp("app"+c,"ig").test(b.referrer)||"edit"==d.getCookie("_bpr_edit"))}catch(a){return!1}}();d.init=function(e){if(d.projectId=e,!g)for(var f=0;f<d.eventList.length;f++)a.addEventListener(d.eventList[f],d.handler,!0);var h=b.createElement(\"script\");h.async=!0;var i=g?\"/editor/editor\":\"/public-\"+e;h.src=\"//cdn\"+c+i+\".js\",b.getElementsByTagName(\"head\")[0].appendChild(h)}}(window,document,\".thebigpicture.io\");bigPicture.init(\" $tbp_id \");</script>"
// }

define( 'TBP_FILE_PATH', dirname( __FILE__ ) );
include_once( TBP_FILE_PATH . '/options.php' );

// This just echoes the chosen line, we'll position it later
function tbp_admin_notice() {
	$options = get_option( 'tbp_settings' );
  if (!$options['tbp_project_id']) {
    ?>
    <div class="notice notice-warning">
      <p id='tbo-warning'>Your BigPicture.io Project ID is not set. <a class="button button-primary" href='/wp-admin/options-general.php?page=the_big_picture'>Set it now</a></p>
    </div>
    <?
  }
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'tbp_admin_notice' );

function tbp_install_snippet () {
  $options = get_option( 'tbp_settings' );
  if ($options['tbp_project_id']) {
    // build the snippet
    echo '<script>!function(a,b,c){var d=a.bigPicture=a.bigPicture||{};d.SNIPPET_VERSION=1,d.handler=function(a){if(void 0!==d.callback)try{return d.callback(a)}catch(a){}},d.eventList=["mousedown","mouseup","click","submit"],d._q=[],d.methods=["integration","intelReady","on","off"],d.factory=function(a){return function(){var b=Array.prototype.slice.call(arguments);return b.unshift(a),d._q.push(b),d}};for(var e=0;e<d.methods.length;e++){var f=d.methods[e];d[f]=d.factory(f)}d.getCookie=function(a){var c="; "+b.cookie,d=c.split("; "+a+"=");return 2==d.length&&d.pop().split(";").shift()};var g=d.isEditor=function(){try{return a.self!==a.top&&(new RegExp("app"+c,"ig").test(b.referrer)||"edit"==d.getCookie("_bpr_edit"))}catch(a){return!1}}();d.init=function(e){if(d.projectId=e,!g)for(var f=0;f<d.eventList.length;f++)a.addEventListener(d.eventList[f],d.handler,!0);var h=b.createElement("script");h.async=!0;var i=g?"/editor/editor":"/public-"+e;h.src="//cdn"+c+i+".js",b.getElementsByTagName("head")[0].appendChild(h)}}(window,document,".thebigpicture.io");bigPicture.init("' . $options['tbp_project_id'] . '");</script>';
  }
}

// hook it into the head
add_action('wp_head', 'tbp_install_snippet');

?>
