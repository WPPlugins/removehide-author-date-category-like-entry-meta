<?php
error_reporting(E_ALL ^ E_NOTICE);
/**
 * Plugin Name: Remove/hide Author, Date, Category Like Entry-Meta
 * Plugin URI: https://venugopalphp.wordpress.com
 * Description: This plugin Remove the Author, Date, Category, Comment and Edit links meta data under the each posts. If you want hide selected one go to this plugin select check boxes what you want hide or remove. By default this plugin remove the total meta. 
 * Version: 2.1
 * Author: Venugopal.
 * Author URI: https://venugopalphp.wordpress.com
 * License: GPL2
 */
/**
 * Including plugin  styles
 */
add_action('admin_init', 'remove_ar_dt_cat_styles');

function remove_ar_dt_cat_styles() {
    $pluginfolder = get_bloginfo('url') . '/' . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/css';
    wp_enqueue_style('r_a_d_c', $pluginfolder . '/r_a_d_c.css');
}

/* Initializing  plugin function */

function remove_a_d_c_plugin_menu() {
    add_options_page( __('Remove Author,date & Entry-Meta','remove_a_d_c'), __('Remove Author,date & Entry-Meta','remove_a_d_c'), 'manage_options', 'remove-a-d-c', 'remove_a_d_c');
}

add_action('admin_menu', 'remove_a_d_c_plugin_menu');

/* Calling plugin function */

function remove_a_d_c() {
    /* Plugin heading */
     echo "<h3>".esc_attr(__('Welcome to Remove Entry-Meta Plugin'))."</h3>";


    /* Checking submit button clicked or not	 */
    if (isset($_REQUEST['a_d_c_submit'])) {

        /* If Author check-box checked  assign value 1 else 0 */
        if (isset($_REQUEST['author'])) {
            update_option('radc_remove_author', "1");
        } else {
            update_option('radc_remove_author', '0');
        }

        /* If Date check box checked assign value 1 else 0 */
        if (isset($_REQUEST['date'])) {
            update_option('radc_remove_date', "1");
        } else {
            update_option('radc_remove_date', '0');
        }

        /* If Category check box checked assign value 1 else 0 */
        if (isset($_REQUEST['category'])) {
            update_option('radc_remove_category', "1");
        } else {
            update_option('radc_remove_category', '0');
        }

        /* If Comment check box checked assign value 1 else 0 */
        if (isset($_REQUEST['comment'])) {
            update_option('radc_remove_comment', "1");
        } else {
            update_option('radc_remove_comment', '0');
        }

        /* If Edit check box checked assign value 1 else 0 */
        if (isset($_REQUEST['edit'])) {
            update_option('radc_remove_edit', "1");
        } else {
            update_option('radc_remove_edit', '0');
        }
    }
    /* Getting check box checked values from database  */
    $au = get_option('radc_remove_author');
    $da = get_option('radc_remove_date');
    $ca = get_option('radc_remove_category');
    $ct = get_option('radc_remove_comment');
    $et = get_option('radc_remove_edit');

    /* Display Check boxes List below */
    ?>
    <div class="inside_r">
        <form name="r_a_d_c_e" method="post">	


            <div class="a_d_c">
                <input type="checkbox" id="chked1" name="author" class="a_d_c_author" value="author" <?php if ($au == '1') { ?>checked="checked" <?php } ?>> <?php echo _e('Author'); ?>
            </div>
            <div class="a_d_c">
                <input type="checkbox" id="chked2" name="date" class="a_d_c_date" value="date" <?php if ($da == '1') { ?>checked="checked" <?php } ?>> <?php echo _e('Date'); ?>
            </div>
            <div class="a_d_c">
                <input type="checkbox" id="chked3" name="category" class="a_d_c_cat" value="category" <?php if ($ca == '1') { ?>checked="checked" <?php } ?>> <?php echo _e('Category'); ?>
            </div>
            <div class="a_d_c">
                <input type="checkbox" id="chked4" name="comment" class="a_d_c_comment" value="comment" <?php if ($ct == '1') { ?>checked="checked" <?php } ?>>  <?php echo _e('Leave a Comment'); ?>
            </div>
            <div class="a_d_c">
                <input type="checkbox" id="chked5" name="edit" class="a_d_c_edit" value="edit"<?php if ($et == '1') { ?>checked="checked" <?php } ?>><?php echo _e('Edit'); ?> 
            </div>
            <div class="a_d_c_submit">
                <i> <?php echo _e('Please select or unselect above and click on SUBMIT button'); ?></i><br><br>
                <input type="submit" name="a_d_c_submit" class="a_d_c_sub" value="<?php echo _e('Submit'); ?>"> 
            </div> 

        </form>
    </div>    

    <div class="donate_ad_plugin">
        <span><?php echo _e("If you're like this plugin, donate your small amount for encourage us"); ?></span>
        <form method="post" action="https://www.paypal.com/cgi-bin/webscr" target="_blank">
            <div class="paypal-donations">
                <input type="hidden" value="_donations" name="cmd">
                <input type="hidden" value="TipsandTricks_SP" name="bn">
                <input type="hidden" value="venugopalnakka@gmail.com" name="business">
                <input type="hidden" value="http://plugin.dev3.webenabled.net/thank-you/" name="return">
                <input type="hidden" value="Plugin Donation" name="item_name">
                <input type="hidden" value="0" name="rm">
                <input type="hidden" value="USD" name="currency_code">
                <input type="image" alt="PayPal - The safer, easier way to pay online." name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif">
                <img width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt="">
            </div>
        </form>
    </div>


    <?php
}

