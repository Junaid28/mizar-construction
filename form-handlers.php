<?php
/**
 * form-handlers.php
 * 
 * HOW TO USE:
 * Add this one line inside your functions.php:
 *   require_once get_template_directory() . '/form-handlers.php';
 * 
 * Then change YOUR_EMAIL below to your real email address.
 */

// ─────────────────────────────────────────────
// CHANGE THIS to your real email address
// ─────────────────────────────────────────────
define( 'MIZAR_ADMIN_EMAIL', 'errortrialand47@gmail.com' );


/* ══════════════════════════════════════════════
   1. CONTACT PAGE FORM
   ══════════════════════════════════════════════ */
add_action( 'admin_post_contact_form_submit',        'mizar_handle_contact_form' );
add_action( 'admin_post_nopriv_contact_form_submit', 'mizar_handle_contact_form' );

function mizar_handle_contact_form() {

  // 1. Verify nonce — blocks spam and CSRF attacks
  if ( ! isset($_POST['contact_nonce']) ||
       ! wp_verify_nonce( $_POST['contact_nonce'], 'contact_form_nonce' ) ) {
    wp_die( 'Security check failed.', 'Error', ['back_link' => true] );
  }

  // 2. Sanitize inputs
  $name    = sanitize_text_field( $_POST['ct_name']    ?? '' );
  $email   = sanitize_email(      $_POST['ct_email']   ?? '' );
  $subject = sanitize_text_field( $_POST['ct_subject'] ?? 'New Contact Form Message' );
  $message = sanitize_textarea_field( $_POST['ct_message'] ?? '' );

  // 3. Basic validation
  if ( empty($name) || empty($email) || empty($message) || ! is_email($email) ) {
    wp_redirect( add_query_arg('ct_status', 'error', wp_get_referer()) );
    exit;
  }

  // 4. Save submission to WordPress database (visible in Admin → Contact Submissions)
  $post_id = wp_insert_post([
    'post_type'   => 'contact_submission',
    'post_title'  => 'Contact: ' . $name . ' — ' . current_time('d M Y, H:i'),
    'post_status' => 'private',
  ]);

  if ( $post_id ) {
    update_post_meta( $post_id, '_ct_name',    $name );
    update_post_meta( $post_id, '_ct_email',   $email );
    update_post_meta( $post_id, '_ct_subject', $subject );
    update_post_meta( $post_id, '_ct_message', $message );
    update_post_meta( $post_id, '_ct_date',    current_time('mysql') );
  }

  // 5. Send email notification
  $to      = MIZAR_ADMIN_EMAIL;
  $headers = [
    'Content-Type: text/html; charset=UTF-8',
    'Reply-To: ' . $name . ' <' . $email . '>',
  ];

  $email_subject = '[Mizar Contact] ' . $subject;

  $email_body = '
    <div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;padding:20px;border:1px solid #eee;border-radius:8px;">
      <h2 style="color:#1a1a2e;border-bottom:3px solid #e8292a;padding-bottom:10px;">New Contact Form Submission</h2>
      <table style="width:100%;border-collapse:collapse;">
        <tr>
          <td style="padding:10px 0;color:#666;width:120px;"><strong>Name:</strong></td>
          <td style="padding:10px 0;">' . esc_html($name) . '</td>
        </tr>
        <tr style="background:#f9f9f9;">
          <td style="padding:10px 0;color:#666;"><strong>Email:</strong></td>
          <td style="padding:10px 0;"><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></td>
        </tr>
        <tr>
          <td style="padding:10px 0;color:#666;"><strong>Subject:</strong></td>
          <td style="padding:10px 0;">' . esc_html($subject) . '</td>
        </tr>
        <tr style="background:#f9f9f9;">
          <td style="padding:10px 0;color:#666;vertical-align:top;"><strong>Message:</strong></td>
          <td style="padding:10px 0;">' . nl2br( esc_html($message) ) . '</td>
        </tr>
      </table>
      <p style="margin-top:20px;font-size:12px;color:#999;">
        Sent from Mizar Construction contact form · ' . current_time('d M Y, H:i') . '
      </p>
    </div>';

  wp_mail( $to, $email_subject, $email_body, $headers );

  // 6. Redirect back with success message
  $contact_page = get_permalink( get_page_by_path('contact') );
  if ( ! $contact_page ) {
    $pages = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-contact.php']);
    $contact_page = ! empty($pages) ? get_permalink($pages[0]->ID) : wp_get_referer();
  }

  wp_redirect( add_query_arg('ct_status', 'success', $contact_page) );
  exit;
}


/* ══════════════════════════════════════════════
   2. PROPERTY ENQUIRY FORM
   ══════════════════════════════════════════════ */
add_action( 'admin_post_property_enquiry',        'mizar_handle_property_enquiry' );
add_action( 'admin_post_nopriv_property_enquiry', 'mizar_handle_property_enquiry' );

