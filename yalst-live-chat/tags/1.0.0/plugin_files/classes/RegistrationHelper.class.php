<?php

require_once('yalstHelper.class.php');

class RegistrationHelper extends yalstHelper
{
	public function render()
	{
?>
		<div id="yalstRegistration">
		<div class="wrap">

		<div class="metabox-holder">
			<div class="postbox">
				<div id="yalst_logo">
					<img src="<?php echo yalstGeneral::get_instance()->get_plugin_url(); ?>/images/yalst-logo.png" /><br>
					<span><? _e( 'Live Chat Plugin für Wordpress', 'yalst_text' ); ?></span>
				</div>
			</div>
		</div> 

		<div class="metabox-holder">
			<div class="postbox">
				<h3><? _e( 'Haben Sie bereits einen Voll- oder Testzugang von yalst?', 'yalst_text' ); ?></h3>
				<div class="postbox_content">
				<ul id="testen">
				<li><input type="radio" name="testen" id="testen_1" checked="checked"> <label for="testen_1"><? _e( 'Ja, ich habe bereits einen yalst-Account!', 'yalst_text' ); ?></label></li>
				<li><input type="radio" name="testen" id="testen_0"> <label for="testen_0"><? _e( 'Nein, Ich möchte yalst für 7 Tage unverbindlich testen!', 'yalst_text' ); ?><sup>*</sup></label></li>
				</ul>
				</div>
			</div>
		</div>

		<!-- Testen iFrame -->
		<div class="metabox-holder" id="yalst_testzugang" style="display:none">
			<div class="postbox">
				<div id="Testzugang">
					<? if ((get_locale() == "de_DE") || (get_locale() == "de_CH")): ?>
						<iframe src='https://www.yalst.de/live-chat/testen.php?wordpress=1' frameborder="0" ALLOWTRANSPARENCY="true"  scrolling="no" id="TestzugangFrame"></iframe>
					<? else: ?>
						<iframe src='https://www.yalst.de/live-chat/try.php?wordpress=1' frameborder="0" ALLOWTRANSPARENCY="true"  scrolling="no" id="TestzugangFrame"></iframe>
					<? endif; ?>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php
	}
}