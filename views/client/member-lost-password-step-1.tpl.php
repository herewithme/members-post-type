<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

echo MPT_Shortcode::get_messages();
?>

<form method="post">
	<div class="mpt-filed">
		<label for="mpt-email"><?php mpt_is_allowed_email_signon() ? _e( 'E-mail', 'mpt' ) : _e( 'Username or E-mail', 'mpt' ); ?></label>
		<input id="mpt-email" required="required" type="text" name="mptlostpwd_s1[username]" value=""/>
	</div>
	<div class="mpt-filed">
		<?php mpt_nonce_field( 'mptlostpwd_s1' ); ?>
		<input type="submit" value="<?php _e( 'Submit', 'mpt' ); ?>"/>
	</div>
</form>
