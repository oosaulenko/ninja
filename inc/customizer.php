<?php
/**
 * Mudita Theme Customizer.
 *
 * @package Mudita
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mudita_customize_register( $wp_customize ) {
	
    /* Option list of all post */	
    $options_posts = array();
    $options_posts_obj = get_posts( 'posts_per_page=-1' );
    $options_posts[''] = __( 'Choose Post', 'mudita' );
    foreach ( $options_posts_obj as $posts ) {
    	$options_posts[$posts->ID] = $posts->post_title;
    }
    
    /* Option list of all categories */
    $args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $option_categories = array();
    $category_lists = get_categories( $args );
    $option_categories[''] = __( 'Choose Category', 'mudita' );
    foreach( $category_lists as $category ){
        $option_categories[$category->term_id] = $category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'mudita' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'mudita' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    /** Default Settings Ends */
    
    /** Header Setting */
    $wp_customize->add_section(
        'mudita_header_settings',
        array(
            'title' => __( 'Контактная информация', 'mudita' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );

    /** Social Section Title */
    $wp_customize->add_setting(
        'mrowl_header_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_header_section_title',
        array(
            'label' => __( 'Заголовок блока', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );
    
    /** Header Phone */
    $wp_customize->add_setting(
        'mudita_header_phone',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mudita_header_phone',
        array(
            'label' => __( 'Телефон', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );
    /** Header Setting Ends */

    /** Header Mail */
    $wp_customize->add_setting(
        'mrowl_contact_email',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_contact_email',
        array(
            'label' => __( 'Email', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );

    /** Header Address */
    $wp_customize->add_setting(
        'mrowl_contact_address',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_contact_address',
        array(
            'label' => __( 'Адрес', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );

    /** Header Time */
    $wp_customize->add_setting(
        'mrowl_contact_time_day',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_contact_time_day',
        array(
            'label' => __( 'Дни работы', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );

    /** Header Time */
    $wp_customize->add_setting(
        'mrowl_contact_time',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_contact_time',
        array(
            'label' => __( 'Время работы', 'mudita' ),
            'section' => 'mudita_header_settings',
            'type' => 'text',
        )
    );
    /** Header Setting Ends */
    
    /** Home Page Settings */
    $wp_customize->add_panel( 
        'mudita_home_page_settings',
         array(
            'priority' => 55,
            'capability' => 'edit_theme_options',
            'title' => __( 'Главная страница', 'mudita' ),
            'description' => __( 'Customize Home Page Settings', 'mudita' ),
        ) 
    );
    
    /** Banner Section */
    $wp_customize->add_section(
        'mudita_about_settings',
        array(
            'title' => __( 'Блок О компании', 'mudita' ),
            'priority' => 20,
            'panel' => 'mudita_home_page_settings',
        )
    );

    $wp_customize->add_setting(
        'mrowl_about_image',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_about_image', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на баннер',
        'section' => 'mudita_about_settings',
        'settings' => 'mrowl_about_image'
    ) ) );
    
    /** Banner Title */
    $wp_customize->add_setting(
        'mrowl_about_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_about_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mudita_about_settings',
            'type' => 'text',
        )
    );

    /** Banner SubTitle */
    $wp_customize->add_setting(
        'mrowl_about_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_about_text',
        array(
            'label' => __( 'Текст', 'mudita' ),
            'section' => 'mudita_about_settings',
            'type' => 'textarea',
        )
    );
    /** Banner Section Ends */


    
    /** Sale Section */
    $wp_customize->add_section(
        'mrowl_advantages_settings',
        array(
            'title' => __( 'Блок Преимущества', 'mudita' ),
            'priority' => 30,
            'panel' => 'mudita_home_page_settings',
        )
    );

    $wp_customize->add_setting(
        'mrowl_advantages_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_advantages_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_advantages_settings',
            'type' => 'textarea',
        )
    );


    /** Sale Section Ends */

    /** Training Section */
    $wp_customize->add_section(
        'mrowl_cheap_settings',
        array(
            'title' => __( 'Блок Почему дешево', 'mudita' ),
            'priority' => 30,
            'panel' => 'mudita_home_page_settings',
        )
    );

    $wp_customize->add_setting(
        'mrowl_cheap_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_cheap_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_cheap_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_cheap_title_1',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_cheap_title_1',
        array(
            'label' => __( 'Первое преимущество', 'mudita' ),
            'section' => 'mrowl_cheap_settings',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_cheap_image_1',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_cheap_image_1', array(
        'label' => 'Выбор изображения',
        'section' => 'mrowl_cheap_settings',
        'settings' => 'mrowl_cheap_image_1'
    ) ) );

    //////

    $wp_customize->add_setting(
        'mrowl_cheap_title_2',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_cheap_title_2',
        array(
            'label' => __( 'Второе преимущество', 'mudita' ),
            'section' => 'mrowl_cheap_settings',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_cheap_image_2',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_cheap_image_2', array(
        'label' => 'Выбор изображения',
        'section' => 'mrowl_cheap_settings',
        'settings' => 'mrowl_cheap_image_2'
    ) ) );

    /** Training Section Ends */


    /** Video Section */
    $wp_customize->add_section(
        'mrowl_video_settings',
        array(
            'title' => __( 'Блок Видео', 'mudita' ),
            'priority' => 30,
            'panel' => 'mudita_home_page_settings',
        )
    );

    $wp_customize->add_setting(
        'mrowl_video_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_video_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_video_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_video_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_video_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_video_settings',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_video_button',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_video_button',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_video_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_video_image',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_video_image', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на баннер с видео',
        'section' => 'mrowl_video_settings',
        'settings' => 'mrowl_video_image'
    ) ) );

    $wp_customize->add_setting(
        'mrowl_video_button_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_video_button_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_video_settings',
            'type' => 'dropdown-pages'
        )
    );

    /** Video Section Ends */

    /** Articles Section */
    $wp_customize->add_section(
        'mrowl_articles_settings',
        array(
            'title' => __( 'Блок Статей', 'mudita' ),
            'priority' => 30,
            'panel' => 'mudita_home_page_settings',
        )
    );

    $wp_customize->add_setting(
        'mrowl_articles_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_articles_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_articles_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_articles_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_articles_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_articles_settings',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_articles_button',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_articles_button',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_articles_settings',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_articles_button_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_articles_button_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_articles_settings',
            'type' => 'dropdown-pages'
        )
    );

    /** Articles Section Ends */

    /** Home Page Settings Ends */

    $wp_customize->add_panel(
        'mrowl_catalog_setting',
        array(
            'priority' => 58,
            'capability' => 'edit_theme_options',
            'title' => __( 'Каталог', 'mudita' ),
            'description' => __( 'Customize Home Page Settings', 'mudita' ),
        )
    );

    /** Catalog Princess */

    $wp_customize->add_section(
        'mrowl_catalog_princess',
        array(
            'title' => __( 'Принцесса', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_princess_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_princess_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_princess',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_princess_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_princess_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_princess',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_princess_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_princess_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_princess',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_princess_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_princess_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_princess',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_princess_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_princess_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_princess',
        'settings' => 'mrowl_catalog_princess_img'
    ) ) );

    $wp_customize->add_setting(
        'mrowl_catalog_princess_img_2',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_princess_img_2', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_princess',
        'settings' => 'mrowl_catalog_princess_img_2'
    ) ) );

    /** End Catalog Princess */


    /** Catalog Empire */

    $wp_customize->add_section(
        'mrowl_catalog_empire',
        array(
            'title' => __( 'Ампир', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_empire_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_empire_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_empire',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_empire_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_empire_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_empire',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_empire_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_empire_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_empire',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_empire_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_empire_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_empire',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_empire_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_empire_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_empire',
        'settings' => 'mrowl_catalog_empire_img'
    ) ) );

    /** End Catalog Empire */

    /** Catalog mermaid */

    $wp_customize->add_section(
        'mrowl_catalog_mermaid',
        array(
            'title' => __( 'Русалка', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_mermaid_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_mermaid_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_mermaid',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_mermaid_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_mermaid_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_mermaid',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_mermaid_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_mermaid_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_mermaid',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_mermaid_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_mermaid_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_mermaid',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_mermaid_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_mermaid_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_mermaid',
        'settings' => 'mrowl_catalog_mermaid_img'
    ) ) );

    /** End Catalog mermaid */

    /** Catalog short */

    $wp_customize->add_section(
        'mrowl_catalog_short',
        array(
            'title' => __( 'Короткое', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_short_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_short_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_short',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_short_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_short_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_short',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_short_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_short_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_short',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_short_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_short_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_short',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_short_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_short_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_short',
        'settings' => 'mrowl_catalog_short_img'
    ) ) );

    $wp_customize->add_setting(
        'mrowl_catalog_short_img_2',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_short_img_2', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_short',
        'settings' => 'mrowl_catalog_short_img_2'
    ) ) );

    /** End Catalog short */


    /** Catalog cuddly */

    $wp_customize->add_section(
        'mrowl_catalog_cuddly',
        array(
            'title' => __( 'Пышное', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cuddly_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cuddly_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_cuddly',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cuddly_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cuddly_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_cuddly',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cuddly_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cuddly_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_cuddly',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cuddly_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cuddly_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_cuddly',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cuddly_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_cuddly_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_cuddly',
        'settings' => 'mrowl_catalog_cuddly_img'
    ) ) );

    /** End Catalog cuddly */

    /** Catalog direct */

    $wp_customize->add_section(
        'mrowl_catalog_direct',
        array(
            'title' => __( 'Прямое', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_direct_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_direct_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_direct',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_direct_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_direct_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_direct',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_direct_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_direct_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_direct',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_direct_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_direct_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_direct',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_direct_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_direct_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_direct',
        'settings' => 'mrowl_catalog_direct_img'
    ) ) );

    $wp_customize->add_setting(
        'mrowl_catalog_direct_img_2',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_direct_img_2', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_direct',
        'settings' => 'mrowl_catalog_direct_img_2'
    ) ) );

    /** End Catalog direct */

    /** Catalog cocktail */

    $wp_customize->add_section(
        'mrowl_catalog_cocktail',
        array(
            'title' => __( 'Коктейльное', 'mudita' ),
            'priority' => 0,
            'capability' => 'edit_theme_options',
            'panel' => 'mrowl_catalog_setting'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cocktail_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cocktail_title',
        array(
            'label' => __( 'Заголовок', 'mudita' ),
            'section' => 'mrowl_catalog_cocktail',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cocktail_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cocktail_text',
        array(
            'label' => __( 'Описание', 'mudita' ),
            'section' => 'mrowl_catalog_cocktail',
            'type' => 'textarea',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cocktail_linktext',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cocktail_linktext',
        array(
            'label' => __( 'Название кнопки', 'mudita' ),
            'section' => 'mrowl_catalog_cocktail',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cocktail_link',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'mrowl_catalog_cocktail_link',
        array(
            'label' => __( 'Страница', 'mudita' ),
            'section' => 'mrowl_catalog_cocktail',
            'type' => 'dropdown-pages'
        )
    );

    $wp_customize->add_setting(
        'mrowl_catalog_cocktail_img',
        array(
            'default' => ''
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mrowl_catalog_cocktail_img', array(
        'label' => 'Выбор изображения',
        'description' => 'Выберете изображение, которое вы хотите поставить на эту категорию',
        'section' => 'mrowl_catalog_cocktail',
        'settings' => 'mrowl_catalog_cocktail_img'
    ) ) );

    /** End Catalog cocktail */



    /**************************** */
    
    /** Social Settings */
    $wp_customize->add_section(
        'mudita_social_settings',
        array(
            'title' => __( 'Социальные сети', 'mudita' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Social Section Title */
    $wp_customize->add_setting(
        'mrowl_social_section_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_social_section_title',
        array(
            'label' => __( 'Social Section Title', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'mrowl_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_facebook',
        array(
            'label' => __( 'Facebook', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );

    /** Вконтакте */
    $wp_customize->add_setting(
        'mrowl_vk',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_vk',
        array(
            'label' => __( 'Вконтакте', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Skype */
    $wp_customize->add_setting(
        'mrowl_skype',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_skype',
        array(
            'label' => __( 'Skype', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** OK */
    $wp_customize->add_setting(
        'mrowl_odnoklasniki',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_odnoklasniki',
        array(
            'label' => __( 'Одноклассники', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Gooble Plus */
    $wp_customize->add_setting(
        'mrowl_gplus',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_gplus',
        array(
            'label' => __( 'Google Plus', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** Instagram */
    $wp_customize->add_setting(
        'mrowl_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_instagram',
        array(
            'label' => __( 'Instagram', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    
    /** YouTube */
    $wp_customize->add_setting(
        'mrowl_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'mudita_sanitize_url',
        )
    );
    
    $wp_customize->add_control(
        'mrowl_youtube',
        array(
            'label' => __( 'YouTube', 'mudita' ),
            'section' => 'mudita_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
    /** Custom CSS*/
//    $wp_customize->add_section(
//        'mudita_custom_settings',
//        array(
//            'title' => __( 'Custom CSS Settings', 'mudita' ),
//            'priority' => 50,
//            'capability' => 'edit_theme_options',
//        )
//    );
    
    $wp_customize->add_setting(
        'mudita_custom_css',
        array(
            'default' => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'mudita_sanitize_css'
            )
    );
    
//    $wp_customize->add_control(
//        'mudita_custom_css',
//        array(
//            'label' => __( 'Custom Css', 'mudita' ),
//            'section' => 'mudita_custom_settings',
//            'description' => __( 'Put your custom CSS', 'mudita' ),
//            'type' => 'textarea',
//        )
//    );
    /** Custom CSS Ends */

    
    /**
     * Sanitization Functions
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php 
     */
     function mudita_sanitize_checkbox( $checked ){
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
     }
     
     function mudita_sanitize_select( $input, $setting ){
        // Ensure input is a slug.
    	$input = sanitize_key( $input );
    	
    	// Get list of choices from the control associated with the setting.
    	$choices = $setting->manager->get_control( $setting->id )->choices;
    	
    	// If the input is a valid key, return it; otherwise, return the default.
    	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
     }
     
     function mudita_sanitize_url( $url ){
        return esc_url_raw( $url );
     }
     
     function mudita_sanitize_css( $css ){
    	return wp_strip_all_tags( $css );
     }
 
}
add_action( 'customize_register', 'mudita_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mudita_customize_preview_js() {
	wp_enqueue_script( 'mudita_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'mudita_customize_preview_js' );
