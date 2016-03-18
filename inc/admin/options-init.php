<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_wpsp";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'redux_wpsp',
        'use_cdn' => TRUE,
        'display_name' => 'Theme Options',
        'display_version' => '1.0.0',
        'page_title' => 'Theme Options',
        'update_notice' => TRUE,
        'intro_text' => '<p>This text is displayed above the options panel. It isn\’t required, but more info is always better! The intro_text field accepts all HTML.</p>’',
        'footer_text' => '<p>This text is displayed below the options panel. It isn\’t required, but more info is always better! The footer_text field accepts all HTML.</p>',
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Theme Options',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'global_variable' => 'redux_wpsp',
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> OTHER VARIABLE
     */

    $entry_meta_choices = array(
        'date'       => esc_html__( 'Date', 'redux-framework-wpsp' ),
        'author'     => esc_html__( 'Author', 'redux-framework-wpsp' ),
        'categories' => esc_html__( 'Categories', 'redux-framework-wpsp' ),
        'comments'   => esc_html__( 'Comments', 'redux-framework-wpsp' ),
    );

    /*
     * ---> END OTHER VARIABLE
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-wpsp' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-wpsp' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-wpsp' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-wpsp' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-wpsp' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    // Blog section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog', 'redux-framework-wpsp' ),
        'id'               => 'blog-options',
        'desc'             => __( '', 'redux-framework-wpsp' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-file-edit'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'redux-framework-wpsp' ),
        'id'         => 'blog-general-option',
        'subsection' => true,
        //'desc'       => __( 'Use for any post that do not have post featured image with landscape, portrait and square', 'redux-framework-wpsp' ),
        'fields'     => array(
            array(
                'id'       => 'blog-cats-exclude',
                'type'     => 'text',
                'title'    => __( 'Exclude Categories From Blog', 'redux-framework-wpsp' ),
                'subtitle' => __( 'Enter the ID\'s of categories to exclude from the blog template or homepage blog seperated by a comma (no spaces).', 'redux-framework-wpsp' ),
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Single', 'redux-framework-wpsp' ),
        'id'         => 'blog-single-option',
        'subsection' => true,
        //'desc'       => __( 'Use for any post that do not have post featured image with landscape, portrait and square', 'redux-framework-wpsp' ),
        'fields'     => array(
            array(
                'id'       => 'blog-post-meta-sections',
                'type'     => 'checkbox',
                'title'    => __( 'Meta', 'redux-framework-wpsp' ),
                'subtitle' => __( 'checked meta filed to be display', 'redux-framework-wpsp' ),
                'options'  => $entry_meta_choices
            ),
        )
    ) );

    // Placeholder section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Placeholder', 'redux-framework-wpsp' ),
        'id'               => 'placeholder-options',
        'desc'             => __( '', 'redux-framework-wpsp' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-picture'
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => __( 'General', 'redux-framework-wpsp' ),
        'id'         => 'placehodler-option',
        'subsection' => true,
        'desc'       => __( 'Use for any post that do not have post featured image with landscape, portrait and square', 'redux-framework-wpsp' ),
        'fields'     => array(
            array(
                'id'       => 'landscape-placeholder',
                'type'     => 'media',
                'title'    => __( 'Landscape Placeholder', 'redux-framework-wpsp' ),
                'subtitle' => __( 'Use for any post that do not have post featured image.', 'redux-framework-wpsp' ),
                'desc'     => __( 'Recommended size 960px by 625px', 'redux-framework-wpsp' ),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/images/thumbnail-landscape.gif'
                    )
            ),
            array(
                'id'       => 'portrait-placeholder',
                'type'     => 'media',
                'title'    => __( 'Portrait Placeholder', 'redux-framework-wpsp' ),
                'subtitle' => __( 'Use for publication post that do not have post featured image.', 'redux-framework-wpsp' ),
                'desc'     => __( 'Recommended size 480px by 691px', 'redux-framework-wpsp' ),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/images/thumbnail-portrait.gif'
                    )
            ),
            array(
                'id'       => 'square-placeholder',
                'type'     => 'media',
                'title'    => __( 'Square Placeholder', 'redux-framework-wpsp' ),
                'subtitle' => __( 'Use for staff post that do not have post featured image.', 'redux-framework-wpsp' ),
                'desc'     => __( 'Recommended size 480px by 480px', 'redux-framework-wpsp' ),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/images/thumbnail-square.gif'
                    )
            ),
        )
    ) ); 

    // Global templates for pages, post, custom post, arhcive, category and taxonomy
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Template', 'redux-framework-wpsp' ),
        'id'               => 'basic-template',
        'desc'             => __( 'These are really basic fields!', 'redux-framework-wpsp' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-website'
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Layout', 'redux-framework-wpsp' ),
        'id'         => 'layout-post',
        'subsection' => true,
        'desc'       => __( 'Manage page layout with fullwide, left sidebar and right sidebar', 'redux-framework-wpsp' ),
        'fields'     => array(
            array(
                'id'       => 'layout-global',
                'type'     => 'image_select',
                'title'    => __( 'Global layout', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( 'Other layouts will override this option if they are set', 'redux-framework-wpsp' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'col-1c',
            ),
            array(
                'id'       => 'layout-home',
                'type'     => 'image_select',
                'title'    => __( 'Home', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_home ] Posts homepage layout', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'layout-single',
                'type'     => 'image_select',
                'title'    => __( 'Single', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_single ] Single post layout - If a post has a set layout, it will override this.', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'layout-archive',
                'type'     => 'image_select',
                'title'    => __( 'Archive', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_archive ] Category, date, tag and author archive layout', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'layout-archive-category',
                'type'     => 'image_select',
                'title'    => __( 'Archive — Category', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_category ] Category archive layout', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'layout-search',
                'type'     => 'image_select',
                'title'    => __( 'Search', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_search ] Search page layout', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'layout-404',
                'type'     => 'image_select',
                'title'    => __( 'Error 404', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_404 ] Error 404 page layout', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
            array(
                'id'       => 'layout-page',
                'type'     => 'image_select',
                'title'    => __( 'Default Page', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_page ] Default page layout - If a page has a set layout, it will override this.', 'redux-framework-wpsp' ),
                'options'  => array(
                    'inherit' => array(
                        'alt' => 'Inherit Global Layout',
                        'img' => get_template_directory_uri() . '/images/admin/layout-off.png'
                    ),
                    'col-1c' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'col-2cl' => array(
                        'alt' => '2 Column Left',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'col-2cr' => array(
                        'alt' => '2 Column Right',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'inherit',
            ),
        )
    ) );
    
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Sidebar', 'redux-framework-wpsp' ),
        'id'         => 'sidebar-post',
        'subsection' => true,
        'desc'       => __( 'Create sidebar and apply it on any pages and posts', 'redux-framework-wpsp' ),
        'fields'     => array(
            array(
                'id'       => 'sidebar-area',
                'type'     => 'multi_text',
                'title'    => __( 'Sidebar area', 'redux-framework-wpsp' ),
                'subtitle' => __( '', 'redux-framework-wpsp' ),
                'desc'     => __( '', 'redux-framework-wpsp' )
            ),
            array(
                'id'       => 'sidebar-home',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Home', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_home ] Primary', 'redux-framework-wpsp' ),
            ),
            array(
                'id'       => 'sidebar-single',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Single', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_single ] Primary - If a single post has a unique sidebar, it will override this.', 'redux-framework-wpsp' ),
            ),
            array(
                'id'       => 'sidebar-archive',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Archive', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_archive ] Primary', 'redux-framework-wpsp' ),
            ),
            array(
                'id'       => 'sidebar-archive-category',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Archive — Category', 'redux-framework-wpsp' ),
                'desc'     => __( '[ is_category ] Primary', 'redux-framework-wpsp' ),
            ),
            array(
                'id'       => 'sidebar-search',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Search', 'redux-framework-wpsp' ),
                'desc'     => __( '[ <strong>is_search</strong> ] Primary', 'redux-framework-wpsp' ),
            ),
            array(
                'id'       => 'sidebar-404',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Error 404', 'redux-framework-wpsp' ),
                'desc'     => __( '[ <strong>is_404</strong> ] Primary', 'redux-framework-wpsp' ),
            ),
            array(
                'id'       => 'sidebar-page',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Page', 'redux-framework-wpsp' ),
                'desc'     => __( '[ <strong>is_page</strong> ] Primary - If a page has a unique sidebar, it will override this.', 'redux-framework-wpsp' ),
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
