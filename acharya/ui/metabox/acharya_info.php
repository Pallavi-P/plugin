<?php

class personal_Info_Meta_Box {

    public function __construct() {
        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }
    }

    public function init_metabox() {

        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

    }

    public function add_metabox() {
        add_meta_box(
            'acharya_info',
            __( 'acharya Info', 'text_domain' ),
            array( $this, 'render_metabox' ),
            'acharya',
            'advanced',
            'default'
        );

    }

    public function render_metabox( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'acharya_nonce_action', 'acharya_nonce' );
        // Retrieve an existing value from the database.
      /*  $salutation   = get_post_meta( $post->ID, 'salutation', true );
        $acharya_name = get_post_meta( $post->ID, 'acharya_name', true );
        $acharya_dob  = get_post_meta( $post->ID, 'acharya_dob', true );
        $acharya_phone = get_post_meta( $post->ID, 'acharya_phone', true );
        $acharya_email  = get_post_meta( $post->ID, 'acharya_email', true );

        // Set default values.
        if( empty( $salutation ) ) $salutation = '';
        if( empty( $acharya_name ) ) $acharya_name = '';
        if( empty( $acharya_dob ) ) $acharya_dob = '';
        if( empty( $acharya_phone ) ) $acharya_phone = '';
        if( empty( $acharya_email ) ) $acharya_email = '';
       */
        // Form fields.
        echo '<table class="form-table">';

        echo '  <tr>';
        echo '      <th><label for="salutation" class="salutation_label">' . __( 'Salutation', 'text_domain' ) . '</label></th>';
        echo '      <td>';
       echo '           <select id="salutation" name="salutation" class="salutation_field">';
        echo '          <option value="salutation" ' . selected( $salutation, 'salutation', false ) . '> ' . __( 'Acharya', 'text_domain' );
        echo '          <option value="sal_brahmchari" ' . selected( $salutation, 'sal_brahmchari', false ) . '> ' . __( 'Brahmchari', 'text_domain' );
         echo '          <option value="sal_brahmcharini" ' . selected( $salutation, 'sal_brahmcharini', false ) . '> ' . __( 'Brahmcharini', 'text_domain' );
          echo '          <option value="sal_swami" ' . selected( $salutation, 'sal_swami', false ) . '> ' . __( 'Swami', 'text_domain' );
           echo '          <option value="sal_swamini" ' . selected( $salutation, 'sal_swamini', false ) . '> ' . __( 'Swamini', 'text_domain' );
        echo '          </select>';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="acharya_name" class="acharya_name_label">' . __( 'Acharya Name', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="acharya_name" name="acharya_name" class="acharya_name_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $acharya_name ) . '">';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="acharya_dob" class="acharya_dob_label">' . __( 'Date  of birth', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="acharya_dob" name="acharya_dob" class="acharya_dob_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $acharya_dob ) . '">';
        echo '      </td>';
        echo '  </tr>';


        echo '  <tr>';
        echo '      <th><label for="acharya_phone" class="acharya_phone_label">' . __( 'Phone', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="number" id="acharya_phone" name="acharya_phone" class="acharya_phone_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $acharya_phone ) . '">';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="acharya_email" class="acharya_email_label">' . __( 'Email', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="email" id="acharya_email" name="acharya_email" class="acharya_email_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $acharya_email ) . '">';
        echo '      </td>';
        echo '  </tr>';


        echo '</table>';

    }

    public function save_metabox( $post_id, $post ) {

        // Add nonce for security and authentication.
        $nonce_name   = $_POST['acharya_nonce'];
        $nonce_action = 'acharya_nonce_action';

        // Check if a nonce is set.
        if ( ! isset( $nonce_name ) )
            return;

        // Check if a nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
            return;

        // Check if the user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;

        // Check if it's not an autosave.
        if ( wp_is_post_autosave( $post_id ) )
            return;

        // Check if it's not a revision.
        if ( wp_is_post_revision( $post_id ) )
            return;

        // Sanitize user input.
        $salutation_new = isset( $_POST[ 'salutation' ] ) ? sanitize_text_field( $_POST[ 'salutation' ] ) : '';
        $acharya_new_name = isset( $_POST[ 'acharya_name' ] ) ? sanitize_text_field( $_POST[ 'acharya_name' ] ) : '';
        $acharya_new_dob = isset( $_POST[ 'acharya_dob' ] ) ? sanitize_text_field( $_POST[ 'acharya_dob' ] ) : '';
        $acharya_new_phone = isset( $_POST[ 'acharya_phone' ] ) ? sanitize_text_field( $_POST[ 'acharya_phone' ] ) : '';
        $acharya_new_email = isset( $_POST[ 'acharya_email' ] ) ? sanitize_text_field( $_POST[ 'acharya_email' ] ) : '';
        

        // Update the meta field in the database.

        global $wpdb;
        $wpdb->query( "INSERT INTO db_acharya(post_id,salutation,acharya_name,acharya_dob,acharya_phone,acharya_email) VALUES($post_id, '".$salutation_new."', '".$acharya_new_name."','".$acharya_new_dob."','".$acharya_new_phone."','".$acharya_new_email."')");
                

        /*   
        update_post_meta( $post_id, 'salutation', $salutation_new );
        update_post_meta( $post_id, 'acharya_name', $acharya_new_name );
        update_post_meta( $post_id, 'acharya_dob', $acharya_new_dob );
        update_post_meta( $post_id, 'acharya_phone', $acharya_new_phone );
        update_post_meta( $post_id, 'acharya_email', $acharya_new_email );*/
        

    }

}




?>
