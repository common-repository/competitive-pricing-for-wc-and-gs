<?php

    // If this file is called directly, abort.
    if (! defined('WPINC')) {
       die;
    }
    // - the hidden field in the form search needs to be changed to the new dashboard page slug
    // - find shorthand for blank

    echo '<h1 style="text-align: center;">Product Plugin Dashboard</h1>';

?>

<style>
    .api-form, .api-div-admin-notice {
        padding: 10px;
        border: 1px solid #d8d8d8;
        background: #fff;
        margin: auto;
        display: block;
        width: 1000px;
        max-width: 100%;
    }
    .api-total-products {
        padding: 10px;
        border: 1px solid #d8d8d8;
        background: #fff;
        border-radius: 5px;
        width: 125px;
        text-align: center;
    }
    .api-div-admin-notice hr {
        margin: 10px auto;
    }
    .api-div-admin-notice {
        max-width: 100%;
        width: 850px;
        margin: auto;
        display: block;
        font-size: 16px;
        line-height: 22px;
    }
    .api-form-action {
        width: 400px;
        max-width: 100%;
        float: left;
    }
    .api-form .button {
        background: #33363B;
        color: #fff;
    }
    .api-table-dashboard-forms, .api-dashboard-table {
        width: 90%;
        max-width: 1600px;
        margin: 25px auto;
    }
    .api-dashboard-table {
        background: #fff;
        border: 1px solid #d8d8d8;
    }
    .api-dashboard-table th, .api-dashboard-table td {
        border: 1px solid #d8d8d8 !important;
        padding: 5px 15px;
    }
    .div-navigation {
        margin: auto !important;
        display: block;
        width: 1200px;
        max-width: 100%;
    }
    .div-navigation a {
        padding: 10px;
        border: 1px solid #d8d8d8;
        background: #fff;
        margin: auto 10px;
    }
    .tooltip {
        position: relative;
        display: inline;
        border: 1px solid #d8d8d8;
        border-radius: 50px;
        padding: 5px 2.5px 5px 5px;
        margin: 5px;
        background: #fff;
    }
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 200px;
        background-color: #fff;
        border: 1px solid #d8d8d8;
        color: #33363B;
        padding: 10px;
        border-radius: 6px;

        /* Position the tooltip text - see examples below! */
        position: absolute;
        z-index: 1;
    }
    .tooltip:hover .tooltiptext {
        visibility: visible;
    }
    .api-update-stats-div {
        width: 90%;
        max-width: 1650px;
        margin: 25px auto;
    }
    .api-update-report-table {
        margin: 25px auto;
    }
    .api-update-report-table td {
        border: 1px solid #d8d8d8;
        background: #fff;
        padding: 10px;
    }
    .api-update-div {
        padding: 10px;
        border: 1px solid #d8d8d8;
        border-radius: 10px;
        background: #f8f8f8;
        min-height: 150px;
    }
