<?php
/**
 * Template Name: Главная страница
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mr.OWL
 */

get_header();
//$main_pages = get_the_ID();
?>

<div id="l-page">
    <section class="main_fullpage">
        <section class="section section-1 section-products" data-anchor="products">
            <div class="block_products">
                <?php
                function translit($str) {
                    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
                    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
                    return str_replace($rus, $lat, $str);
                }

                $paramss = array(
                    'posts_per_page'    => 12,
                    'post_type'         => 'product',
//                    'orderby'           => 'ID',
                    'product_cat'    => 'main'
//                    'tag_id'     => 14,
//                    'order' => 'DESC'
                );

                $query = new WP_Query($paramss);

                while($query->have_posts()): $query->the_post(); ?>
                    <?php
                    global $product;

                    $image = get_post_meta($post->ID, 'photo_persona', true);
                    $images = wp_get_attachment_image($image, 'full');
                    ?>
                    <div class="item carousel-cell" style="background-color: <?php echo get_post_meta($post->ID, 'color', true); ?>">
                        <div class="inner">
                            <div class="image">
                                <?php print $images; ?>
                            </div>
                            <?php
                            $image = get_post_meta($post->ID, 'photo_pizza', true);
                            $images = wp_get_attachment_image($image, 'full');
                            ?>
                            <div class="pizza"><?php print $images; ?></div>
                            <div class="block_info">
                                <div class="title"><?php the_title(); ?></div>
                                <div class="ingridients">
                                    <div class="name">Состав:</div>
                                    <div class="items">
                                        <?php
                                        foreach (get_post_meta( $post->ID, 'ingredients', true ) as $item){
                                            ?>
                                            <div class="element">
                                                <div class="inner-element">
                                                    <img src="<?php print get_template_directory_uri(); ?>/img/icon_ingridient/<?php print translit(mb_strtolower($item));?>.png" alt="<?php print translit(mb_strtolower($item));?>">
                                                    <span class="name"><?php print $item; ?></span>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="view">
                                    <input type="hidden" class="productID" value="<?php print $product->id; ?>">
                                   <div class="view-inner">
                                       <?php
                                       $tickets = new WC_Product_Variable( $product->id);
                                       $variables = $tickets->get_available_variations();

                                       foreach ($variables as $key => $variable){
                                           ?>
                                           <div class="view-item">
                                               <?php if($key == 0): ?>
                                                   <input type="radio" class="typePizza with-gap" id="typePizza_<?php print $variable['variation_id']; ?>" name="typePizza_<?php print $post->ID; ?>" value="<?php print $variable['variation_id']; ?>" checked>
                                                   <?php
                                                   $variable_default = $variable['variation_id'];
                                                   ?>
                                               <?php else: ?>
                                                   <input type="radio" class="typePizza with-gap" id="typePizza_<?php print $variable['variation_id']; ?>" name="typePizza_<?php print $post->ID; ?>" value="<?php print $variable['variation_id']; ?>">
                                               <?php endif; ?>
                                               <label for="typePizza_<?php print $variable['variation_id']; ?>">
                                                   <span class="dimensions"><?php print str_replace("cm", "<b>см</b>", $variable['dimensions']); ?></span>
                                                   <span class="weight"><?php print str_replace("g", "<b>гр.</b>", $variable['weight']); ?></span>
                                                   <span class="display_price"><b><?php print $variable['display_price']; ?></b> грн.</span>
                                               </label>
                                           </div>
                                           <?php
                                       }
                                       ?>
                                   </div>
                                </div>
                                <div class="bottom">
                                    <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>">
                                        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                                        <?php
                                        if ( ! $product->is_sold_individually() ) {
                                            woocommerce_quantity_input( array(
                                                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
                                                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
                                                'input_value' => 1
                                            ) );
                                        }
                                        ?>

                                        <input type="hidden" name="add-to-cart" class="productIDhidden" value="<?php echo esc_attr( $variable_default ); ?>" />
                                        <button type="submit" class="single_add_to_cart_button button alt">В коробку</button>
                                        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_query();
                ?>

            </div>
        </section>

        <section class="section section-2 section-sale" data-anchor="sale">
            <div class="block_sale">
                <?php
                $sale_gallery = get_post_meta( 18, 'sale_gallery', true );

                if( have_rows('sale_gallery', 135) ):
                    while ( have_rows('sale_gallery', 135) ) : the_row(); ?>
                        <div class="slide-item" style="background-image: url('<?php the_sub_field('desc_image'); ?>');"></div>
                    <?php endwhile;
                endif;
                ?>
            </div>
        </section>

        <?php
        $meta_values = get_post_meta( 18, 'random_image', true );
        $src_image_about = wp_get_attachment_image_src($meta_values, 'full');
        ?>
        <section class="section section-3 section-random" data-anchor="random">
            <div class="block_random" style="background-image: url('<?php print $src_image_about[0]; ?>');">
                <div class="block_image"></div>
                <div class="block_info">
                    <div id="l-inner">
                        <div class="info_random">
                            <h2 class="title_section">
                                <b>Ninja</b>
                                <span>Рандом</span>
                            </h2>
                            <div class="info">
                                <?php the_field('random_txt', 18); ?>
                            </div>
                            <form class="variations_form cart" method="post" enctype="multipart/form-data" data-product_id="100">
                                <div class="quantity">
                                    <span class="input-number-decrement">–</span>
                                    <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Кол-во" class="input-text qty text input-number" size="4" pattern="[0-9]*" inputmode="numeric">
                                    <span class="input-number-increment">+</span>
                                </div>
                                <input type="hidden" name="add-to-cart" class="productIDhiddenRandom" value="0">
                                <button type="submit" class="single_add_to_cart_button button alt" id="buttonRandomHidden">Получить рандомную пиццу</button>
                            </form>
                            <button class="button alt" id="buttonRandom">Получить рандомную пиццу</button>
                        </div>
                    </div>
                </div>
                <div class="block_overflow">
                    <div class="overflow-inner"></div>
                </div>
            </div>
        </section>

        <?php
        $src_image_about = get_post_meta( 18, 'construct_image', true );
        $src_image_about = wp_get_attachment_image_src($src_image_about, 'full');
        ?>
        <section class="section section-4 section-constuct" data-anchor="constuct" style="background-image: url(<?php print $src_image_about[0]; ?>);">
            <div id="l-inner">
                <div class="block_construct">
                    <div class="info_construct">
                        <h2 class="title_section">
                            <b>Ninja</b>
                            <span>Конструктор</span>
                        </h2>
                        <div class="info">
                            <?php the_field('construct_txt', 18); ?>
                        </div>
                        <a href="<?php print the_permalink(33);?>" class="button">Перейти к конструктору</a>
                        <div class="bottom"></div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $src_image_about = get_post_meta( 18, 'reviews_image', true );
        $src_image_about = wp_get_attachment_image_src($src_image_about, 'full');
        ?>
        <section class="section section-5 section-reviews" data-anchor="reviews" style="background-image: url(<?php print $src_image_about[0]; ?>);">
            <div id="l-inner">
                <h2 class="title_section">
                    <b>Ninja</b>
                    <span>Отзывы</span>
                </h2>
                <div class="block_reviews">
                    <?php
                    $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $params = array(
                        'posts_per_page' => 10,
                        'post_type'       => 'post_reviews',
                        'paged'           => $current_page
                    );
                    query_posts($params);

                    $wp_query->is_archive = true;
                    $wp_query->is_home = false;

                    while(have_posts()): the_post(); ?>
                        <div class="item">
                            <div class="image">
                                <?php if(has_post_thumbnail()): ?>
                                    <?php echo the_post_thumbnail('review_img'); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon/noimg.png">
                                <?php endif;?>
                            </div>
                            <div class="name"><?php the_title(); ?></div>
                            <div class="other"><?php echo get_post_meta($post->ID, 'fields_other', true); ?></div>
                            <div class="text"><?php the_content(); ?></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    </section>
</div>

<?php get_footer(); ?>
