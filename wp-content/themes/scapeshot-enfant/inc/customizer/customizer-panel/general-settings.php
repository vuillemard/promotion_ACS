<?php

/* GENERAL SETTINGS PANEL */
$wp_customize->add_panel('total_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'total'),
    'priority' => 10
));

/* GENERAL SETTINGS SECTION */
$wp_customize->add_section('total_container_section', array(
    'title' => esc_html__('Container', 'total'),
    'panel' => 'total_general_settings_panel'
));


//MOVE BACKGROUND AND COLOR SETTING INTO GENERAL SETTING PANEL
$wp_customize->get_control('background_color')->section = 'total_container_section';
$wp_customize->get_control('background_image')->section = 'total_container_section';
$wp_customize->get_control('background_preset')->section = 'total_container_section';
$wp_customize->get_control('background_position')->section = 'total_container_section';
$wp_customize->get_control('background_size')->section = 'total_container_section';
$wp_customize->get_control('background_repeat')->section = 'total_container_section';
$wp_customize->get_control('background_attachment')->section = 'total_container_section';

$wp_customize->get_control('background_color')->priority = 20;
$wp_customize->get_control('background_image')->priority = 20;
$wp_customize->get_control('background_preset')->priority = 20;
$wp_customize->get_control('background_position')->priority = 20;
$wp_customize->get_control('background_size')->priority = 20;
$wp_customize->get_control('background_repeat')->priority = 20;
$wp_customize->get_control('background_attachment')->priority = 20;

$wp_customize->add_setting('total_website_layout', array(
    'default' => 'wide',
    'sanitize_callback' => 'total_sanitize_choices',
));

$wp_customize->add_control('total_website_layout', array(
    'section' => 'total_container_section',
    'type' => 'radio',
    'label' => esc_html__('Website Layout', 'total'),
    'choices' => array(
        'wide' => esc_html__('Wide', 'total'),
        'boxed' => esc_html__('Boxed', 'total'),
        'fluid' => esc_html__('Fluid', 'total')
    )
));

$wp_customize->add_setting('total_fluid_container_width', array(
    'sanitize_callback' => 'absint',
    'default' => 80,
));

$wp_customize->add_control(new Total_Range_Slider_Control($wp_customize, 'total_fluid_container_width', array(
    'section' => 'total_container_section',
    'label' => esc_html__('Website Container Width (%)', 'total'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_wide_container_width', array(
    'sanitize_callback' => 'absint',
    'default' => 1170,
));

$wp_customize->add_control(new Total_Range_Slider_Control($wp_customize, 'total_wide_container_width', array(
    'section' => 'total_container_section',
    'label' => esc_html__('Website Container Width (px)', 'total'),
    'input_attrs' => array(
        'min' => 900,
        'max' => 1800,
        'step' => 10
    )
)));

$wp_customize->add_setting('total_container_padding', array(
    'sanitize_callback' => 'absint',
    'default' => 80,
));

$wp_customize->add_control(new Total_Range_Slider_Control($wp_customize, 'total_container_padding', array(
    'section' => 'total_container_section',
    'label' => esc_html__('Website Container Padding (px)', 'total'),
    'input_attrs' => array(
        'min' => 10,
        'max' => 200,
        'step' => 5
    )
)));

$wp_customize->add_setting('total_sidebar_width', array(
    'sanitize_callback' => 'absint',
    'default' => 30,
));

$wp_customize->add_control(new Total_Range_Slider_Control($wp_customize, 'total_sidebar_width', array(
    'section' => 'total_container_section',
    'label' => esc_html__('Sidebar Width (%)', 'total'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 50,
        'step' => 1
    )
)));

$wp_customize->add_setting('total_background_heading', array(
    'sanitize_callback' => 'total_sanitize_text',
));

$wp_customize->add_control(new Total_Heading_Control($wp_customize, 'total_background_heading', array(
    'section' => 'total_container_section',
    'label' => esc_html__('Background', 'total'),
)));


/* BACK TO TOP SECTION */
$wp_customize->add_section('total_backtotop_section', array(
    'title' => esc_html__('Scroll to Top', 'total'),
    'panel' => 'total_general_settings_panel'
));


$wp_customize->add_setting('total_backtotop', array(
    'sanitize_callback' => 'total_sanitize_text',
    'default' => true
));

$wp_customize->add_control(new Total_Toggle_Control($wp_customize, 'total_backtotop', array(
    'section' => 'total_backtotop_section',
    'label' => esc_html__('Back to Top Button', 'total'),
    'description' => esc_html__('A button on click scrolls to the top of the page.', 'total'),
)));

/* BREADCRUMB SECTION */
$wp_customize->add_section('total_breadcrumb_section', array(
    'title' => esc_html__('Breadcrumb', 'total'),
    'panel' => 'total_general_settings_panel'
));

$wp_customize->add_setting('total_breadcrumb_enable', array(
    'sanitize_callback' => 'total_sanitize_checkbox',
    'default' => true
));

$wp_customize->add_control(new Total_Toggle_Control($wp_customize, 'total_breadcrumb_enable', array(
    'section' => 'total_breadcrumb_section',
    'label' => esc_html__('BreadCrumb', 'total'),
    'description' => esc_html__('Breadcrumbs are a great way of letting your visitors find out where they are on your site.', 'total'),
)));