// Here plugin function end

/* Getting check box checked values from database plugin function outside  */
$au = get_option('radc_remove_author');
$da = get_option('radc_remove_date');
$ca = get_option('radc_remove_category');
$ct = get_option('radc_remove_comment');
$et = get_option('radc_remove_edit');


/* If Author check box checked REMOVED Author name under the post */
if ($au == '1') {
    add_action('wp_head', 'rm_author_css');

    function rm_author_css() {
        $author_out .="<style> .entry-footer .byline{ display:none !important; } </style>";
        $author_out .="<style> .entry-meta .byline{ display:none !important; } </style>";

        echo $author_out;
    }

}

/* If Date check box checked its REMOVED Date under the post */
if ($da == '1') {
    add_action('wp_head', 'rm_date_css');

    function rm_date_css() {
        $date_out .="<style> .entry-footer .posted-on{ display:none !important; } </style>";
        $date_out .="<style> .entry-meta .entry-date{ display:none !important; } </style>";
        $date_out .="<style> .entry-meta .date{ display:none !important; } </style>";
        echo $date_out;
    }

}

/* If Category check box checked its REMOVED Category name under the post */
if ($ca == '1') {
    add_action('wp_head', 'rm_category_css');

    function rm_category_css() {
        $category_out .="<style> .entry-footer .cat-links{ display:none !important; } </style>";
        $category_out .="<style> .entry-meta .cat-links{ display:none !important; } </style>";
        $category_out .="<style> .entry-meta .categories-links{ display:none !important; } </style>";
        echo $category_out;
    }

}

/* If Comment check box checked its REMOVED Comment Link under the post */
if ($ct == '1') {
    add_action('wp_head', 'rm_coment_css');

    function rm_coment_css() {
        $comment_out .="<style> .entry-footer .comments-link{ display:none !important; } </style>";
        $comment_out .="<style> .entry-meta .comments-link{ display:none !important; } </style>";
        echo $comment_out;
    }

}

/* If Edit check box checked its REMOVED Edit Link under the post */
if ($et == '1') {
    add_action('wp_head', 'rm_edit_css');

    function rm_edit_css() {
        $edit_out .="<style> .entry-footer .edit-link{ display:none !important; } </style>";
        $edit_out .="<style> .entry-meta .edit-link{ display:none !important; } </style>";
        echo $edit_out;
    }

}


/* By default check boxes checked on plugin activation */

function a_d_c_default_checked() {

    update_option('radc_remove_author', '1');
    update_option('radc_remove_date', '1');
    update_option('radc_remove_category', '1');
    update_option('radc_remove_comment', '1');
    update_option('radc_remove_edit', '1');
}

register_activation_hook(__FILE__, 'a_d_c_default_checked');
?>