function mizar_handle_property_enquiry() {

  // 1. Verify nonce
  if ( ! isset($_POST['enquiry_nonce']) ||
       ! wp_verify_nonce( $_POST['enquiry_nonce'], 'property_enquiry_nonce' ) ) {
    wp_die( 'Security check failed.', 'Error', ['back_link' => true] );
  }

  // 2. Sanitize inputs
  $name           = sanitize_text_field(     $_POST['req_name']       ?? '' );
  $email          = sanitize_email(          $_POST['req_email']      ?? '' );
  $phone          = sanitize_text_field(     $_POST['req_phone']      ?? '' );
  $message        = sanitize_textarea_field( $_POST['req_message']    ?? '' );
  $property_id    = absint(                  $_POST['property_id']    ?? 0  );
  $property_title = sanitize_text_field(     $_POST['property_title'] ?? '' );

  // Use actual post title as fallback
  if ( ! $property_title && $property_id ) {
    $property_title = get_the_title( $property_id );
  }

  // 3. Basic validation
  if ( empty($name) || empty($email) || ! is_email($email) ) {
    wp_redirect( add_query_arg('pd_status', 'error', wp_get_referer()) );
    exit;
  }

  // 4. Save enquiry to WordPress database (Admin → Property Enquiries)
  $post_id = wp_insert_post([
    'post_type'   => 'property_enquiry',
    'post_title'  => 'Enquiry: ' . $name . ' — ' . $property_title . ' — ' . current_time('d M Y, H:i'),
    'post_status' => 'private',
  ]);

  if ( $post_id ) {
    update_post_meta( $post_id, '_enq_name',           $name );
    update_post_meta( $post_id, '_enq_email',          $email );
    update_post_meta( $post_id, '_enq_phone',          $phone );
    update_post_meta( $post_id, '_enq_message',        $message );
    update_post_meta( $post_id, '_enq_property_id',    $property_id );
    update_post_meta( $post_id, '_enq_property_title', $property_title );
    update_post_meta( $post_id, '_enq_date',           current_time('mysql') );
  }

  // 5. Send email notification
  $to      = MIZAR_ADMIN_EMAIL;
  $headers = [
    'Content-Type: text/html; charset=UTF-8',
    'Reply-To: ' . $name . ' <' . $email . '>',
  ];

  $property_link = $property_id ? get_permalink($property_id) : '#';
  $email_subject = '[Mizar Enquiry] ' . $property_title . ' — from ' . $name;

  $email_body = '
    <div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;padding:20px;border:1px solid #eee;border-radius:8px;">
      <h2 style="color:#1a1a2e;border-bottom:3px solid #e8292a;padding-bottom:10px;">New Property Enquiry</h2>
      <table style="width:100%;border-collapse:collapse;">
        <tr>
          <td style="padding:10px 0;color:#666;width:140px;"><strong>Property:</strong></td>
          <td style="padding:10px 0;">
            <a href="' . esc_url($property_link) . '" style="color:#e8292a;">' . esc_html($property_title) . '</a>
          </td>
        </tr>
        <tr style="background:#f9f9f9;">
          <td style="padding:10px 0;color:#666;"><strong>Name:</strong></td>
          <td style="padding:10px 0;">' . esc_html($name) . '</td>
        </tr>
        <tr>
          <td style="padding:10px 0;color:#666;"><strong>Email:</strong></td>
          <td style="padding:10px 0;"><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></td>
        </tr>
        <tr style="background:#f9f9f9;">
          <td style="padding:10px 0;color:#666;"><strong>Phone:</strong></td>
          <td style="padding:10px 0;">' . ( $phone ? esc_html($phone) : '<em style="color:#aaa;">Not provided</em>' ) . '</td>
        </tr>
        <tr>
          <td style="padding:10px 0;color:#666;vertical-align:top;"><strong>Message:</strong></td>
          <td style="padding:10px 0;">' . nl2br( esc_html($message) ) . '</td>
        </tr>
      </table>
      <p style="margin-top:20px;font-size:12px;color:#999;">
        Sent from Mizar Construction property page · ' . current_time('d M Y, H:i') . '
      </p>
    </div>';

  wp_mail( $to, $email_subject, $email_body, $headers );

  // 6. Redirect back to the property page with success message
  $return_url = $property_id
    ? get_permalink( $property_id )
    : wp_get_referer();

  wp_redirect( add_query_arg('pd_status', 'success', $return_url) );
  exit;
}


/* ══════════════════════════════════════════════
   3. REGISTER CUSTOM POST TYPES
   So submissions appear in WordPress Admin sidebar
   ══════════════════════════════════════════════ */
add_action( 'init', 'mizar_register_submission_post_types' );

function mizar_register_submission_post_types() {

  // Contact Submissions
  register_post_type( 'contact_submission', [
    'label'               => 'Contact Submissions',
    'labels'              => [
      'name'          => 'Contact Submissions',
      'singular_name' => 'Contact Submission',
      'menu_name'     => 'Contact Submissions',
    ],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-email-alt',
    'capability_type'     => 'post',
    'supports'            => ['title'],
    'exclude_from_search' => true,
  ]);

  // Property Enquiries
  register_post_type( 'property_enquiry', [
    'label'               => 'Property Enquiries',
    'labels'              => [
      'name'          => 'Property Enquiries',
      'singular_name' => 'Property Enquiry',
      'menu_name'     => 'Property Enquiries',
    ],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'menu_icon'           => 'dashicons-building',
    'capability_type'     => 'post',
    'supports'            => ['title'],
    'exclude_from_search' => true,
  ]);
}