</style>

    <div class="api-update-stats-div">
        <?php
            if (isset($_POST['get_update_stats'])) {
                if (isset($_POST['nonce_update_stats'])) {
                    $nonce_update_stats = $_POST['nonce_update_stats'];
                } else {
                    $nonce_update_stats = false;
                }
                if (!wp_verify_nonce($nonce_update_stats, 'action_updat_stats')) {
                    wp_die('The nonce submitted by the form is incorrect! Please refresh the page and try again.');
                } else {
                    api_pp_get_update_totals();
                }
            }
        ?>
    </div>
    <center><h3>Please Note: This is the reporting version of the plugin.  For the full version, please contact us. <a href="https://www.apigenius.io" target="_blank">API Genius</a></h3></center>
    <div class='wrap'>
        <table>
            <tr>
                <td width="70%">
                    <form class="api-form api-form-search" action="/wp-admin/admin.php" method="get">
                        <input type="hidden" name="page" value="api-pp-dashboard" />
                        <input value="<?php if(isset($_GET['keyword'])) { echo $keyword = esc_html($_GET['keyword']); } else { $keyword = ''; } ?>" type="text" name="keyword" placeholder="Keyword">
                        <input value="<?php if(isset($_GET['product_id'])) { echo $product_id_search = esc_html($_GET['product_id']); } else { $product_id_search = ''; } ?>" type="text" name="product_id" placeholder="Product ID">
                        <select name="ad_rank_search">
                            <option value="<?php if(isset($_GET['ad_rank_search'])) { echo $ad_rank_search = esc_html($_GET['ad_rank_search']); } else { $ad_rank_search = ''; } ?>">
                                <?php
                                    if($ad_rank_search !== '') {
                                        echo esc_html(ucwords($ad_rank_search));
                                    } else {
                                        echo 'Ad Rank';
                                    }
                                ?>
                            </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="no_advertisers">No Advertisers</option>
                        </select>
                        <select name="status">
                            <option value="<?php if(isset($_GET['status'])) { echo $status = esc_html($_GET['status']); } else { $status = ''; } ?>">
                                <?php
                                    if($status !== '') {
                                        echo esc_html(ucwords($status));
                                    } else {
                                        echo 'Update Status';
                                    }
                                ?>
                            </option>
                            <option value="finished">Updated</option>
                            <option value="new">Queued</option>
                            <option value="never">Never Updated</option>
                            <option value="failed">Failed</option>
                            <option value="not_found">Not Found</option>
                            <option value="no_cost">No Cost</option>
                        </select>
                        <select name="advertise">
                            <option value="<?php if(isset($_GET['advertise'])) { echo $advertise = esc_html($_GET['advertise']); } else { $advertise = ''; } ?>">
                                <?php
                                    if($advertise !== '') {
                                        if($advertise == 'yes') {
                                            echo 'Yes';
                                        } elseif($advertise == 'no') {
                                            echo 'No';
                                        }
                                    } else {
                                        echo 'Advertising';
                                    }
                                ?>
                            </option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                            <option value="no_advertisers">No Other Advertisers</option>
                        </select>
                        <select name="sort_by">
                            <option value="<?php if(isset($_GET['sort_by'])) { echo $sort_by = esc_html($_GET['sort_by']); } else { $sort_by = ''; } ?>">
                                <?php
                                    if($sort_by !== '') {
                                        if($sort_by == 'modified') {
                                            echo 'Modified';
                                        } elseif($sort_by == 'id') {
                                            echo 'ID';
                                        }
                                    } else {
                                        echo 'Sort By';
                                        $sort_by = 'modified';
                                    }
                                ?>
                            </option>
                            <option value="modified">Modified</option>
                            <option value="id">ID</option>
                        </select>
                        <select name="per_page">
                            <option value="<?php if(isset($_GET['per_page'])) { echo $per_page = esc_html($_GET['per_page']); } else { $per_page = 10; } ?>">
                                <?php
                                    if($per_page !== '') {
                                        echo esc_html($per_page);
                                    } else {
                                        echo 'Per Page';
                                    }
                                ?>
                            </option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                        </select>
                        <br /><br />
                        <input class="button" name="SearchProducts" type="submit" value="Search">
                        <a class="button" href="/wp-admin/admin.php?page=api-pp-dashboard">Clear Search</a>
                    </form>
                </td>
                <td width="10%"></td>
                <td width="20%">

                </td>
            </tr>
        </table>
    </div>

    <!-- Check box javascript -->
    <script language="JavaScript">
        function selectAll(source) {
            checkboxes = document.getElementsByClassName('check-box');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }
    </script>

    <table style="font-size: 12px;" class="api-dashboard-table widefat">
        <thead>
            <th width="5%"><input type="checkbox" id="selectall" onClick="selectAll(this)" /></th>
            <th width="20%">Status</th>
            <th>Data</th>
            <thwidth="45%"></th>
        </thead>

