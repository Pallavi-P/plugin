

jQuery(document).ready(function () {

          jQuery(".ltype").bind("change", function () {
	
	
            var lname = jQuery(this).val();
            
            if(lname == 'ashram') {
                    jQuery('#l-ashram').show();
                    jQuery('#l-center').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-school').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();

               } 
               else if (lname =='center' ) {

                    jQuery('#l-center').show();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-school').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();
               } 
               else if (lname =='temple' ) {

                    jQuery('#l-temple').show();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-school').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();

               } 
               else if (lname =='region' ) {

                    jQuery('#l-region').show();
                    jQuery('#l-school').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();

                } 
                else if (lname =='country_region' ) {
                    jQuery('#l-country-region').show();
                    jQuery('#l-region').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-school').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-region-country').hide();

                } 
                else if (lname =='region_country' ) {

                    jQuery('#l-country-region').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-school').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-region-country').show();

                } 
                else if (lname == 'school' ) {

                    jQuery('#l-school').show();
                    jQuery('#l-trust').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();

                } 
                else if (lname == 'chord' ) {

                    jQuery('#l-chord').show();
                    jQuery('#l-school').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();

                } 
                else if (lname == 'acharya' ) {

                    jQuery('#l-acharya').show();
                    jQuery('#l-school').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-committee').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();

                } else if (lname == 'trust' ) {

                    jQuery('#l-trust').show();
                    jQuery('#l-committee').hide();
                    jQuery('#l-center').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();
                    jQuery('#l-acharya').hide();

                } 
                else if (lname == 'committee' ) {

                    jQuery('#l-committee').show();
                    jQuery('#l-center').hide();
                    jQuery('#l-trust').hide();
                    jQuery('#l-ashram').hide();
                    jQuery('#l-acharya').hide();
                    jQuery('#l-temple').hide();
                    jQuery('#l-region').hide();
                    jQuery('#l-chord').hide();
                    jQuery('#l-country-region').hide();
                    jQuery('#l-region-country').hide();
                }
        });
    });

    (function($) {

        $("input[name$='expand']").click(function() {
            var test = $(this).val();
            $("#expand" + test).show();
        });

        $('select.ltype option[value="0"]').attr('selected', true);
            jQuery('#l-school').hide();
            jQuery('#l-center').hide();
            jQuery('#l-acharya').hide();
            jQuery('#l-ashram').hide();
            jQuery('#l-temple').hide();
            jQuery('#l-chord').hide();
            jQuery('#l-trust').hide();
            jQuery('#l-committee').hide();
            jQuery('#l-country-region').hide();
            jQuery('#l-region-country').hide();
    }(jQuery));

    jQuery('.city_tags_select a').click(function() {
        var value = jQuery(this).text();    
        jQuery('input[name=expand-city]').val(value)
        jQuery('#expand-city').show();
        return false;
    });
  

    jQuery(function() {
        jQuery( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: '-100y:c+nn',
          dateFormat: 'yy-mm-dd'
        });
     });

