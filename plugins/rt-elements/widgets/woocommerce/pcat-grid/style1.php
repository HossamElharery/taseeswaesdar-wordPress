<div class=" rts-features-section">
    <div class="features-section-inner">
        <div class="row">
            <?php
            $pcats = $settings['rs_product_grid_categories'];
            foreach ($pcats as $pcat) {
                $catObj = get_term_by('slug', $pcat, 'product_cat');
                $term_id = $catObj->term_id;
                // get the thumbnail id using the category term_id
                $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
                $icon_id = get_term_meta($term_id, 'rt_pcat_icon_id', true);
                // get the image URL
                $pcat_image = wp_get_attachment_image_src($thumbnail_id, 'large')[0];
                $pcat_icon = wp_get_attachment_image_src($icon_id, 'large')[0];
                $pcat_bg = get_term_meta($term_id, 'pcat_grid_bg', true);
                if (!(empty($pcat_bg))) {
                    $pcat_single_bg = 'style="background-color: ' . $pcat_bg . ';"';
                } else {
                    $pcat_single_bg = '';
                }
                $pcat_btnc = get_term_meta($term_id, 'pcat_grid_btn_color', true);
                if (!(empty($pcat_btnc))) {
                    $cta_btn_color = 'style="color: ' . $pcat_btnc . ';"';
                    $cta_btn_hover_bg = 'style="background-color: ' . $pcat_btnc . ';"';
                } else {
                    $cta_btn_color = '';
                    $cta_btn_hover_bg = '';
                }
                $name   = $catObj->name;
                $desc   = $catObj->description;
                $count  = $catObj->count;
                $img    = $catObj->name;
                $pcat_link = get_term_link($pcat, 'product_cat');
                $icon_image = get_term_meta($term_id, 'rt_pcat_image', true);
                ?>

                <!-- ======================================================== -->


                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <?php if (!empty($pcat_image)) :   ?>
                            <a class="image-section" href="<?php echo esc_url($collection_link); ?>"><img src="<?php echo esc_url($pcat_image); ?>" alt="<?php echo esc_attr($name); ?>"></a>
                        <?php endif ?>
                        <div class="content">

                            <h3 class="product-name"><?php echo esc_html($name); ?></h3>
                            <div class="product-price">
                                <?php
                                    $product_count = $count;
                                    $collection_link = $pcat_link;
                                    ?>
                                <?php if (!empty($product_count)) :   ?>
                                    <a href="#" class="price"><?php echo esc_html($product_count); ?> <?php echo esc_html($settings['pcat_item_text']) ?></a>
                                <?php endif ?>
                                <?php if (!empty($collection_link)) :   ?>
                                    <a href="<?php echo esc_url($collection_link); ?>" class="add-to-cart"><?php echo esc_html($settings['pcat_btn_text']) ?></a>
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                </div>



                






            <?php
            }
            ?>
        </div>
    </div>
</div>