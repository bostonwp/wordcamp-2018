<?php
/**
 * Mock_Subscriptions_Widget
 *
 * The Jetpack Subscriptions widget requires a connection, so this creates a 'Mock'
 * Subscription widget to let us style it correctly.
 */
class Mock_Subscriptions_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mock_subscription_widget',
			'Mock Subscription',
			array(
				'classname' => 'mock_subscription_widget',
				'description' => 'Mock of an email signup form to style.',
			)
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo $args['before_title'] . 'Subscribe to keep up-to-date' . $args['after_title']; ?>

		<form action="#" method="post" accept-charset="utf-8" id="subscribe-blog-blog_subscription-3">
			<div id="subscribe-text"></div>
			<p id="subscribe-email">
				<label id="jetpack-subscribe-label" for="subscribe-field-blog_subscription-3">Email Address</label>
				<input type="email" name="email" required="required" class="required" value="" id="subscribe-field-blog_subscription-3" placeholder="Email Address" />
			</p>

			<p id="subscribe-submit">
				<input type="hidden" name="action" value="subscribe" />
				<input type="hidden" name="source" value="https://2017.boston.wordcamp.org/" />
				<input type="hidden" name="sub-type" value="widget" />
				<input type="hidden" name="redirect_fragment" value="blog_subscription-3" />
				<input type="hidden" id="_wpnonce" name="_wpnonce" value="f86fa48e79" />
				<input type="submit" value="Subscribe" name="jetpack_subscriptions_widget" />
			</p>
		</form>
		<script>
		/*
		Custom functionality for safari and IE
		 */
		(function( d ) {
			// In case the placeholder functionality is available we remove labels
			if ( ( 'placeholder' in d.createElement( 'input' ) ) ) {
				var label = d.querySelector( 'label[for=subscribe-field-blog_subscription-3]' );
					label.style.clip 	 = 'rect(1px, 1px, 1px, 1px)';
					label.style.position = 'absolute';
					label.style.height   = '1px';
					label.style.width    = '1px';
					label.style.overflow = 'hidden';
			}

			// Make sure the email value is filled in before allowing submit
			var form = d.getElementById('subscribe-blog-blog_subscription-3'),
				input = d.getElementById('subscribe-field-blog_subscription-3'),
				handler = function( event ) {
					if ( '' === input.value ) {
						input.focus();

						if ( event.preventDefault ){
							event.preventDefault();
						}

						return false;
					}
				};

			if ( window.addEventListener ) {
				form.addEventListener( 'submit', handler, false );
			} else {
				form.attachEvent( 'onsubmit', handler );
			}
		})( document );
		</script>
		<?php echo $args['after_widget'];
	}
}

function mock_subscription_widget_init() {
	register_widget( 'Mock_Subscriptions_Widget' );
}
add_action( 'widgets_init', 'mock_subscription_widget_init' );
