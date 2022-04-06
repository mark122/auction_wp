<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 6.0.0
 */

defined( 'ABSPATH' ) || exit;

//do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="letter-spacing:1px;">
	<tr>
		<td align="center" >
		<table bgcolor="#F2F2F2" align="center" border="0" cellpadding="0" cellspacing="0" width="700" style="border-top: 5px solid #fff;padding: 10px;">
			<tr>
			<td align="center" valign="top" width="700" style="padding-top: 20px;">
				<img style="width:240px;height:auto;" src="<?php echo site_url(); ?>/wp-content/uploads/2022/04/Uk-logo.png">
			</td>
			</tr>
			<tr>
			<td align="center" valign="top" width="700">
				<p style="font-style:italic;color: #C00000;font-size: 18px;letter-spacing: 1px;font-weight: 500;">Congratulations</p>
				<p style="font-style:italic;">You’re registered for the global Openyourheart.online auction for the people of Ukraine</p>
			</td>
			</tr>
			<tr>
			<td align="left" valign="top" width="700" style="padding-left:100px;">
				<p style="font-style:italic;"><span style="color:#C00000;">Date:</span> 28th April 2022 </p>
				<p style="font-style:italic;"><span style="color:#C00000;">Time:</span> 8am AEST (please click <a style="color:#C00000;" href="<?php echo site_url(); ?>/online-auction">this link</a> to check the time in your local area)</p>
			</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#F2F2F2" style="border-top: 5px solid #fff;padding: 10px;">
			<tr>
			<td align="left" valign="top" >
			<?php /* translators: %s: Customer username */ 
				// if you need the email address or something else
				$user = get_user_by('login', $user_login );
				$email = $user->user_email;
				// if you need an extra field from the user metas
				$firstname = get_user_meta( $user->ID, 'billing_first_name' , true );
				//$lastname = get_user_meta( $user->ID, 'billing_last_name', true);?>

				<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $firstname ) ); ?></p>
				<p>Thanks for creating your account on <strong>Openyourheart.online.</strong></p>
			<p>To view the launch live, please click on <a style="color:#C00000;" href="#">this link</a> to gain access to this important live event where we will be introducing the fundraising program, the artists and their art.
			</p>
			<p>You can bid, access your account, change your password and more by clicking <a style="color:#C00000;" href="<?php echo site_url(); ?>/online-auction">this link</a></p>
			<p>Look forward to seeing you on the day – and to making a real difference.
			</p>
			<p>The Openyourheart.online team  
			</p>
			<p><?php //printf( esc_html__( 'Your username is %2$s. You can access your account area to view orders, change your password, and more at: %3$s', 'woocommerce' ), esc_html( $blogname ), '<strong>' . esc_html( $user_login ) . '</strong>', make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated && $set_password_url ) : ?>
				<?php // If the password has not been set by the user during the sign up process, send them a link to set a new password ?>
				<p><a style="color:#C00000;" href="<?php echo esc_attr( $set_password_url ); ?>"><?php printf( esc_html__( 'Click here to set your new password.', 'woocommerce' ) ); ?></a></p>
				<?php endif; ?>
			</td>
			</tr>			
		</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#F2F2F2" style="border-top: 5px solid #fff;padding: 10px;">
			<tr>
			<td align="center" valign="top" width="700" style="padding-bottom: 20px;">
				<p style="color:#C00000;">Join our growing community of human kindness</p>
				<a style="color:#000000;" href="#">www.openyourheart.online</a>
				<?php
				/**
				 * Show user-defined additional content - this is set in each email's settings.
				 */
				if ( $additional_content ) {
					echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
				} ?>
			</td>
			</tr>				
		</table>
		</td>
	</tr>

</table>

    