<?php

    // Process the update action
    $current_product_search = get_option('api_pp_search');

    if(isset($_POST['UpdateAction'])) {
        echo '<div class="api-div-admin-notice">';
        foreach ($current_product_search as $product_id) {
            $products_checked = 'update_product_' . $product_id;
            if(isset($_POST[$products_checked])) {
                if($update_action == 'pricing_data') {
                    if(isset($_POST['identifier_type_submitted'])) {
                        $identifier_type_submitted = $_POST['identifier_type_submitted'];
                        api_pp_get_pricing_data($product_id, $identifier_type_submitted);
                    } else {
                        api_pp_get_pricing_data($product_id, $identifier_type_submitted = 'auto');
                    }
                } elseif($update_action == 'pricing_data_get') {
                    api_pp_request_pricing_data($product_id);
                } elseif($update_action == 'lowest_price') {
                    api_pp_update_lowest_price($product_id);
                }
                echo '<hr />';
            }
        }
        echo '</div>';
    }

    // Page the results
    $paged = isset($_GET['paged']) ? absint($_GET['paged']) : 1;

    // Base query args
    $query_args = array(
        'post_type'			          =>	'product',
        'paged'                       =>    $paged,
        'post_status'                 =>    'publish',
        'posts_per_page'              =>    $per_page
  );

    $meta_args_all = [];
    $status_args = [];

    if ($product_id_search !== '') {
        $product_id_args = array(
            'p' => $product_id_search
      );
        $query_args = array_merge($query_args, $product_id_args);
    }

    if ($keyword !== '') {
        $product_id_args = array(
            's' => $keyword
    );
       $query_args = array_merge($query_args, $product_id_args);
    }

    // advertise search
    if($advertise !== '') {
        if($advertise == 'yes') {
            $advertise_args = array(
                'meta_key' => 'api_pp_advertise',
                'meta_value' => 'yes',
                'meta_compare' => '=',
          );
        } elseif($advertise == 'no') {
            $advertise_args = array(
                'meta_key' => 'api_pp_advertise',
                'meta_value' => 'no',
                'meta_compare' => '=',
          );
        }
        $query_args = array_merge($query_args, $advertise_args);
    }

    if($ad_rank_search !== '') {
        $ad_rank_search_args = array(
            'meta_key' => 'api_pp_ad_rank',
            'meta_value' => $ad_rank_search,
            'meta_compare' => '=',
        );
        $query_args = array_merge($query_args, $ad_rank_search_args);
    }

    // search by update status
    if($status !== '') {
        if($status == 'finished') {
            $status_args = array(
                'meta_key' => 'api_pp_job_status',
                'meta_value' => 'finished',
                'meta_compare' => '=',
          );
        } elseif($status == 'new') {
            $status_args = array(
                'meta_key' => 'api_pp_job_status',
                'meta_value' => 'new',
                'meta_compare' => '=',
          );
        } elseif($status == 'never') {
            $status_args = array(
                'meta_key' => 'api_pp_job_status',
                'meta_compare' => 'NOT EXISTS',
          );
        } elseif($status == 'failed') {
            $status_args = array(
                'meta_key' => 'api_pp_job_status',
                'meta_value' => 'failed',
                'meta_compare' => '=',
          );
      } elseif($status == 'not_found') {
            $status_args = array(
                'meta_key' => 'api_pp_job_status',
                'meta_value' => 'not found',
                'meta_compare' => '=',
          );
      } elseif($status == 'no_cost') {
              $status_args = array(
                  'meta_key' => '_alg_wc_cog_cost',
                  'meta_value' => '',
                  'meta_compare' => '!=',
            );
          }
        $query_args = array_merge($query_args, $status_args);
    }

    // If a keyword was provided, include in query
    $sort_by_args = array(
        'orderby' => $sort_by,
        'order' => 'desc',
    );
    $query_args = array_merge($query_args, $sort_by_args);

    $the_query = new WP_Query($query_args);

    // plugin options
    $plugin_options = wp_parse_args(get_option('api_pp_options'), api_pp_default_options());
    $all_product_ids = [];

    if($the_query->have_POSTs()) {

        $total_products = $the_query->found_posts;
        echo '<h4 class="api-total-products">Total Products: ' . esc_html($total_products) . '</h4>';

        while ($the_query->have_POSTs()) {
            $the_query->the_POST();
            global $product;
            $product_id = $product->get_id();
            $product_cost = get_post_meta($product_id, '_alg_wc_cog_cost', true);
            // save the product ids
            array_push($all_product_ids, $product_id);
            update_option('api_pp_search', $all_product_ids);
            // product status
            $status = get_post_meta($product_id, 'api_pp_job_status', true);
            $status_text = '';
            if($status == '') {
                $status_text = 'Never Updated';
            } elseif($status == 'new') {
                $status_text = 'Queued';
            } elseif($status == 'finished') {
                $status_text = 'Updated';
            } elseif($status == 'failed') {
                $status_text = 'Failed';
            } elseif($status == 'skipped') {
                $status_text = 'Skipped';
            } elseif($status == 'not found') {
                $status_text = 'Not Found';
            } elseif ($status == 'exceeded_max_price') {
                $status_text = 'Exceeded Max Price';
            }
            if ($product_cost == 'no_cost') {
                $status_text = 'No Cost';
            }

            $product_image_url = get_the_post_thumbnail_url($product_id);
            if(! $product_image_url) {
                $product_image_url= get_post_meta($product_id, 'fifu_image_url', true);
            }
            $last_updated = get_post_meta($product_id, 'api_pp_last_updated', true);

            // get product $identifiers
            $sku = get_post_meta($product_id, '_sku', true);

            ?>
                <tr>
                    <td><input class="check-box" type="checkbox" name="update_product_<?php echo $product_id; ?>" value="<?php echo $product_id; ?>"></td>
                    <td>
                        <?php
                            echo esc_html($status_text);
                            if(($status_text) && ($last_updated)) {
                                echo '<br />' . esc_html($last_updated);
                            }
                        ?>
                    </td>
                    <td></td>
                    <td>
                        <?php
                            if ($product_image_url) {
                                echo '<img style="border: 1px solid #d8d8d8" src="' . esc_url($product_image_url) . '" class="alignright" height="100px" width="auto">';
                            }
                        ?>
                        <a href="<?php echo get_permalink($product_id); ?>" target="_blank"><?php echo get_the_title($product_id); ?></a> - <a href="/wp-admin/post.php?post=<?php echo esc_html($product_id); ?>&action=edit" target="_blank"><u>Edit Page</u></a>
                        <br />
                        <strong>Product ID: </strong> <a href="/wp-admin/admin.php?page=api-pp-dashboard&keyword&product_id=<?php echo $product_id; ?>&status&sort_by&per_page&SearchProducts=Search" target="_blank"><?php echo esc_html($product_id); ?></a>
                        <br />
                        <h4 style="margin: 10px auto 0px">Identifiers</h4>
                    </td>
                </tr>
            <?php
        }
    }

    // Reset Query
    wp_reset_query();

    ?>

        </tr>
    </table>

    <!-- Pagination html -->
    <div class="div-navigation tablenav">
        <div class="alignleft tablenav-pages">
              <?php
                  $base = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));
                  $base = htmlspecialchars_decode($base);
                  echo paginate_links(array(
                      'base'         => $base,
                      'total'        => $the_query->max_num_pages,
                      'current'      => $paged,
                      'format'       => '?page=%#%',
                      'show_all'     => false,
                      'type'         => 'plain',
                      'end_size'     => 2,
                      'mid_size'     => 1,
                      'prev_next'    => false,
                      'prev_text'    => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                      'next_text'    => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                      'add_args'     => false,
                      'add_fragment' => '',
                ));
              ?>
            </nav>
        </div>
    </div>
