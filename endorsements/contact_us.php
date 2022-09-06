<?php

echo 'in contact_us.php';
echo '<br>get_site_url() = ', get_site_url();
echo '<br>contact_us = ', $contact_us;
$contact_us = stripslashes($contact_us);
echo '<br>Contact Us<br>';

//echo do_shortcode( '[contact-form-7 id="4" title="Contact form 1"]' );
echo do_shortcode( "$contact_us" );

?>
