<?php

require_once('yalstHelper.class.php');

class IntegrationHelper extends yalstHelper
{
	public function render()
	{
		
		if ($_POST["yalstReiterIntegrationInput"])
		{
		 echo $_POST["yalstReiterIntegrationInput"];
		}
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
				<h3><? _e( 'Wo wollen Sie den Chatbutton einbinden?', 'yalst_text' ); ?></h3>
				<div class="postbox_content">
				<ul id="integration">
				<? $tabIndex = get_option("tabIndex", ""); ?>
				<li><input type="radio" name="integration" id="integration_0" <? if ((!isset($tabIndex)) || ($tabIndex == '0')) {echo 'checked="checked"';}?>> <label for="integration_0"><? _e( 'Einbindung deaktiviert', 'yalst_text' ); ?></label></li>
				<li><input type="radio" name="integration" id="integration_1" <? if ($tabIndex == '1') {echo 'checked="checked"';}?>> <label for="integration_1"><? _e( 'Auf allen Seiten als Reiter/Tabbutton', 'yalst_text' ); ?></label></li>
				<li><input type="radio" name="integration" id="integration_2" <? if ($tabIndex == '2') {echo 'checked="checked"';}?>> <label for="integration_2"><? _e( 'Auf allen Seiten als Reiter/Tab und zusätzlich über Widgets (vorgeschritten)', 'yalst_text' ); ?><sup>*</sup></label></li>
				<li><input type="radio" name="integration" id="integration_3" <? if ($tabIndex == '3') {echo 'checked="checked"';}?>> <label for="integration_3"><? _e( 'Nur über Widgets (vorgeschritten)', 'yalst_text' ); ?><sup>*</sup></label></li>
				</ul>
				<div class="erklaerung"><sup>*</sup><? _e( 'Mit Widgets können Sie Buttons im Seitenverlauf, verschiedene Buttons für verschiedene Abteilungen, mehrere Buttons auf einer Seite usw. einbinden.', 'yalst_text' ); ?></div>
				</div>
			</div>
		</div>

		
		<!-- Deaktivieren -->
		<div class="metabox-holder" id="deactiveIntegration" style="display:none">
			<div class="postbox">				
				<div class="postbox_content">
					<div class="example">
						<img src="<?php echo yalstGeneral::get_instance()->get_plugin_url(); ?>/images/nointegration.png" />
					</div>
					<div class="rechte_seite">
						<div class="explain_header">
						<? _e( 'Deaktivieren Sie den Einbindungscode.', 'yalst_text' ); ?>
						</div>
						<div class="explain_textfield">
							<form method="post" action="?page=yalst_integration" id="save_yalst_deactive_integration">
								<input type="hidden" name="yalstDeactiveIntegration" value="1">
								<input type="hidden" name="tabIndex" value="0">	
						</div>
						<div class="explain_text">
							<? _e( 'Hier können Sie den Einbindungscode im Footer deaktivieren.', 'yalst_text' ); ?><br><br>
							<span class="rot"><? _e( 'Achtung:', 'yalst_text' ); ?></span><br><br>
							<? _e( 'Wenn Sie Einbindungen über Widgets genutzt haben, löschen Sie die Widgets in den jeweiligen Elementen unter Design > Widgets.', 'yalst_text' ); ?>
						</div>
						<div class="explain_button">
								<button type="submit" class="btn btn-warning save"><? _e( 'Anwenden', 'yalst_text' ); ?></button>
							</form>
						</div>
					</div>
					
					
					
					
				</div>
			</div>
		</div>
		
		<!-- Reiter -->
		<div class="metabox-holder" id="reiterIntegration" style="display:none">
			<div class="postbox">				
				<div class="postbox_content">
					<div class="example">
						<img src="<?php echo yalstGeneral::get_instance()->get_plugin_url(); ?>/images/reiter.png" />
					</div>
					<div class="rechte_seite">
						<div class="explain_header">
						<? _e( 'Kopieren Sie hierher bitte den Einbindungscode.', 'yalst_text' ); ?>
						</div>
						<? if (get_option('isAddedReiter') != 0): ?>
							<div class="explain_text">
							<span class="rot"><? _e( 'Reiter wurde hinzugefügt.', 'yalst_text' ); ?></span>
							</div>
							<? update_option('isAddedReiter',0) ?>
						<? endif; ?>
						
						<div class="explain_textfield">
							<form method="post" action="?page=yalst_integration" id="save_yalst_reiter_integration">
								<textarea name="yalstReiterIntegrationInput" id="yalstReiterIntegration" cols="40" rows="7" required /><?php echo get_option("yalstReiterIntegrationInput", ""); ?></textarea>
								<input type="hidden" name="yalstReiterIntegration" value="1">
								<input type="hidden" name="tabIndex" value="1">	
						</div>
						<div class="explain_text">
							<? _e( 'Sie finden den Einbindungscode in der Administration am Ende des StartUp-Wizards.', 'yalst_text' ); ?><br><br>
							<? _e( 'Oder Sie generieren in der Administration diesen sehr individuell im HTML-Codegenerator. (Punkt: Einbindung > HTML-Codegenerator)', 'yalst_text' ); ?><br><br>
							<? _e( 'Der Button erscheint dann auf jeder Seite als Reiter/Tab.', 'yalst_text' ); ?>
						</div>
						<div class="explain_button">
								<button type="submit" class="btn btn-warning save"><? _e( 'Speichern', 'yalst_text' ); ?></button>
							</form>
						</div>
						<div class="explain_button">
							<? if ((get_locale() == "de_DE") || (get_locale() == "de_CH")): ?>
								<a href="https://rd.livesupportserver.de" target="_blank" type="button" class="btn btn-warning wordpress"><? _e( 'Code holen (Administration)', 'yalst_text' ); ?></a>
							<? else: ?>
								<a href="https://en.livesupportserver.de" target="_blank" type="button" class="btn btn-warning wordpress"><? _e( 'Code holen (Administration)', 'yalst_text' ); ?></a>
							<? endif; ?>
						</div>
					</div>
					
					
					
					
				</div>
			</div>
		</div>
		
		<!-- Reiter und Widget -->
		<div class="metabox-holder" id="reiterWidgetIntegration" style="display:none">
			<div class="postbox">
				<div class="postbox_content">
					<div class="example">
						<img src="<?php echo yalstGeneral::get_instance()->get_plugin_url(); ?>/images/reiter_widget.png" />
					</div>
					<div class="rechte_seite">
						<div class="explain_text">
							<strong><? _e( 'Reiter/Tab-Button', 'yalst_text' ); ?></strong>
						</div>
						<div class="explain_text">
							<? _e( 'Sie können hier einen Einbindungscode hineinkopieren, der automatisch in den Footer integriert wird.', 'yalst_text' ); ?><br><br>
							<? _e( 'Einen entsprechenden Einbindungscode finden Sie in der Administration am Ende des StartUp-Wizards oder im HTML-Codegenerator. (Punkt: Einbindung > HTML-Codegenerator).', 'yalst_text' ); ?><br><br>
							<? _e( 'Der Button erscheint dann auf jeder Seite als Reiter/Tab.', 'yalst_text' ); ?>
						</div>
						
						<? if (get_option('isAddedReiterWidget') != 0): ?>
							<div class="explain_text">
							<span class="rot"><? _e( 'Reiter wurde hinzugefügt.', 'yalst_text' ); ?></span>
							</div>
							<? update_option('isAddedReiterWidget',0) ?>
						<? endif; ?>
						
						<div class="explain_textfield">
							<form method="post" action="?page=yalst_integration" id="save_yalst_reiterWidget_integration">
								<textarea name="yalstReiterWidgetIntegrationInput" id="yalstReiterWidgetIntegration" cols="40" rows="7" required /><?php echo get_option("yalstReiterWidgetIntegrationInput", ""); ?></textarea>
								<input type="hidden" name="yalstReiterWidgetIntegration" value="1">
								<input type="hidden" name="tabIndex" value="2">	
						</div>
						
						<div class="explain_text">
							<strong><? _e( 'Mit Widgets', 'yalst_text' ); ?></strong>
						</div>
						
						<div class="explain_text">
							<? _e( 'Ziehen das Widget einfach an die gewünschten Stellen und kopieren Sie die passenden Einbindungscodes aus der Administration (Punkt: Einbindung > HTML-Codegenerator) in die entsprechenden Textfelder.', 'yalst_text' ); ?><br><br>
							<? _e( 'Das Widget finden Sie wie üblich unter Design > Widgets.', 'yalst_text' ); ?>
						</div>
						
						<div class="explain_button">
								<button type="submit" class="btn btn-warning save"><? _e( 'Speichern', 'yalst_text' ); ?></button>
							</form>
						</div>
						<div class="explain_button">
							<? if ((get_locale() == "de_DE") || (get_locale() == "de_CH")): ?>
								<a href="https://rd.livesupportserver.de" target="_blank" type="button" class="btn btn-warning wordpress"><? _e( 'Code holen (Administration)', 'yalst_text' ); ?></a>
							<? else: ?>
								<a href="https://en.livesupportserver.de" target="_blank" type="button" class="btn btn-warning wordpress"><? _e( 'Code holen (Administration)', 'yalst_text' ); ?></a>
							<? endif; ?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Widget -->
		<div class="metabox-holder" id="widgetIntegration" style="display:none">
			<div class="postbox">
				<div class="postbox_content">
					<div class="example">
						<img src="<?php echo yalstGeneral::get_instance()->get_plugin_url(); ?>/images/widget.png" />
					</div>
					<div class="rechte_seite">
						<div class="explain_text">
							<? _e( 'Ziehen das Widget einfach an die gewünschten Stellen und kopieren Sie die passenden Einbindungscodes aus der Administration (Punkt: Einbindung > HTML-Codegenerator) in die entsprechenden Textfelder.', 'yalst_text' ); ?><br><br>
							<? _e( 'Das Widget finden Sie wie üblich unter Design > Widgets.', 'yalst_text' ); ?>
						</div>
						<div class="explain_textfield">
							<form method="post" action="?page=yalst_integration" id="save_yalst_widget_integration">
								<input type="hidden" name="yalstWidgetIntegration" value="1">
								<input type="hidden" name="tabIndex" value="3">	
						</div>
						<div class="explain_button">
								<button type="submit" class="btn btn-warning save"><? _e( 'Anwenden', 'yalst_text' ); ?></button>
							</form>
						</div>
						<div class="explain_button">
							<? if ((get_locale() == "de_DE") || (get_locale() == "de_CH")): ?>
								<a href="https://rd.livesupportserver.de" target="_blank" type="button" class="btn btn-warning wordpress"><? _e( 'Code holen (Administration)', 'yalst_text' ); ?></a>
							<? else: ?>
								<a href="https://en.livesupportserver.de" target="_blank" type="button" class="btn btn-warning wordpress"><? _e( 'Code holen (Administration)', 'yalst_text' ); ?></a>
							<? endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php
	}
}