<?php
/**
 * Plugin name: Simple Breaks
 * Author: Hit Reach
 * Author URI: Http://www.hitreach.co.uk/
 * Plugin URI: http://www.hitreach.co.uk/wordpress-plugins/simple-breaks/
 * Version: 3.0.0
 * Description: Adds in [br] [clearleft] [clearright] [clearboth] [hr] [space] shortcodes to use in posts and pages.
 * */

if ( !class_exists( "simple_breaks" ) ):

  /**
   * Simple Breaks
   */
  class simple_breaks {

  function __construct() {
    define( "SB_URL", WP_PLUGIN_URL.'/'.str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );
    define( "SB_PLUGIN_DIR", "simple-breaks" );
    define( "SB_PLUGIN_URL", get_bloginfo( 'url' )."/wp-content/plugins/" . SB_PLUGIN_DIR );
    add_shortcode( 'br', array( __CLASS__, 'insert_br' ) );
    add_shortcode( 'clearleft', array( __CLASS__, 'insert_clear_left' ) );
    add_shortcode( 'clearboth', array( __CLASS__, 'insert_clear_both' ) );
    add_shortcode( 'clearright', array( __CLASS__, 'insert_clear_right' ) );
    add_shortcode( 'hr', array( __CLASS__, 'insert_hr' ) );
    add_shortcode( 'space', array( __CLASS__, 'insert_spacer' ) );
    register_activation_hook( __FILE__, array( __CLASS__, "register" ) );
    add_action( 'init', array( __CLASS__, 'add_button' ) );
    add_filter( 'tiny_mce_version', array( __CLASS__, 'refresh_mce' ) );
    add_action( 'admin_menu', array( __CLASS__, 'menu' ) );
  }

  function insert_br( $args ) {
    $args =  shortcode_atts( array( 'id' => "", 'class' =>"" ), $args );
	 $args["class"] .= " sb-br";
    $atts = '';
    if ( $args['id'] != "" ) {
      $atts .= "id='".$args['id']."'";
    }
    if ( $args['class'] != "" ) {
      $atts .= "class='".$args['class']."'";
    }
    return "<br $atts />";
  }

  function insert_clear_left( $args ) {
    $args = shortcode_atts( array( 'id' => "", 'class' =>"", 'span' => false ), $args );
	 $args["class"] .= " sb-cl";
    $atts = '';
    if ( $args['id'] != "" ) {
      $atts .= "id='".$args['id']."'";
    }
    if ( $args['class'] != "" ) {
      $atts .= "class='".$args['class']."'";
    }
    if ( $args['span'] == false ) {
      return "<div style='clear:left' $atts ></div>";
    }
    else {
      return "<span style='clear:left' $atts ></span>";
    }
  }

  function insert_clear_right( $args ) {
    $args = shortcode_atts( array( 'id' => "", 'class' =>"", 'span' => false ), $args );
	 $args["class"] .= " sb-cr";
    $atts = '';
    if ( $args['id'] != "" ) {
      $atts .= "id='".$args['id']."'";
    }
    if ( $args['class'] != "" ) {
      $atts .= "class='".$args['class']."'";
    }
    if ( $args['span'] == false ) {
      return "<div style='clear:right' $atts ></div>";
    } else {
      return "<span style='clear:right' $atts ></span>";
    }
  }

  function insert_clear_both( $args ) {
    $args = shortcode_atts( array( 'id' => "", 'class' =>"", 'span' => false ), $args );
	 $args["class"] .= " sb-cb";
    $atts = '';
    if ( $args['id'] != "" ) {
      $atts .= "id='".$args['id']."'";
    }
    if ( $args['class'] != "" ) {
      $atts .= "class='".$args['class']."'";
    }
    if ( $args['span'] == false ) {
      return "<div style='clear:both' $atts ></div>";
    } else {
      return "<span style='clear:both' $atts ></span>";
    }
  }

  function insert_hr( $args ) {
    $args = shortcode_atts( array( 'id' => "", 'class' =>"", 'size'=>1, 'color'=>"black" ), $args );
	 $args["class"] .= " sb-hr";
    $atts = '';
    if ( $args['id'] != "" ) {
      $atts .= "id='".$args['id']."'";
    }
    if ( $args['class'] != "" ) {
      $atts .= "class='".$args['class']."'";
    }
    return "<hr $atts size='".$args['size']."' style='background:".$args['color']."'/>";
  }

  function insert_spacer( $args ) {
    $args = shortcode_atts( array( 'id' => "", 'class' =>"", 'size'=>5 ), $args );
	 $args["class"] .= " sb-sp";
    $atts = '';
    if ( $args['id'] != "" ) {
      $atts .= "id='".$args['id']."'";
    }
    if ( $args['class'] != "" ) {
      $atts .= "class='".$args['class']."'";
    }
    if (is_numeric($args['size'])) {
      $size = $args['size']."px";
    } else {
      $size = $args['size'];
    }
    return "<div style='height:$size; padding:0; margin:0; ' $atts ></div>";
  }

  /* TINY MCE */

  function register() {
    $values= array( "hr"=> 1, "lb"=>1, "sp"=>1, "cl"=>1, "cr"=>1, "cb"=>1 );
    if ( get_option( "SB_HR_OPTIONS" ) ) {
      $current = get_option( "SB_HR_OPTIONS" );
      if ( is_serialized( $current ) ) {
        $current = unserialize( $current );
      }
      $values = array_merge( $values, $current );
      update_option( "SB_HR_OPTIONS", $values );
    }
    else {
      add_option( "SB_HR_OPTIONS", $values );
    }
  }

  function add_button() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
      return;
    if ( get_user_option( 'rich_editing' ) == 'true' ) {
      add_filter( 'mce_external_plugins', array( __CLASS__, 'add_tinymce_plugin' ) );
      add_filter( 'mce_buttons', array( __CLASS__, 'register_button' ) );
    }
  }

  function register_button( $buttons ) {
    $current = get_option( "SB_HR_OPTIONS" );
    if ( is_serialized( $current ) ) {$current = unserialize( $current );}
    array_push( $buttons, "|" );
    if ( $current['hr'] == 1 ) {
      array_push( $buttons,  "horizontalRule" );
    }
    if ( $current['lb'] == 1 ) {
      array_push( $buttons,  "lineBreak" );
    }
    if ( $current['sp'] == 1 ) {
      array_push( $buttons,  "space" );
    }
    if ( $current['cl'] == 1 ) {
      array_push( $buttons,  "clearLeft" );
    }
    if ( $current['cr'] == 1 ) {
      array_push( $buttons,  "clearRight" );
    }
    if ( $current['cb'] == 1 ) {
      array_push( $buttons,  "clearBoth" );
    }
    return $buttons;
  }

  function add_tinymce_plugin( $plugin_array ) {
    $current = get_option( "SB_HR_OPTIONS" );
    if ( is_serialized( $current ) ) {
      $current = unserialize( $current );
    }
    if ( $current['hr'] == 1 ) {
      $plugin_array['horizontalRule'] = SB_PLUGIN_URL . '/hr.js';
    }
    if ( $current['lb'] == 1 ) {
      $plugin_array['lineBreak'] = SB_PLUGIN_URL . '/hr.js';
    }
    if ( $current['sp'] == 1 ) {
      $plugin_array['space'] = SB_PLUGIN_URL . '/hr.js';
    }
    if ( $current['cl'] == 1 ) {
      $plugin_array['clearLeft'] = SB_PLUGIN_URL . '/hr.js';
    }
    if ( $current['cr'] == 1 ) {
      $plugin_array['clearRight'] = SB_PLUGIN_URL . '/hr.js';
    }
    if ( $current['cb'] == 1 ) {
      $plugin_array['clearBoth'] = SB_PLUGIN_URL . '/hr.js';
    }
    return $plugin_array;
  }

  function refresh_mce( $ver ) {
    $ver += 7;
    return $ver;
  }

  function menu() {
    add_submenu_page( 'options-general.php', 'Simple Breaks', 'Simple Breaks', 'edit_posts', 'simple-breaks', array( __CLASS__, 'options' ) );
  }

  function options() {
    $current = get_option( "SB_HR_OPTIONS" );
    if ( is_serialized( $current ) ) {$current = unserialize( $current );}
?>
    <div class='wrap'>
      <div style='float:left; width:450px;'>
        <h1>Simple Breaks</h1>
        <p class="description">The following options allow you to toggle the tinyMCE editor buttons on and off</p>
        <form method="post" action="options.php">
          <?php wp_nonce_field( 'update-options' ); ?>
          <table class="form-table">
            <tr valign="top">
              <th scope="row"><label for="SB_HR_OPTIONS['hr']">Horizontal Rule: </label></th>
              <td><input type="checkbox" name="SB_HR_OPTIONS[hr]" id="SB_HR_OPTIONS['hr']" value='1' <?php if ( $current['hr']==1 ) {echo "checked='checked'";}?> /></td>
            </tr>
            <tr valign="top">
              <th scope="row"><label for="SB_HR_OPTIONS['lb']">Line Break: </label></th>
              <td><input type="checkbox" name="SB_HR_OPTIONS[lb]" id="SB_HR_OPTIONS['lb']" value='1' <?php if ( $current['lb']==1 ) {echo "checked='checked'";}?> /></td>
            </tr>
            <tr valign="top">
              <th scope="row"><label for="SB_HR_OPTIONS['sp']">Space: </label></th>
              <td><input type="checkbox" name="SB_HR_OPTIONS[sp]" id="SB_HR_OPTIONS['sp']" value='1' <?php if ( $current['sp']==1 ) {echo "checked='checked'";}?> /></td>
            </tr>
            <tr valign="top">
              <th scope="row"><label for="SB_HR_OPTIONS['cl']">Clear Left: </label></th>
              <td><input type="checkbox" name="SB_HR_OPTIONS[cl]" id="SB_HR_OPTIONS['cl']" value='1' <?php if ( $current['cl']==1 ) {echo "checked='checked'";}?> /></td>
            </tr>
            <tr valign="top">
              <th scope="row"><label for="SB_HR_OPTIONS['cr']">Clear Right: </label></th>
              <td><input type="checkbox" name="SB_HR_OPTIONS[cr]" id="SB_HR_OPTIONS['cr']" value='1' <?php if ( $current['cr']==1 ) {echo "checked='checked'";}?> /></td>
            </tr>
            <tr valign="top">
              <th scope="row"><label for="SB_HR_OPTIONS['cb']">Clear Both: </label></th>
              <td><input type="checkbox" name="SB_HR_OPTIONS[cb]" id="SB_HR_OPTIONS['cb']" value='1' <?php if ( $current['cb']==1 ) {echo "checked='checked'";}?> /></td>
            </tr>
          </table>
          <input type="hidden" name="action" value="update" />
          <input type="hidden" name="page_options" value="SB_HR_OPTIONS" />
          <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
          </p>
        </form>
      </div>
    </div>
<?php
  }
}

$simple_breaks = new simple_breaks();
endif;
?>
