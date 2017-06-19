<?php

class address_Info_Meta_Box {

    public function __construct() {
        if ( is_admin() ) {
            add_action( 'load-post1.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new1.php', array( $this, 'init_metabox' ) );
        }
    }

    public function init_metabox() {

        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

    }

    public function add_metabox() {
        add_meta_box(
            'address_info',
            __( 'address Info', 'text_domain' ),
            array( $this, 'render_metabox' ),
            'address',
            'advanced',
            'default'
        );
    }

    public function render_metabox( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'address_nonce_action', 'address_nonce' );
        // Retrieve an existing value from the database.
        $address1   = get_post_meta( $post->ID, 'address1', true );
        $address2 = get_post_meta( $post->ID, 'address2', true );
        $country = get_post_meta( $post->ID, 'country', true );
        $state  = get_post_meta( $post->ID, 'state', true );
        $city  = get_post_meta( $post->ID, 'city', true );
        $zipcode  = get_post_meta( $post->ID, 'zipcode', true );

        // Set default values.
        if( empty( $address1 ) ) $address1 = '';
        if( empty( $address2 ) ) $address2 = '';
        if( empty( $country ) ) $country = '';
        if( empty( $state ) ) $state = '';
        if( empty( $city ) ) $city = '';
        if( empty( $zipcode ) ) $zipcode = '';
       
        // Form fields.
        echo '<table class="form-table">';
        echo '  <tr>';
        echo '      <th><label for="address1" class="address1_label">' . __( 'Address1', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="address1" name="address1" class="address1_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $address1 ) . '">';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="address2" class="address2_label">' . __( 'Address2', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="address2" name="address2" class="address2_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $address2 ) . '">';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="country" class="country_label">' . __( 'Country', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="country" name="country" class="country_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $country ) . '">';
        echo '      </td>';
        echo '  </tr>';

         echo '  <tr>';
        echo '      <th><label for="state" class="state_label">' . __( 'State', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="state" name="state" class="state_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $state ) . '">';
        echo '      </td>';
        echo '  </tr>';

        echo '  <tr>';
        echo '      <th><label for="city" class="city_label">' . __( 'City', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="city" name="city" class="city_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $state ) . '">';
        echo '      </td>';
        echo '  </tr>';


        echo '  <tr>';
        echo '      <th><label for="zipcode" class="zipcode_label">' . __( 'Zipcode', 'text_domain' ) . '</label></th>';
        echo '      <td>';
        echo '          <input type="text" id="zipcode" name="zipcode" class="zipcode_field" placeholder="' . esc_attr__( '', 'text_domain' ) . '" value="' . esc_attr__( $zipcode ) . '">';
        echo '      </td>';
        echo '  </tr>';
        echo '</table>';
    }



    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        $nonce_name   = $_POST['address_nonce'];
        $nonce_action = 'address_nonce_action';
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
  $address1_new = isset( $_POST[ 'address1' ] ) ? sanitize_text_field( $_POST[ 'address1' ] ) : '';
  $address2_new = isset( $_POST[ 'address2' ] ) ? sanitize_text_field( $_POST[ 'address2' ] ) : '';
  $country_new = isset( $_POST[ 'country' ] ) ? sanitize_text_field( $_POST[ 'country' ] ) : '';
  $state_new = isset( $_POST[ 'state' ] ) ? sanitize_text_field( $_POST[ 'state' ] ) : '';
  $city_new = isset( $_POST[ 'city' ] ) ? sanitize_text_field( $_POST[ 'city' ] ) : '';
 $zipcode_new = isset( $_POST[ 'zipcode' ] ) ? sanitize_text_field( $_POST[ 'zipcode' ] ) : '';

        
        // Update the meta field in the database.
        update_post_meta( $post_id, 'address1', $address1_new );
        update_post_meta( $post_id, 'address2', $address2_new );
        update_post_meta( $post_id, 'country', $country_new );
        update_post_meta( $post_id, 'state', $state_new );
        update_post_meta( $post_id, 'city', $city_new );
        update_post_meta( $post_id, 'zipcode', $zipcode_new );
        

    }

}




?>
