<?php

namespace Vanderbilt\AddressExternalModule;

use ExternalModules\AbstractExternalModule;
use REDCap;

class AddressExternalModule extends AbstractExternalModule
{
	public function redcap_every_page_top($project_id) {
		if ($project_id && PAGE !== "surveys/index.php") {
			$moduleConfig = $this->getConfig();

			$alertText = 'The \"[DISABLED_MODULE]\" External Module has been disabled</strong> due to a found security vulnerability. Please contact your administrator if this is blocking work. To remove this notice disable the module on this project from the \"External Modules - Project Module Manager\" page.';

			$alertText = str_replace('[DISABLED_MODULE]', $this->escape($moduleConfig['name']), $alertText);

			$alertHTML = '<div style="margin: 0 0 0 -20px; padding: 20px;"><div class="yellow" style="max-width: 800px;"><span class="fas fa-exclamation-triangle"></span> <strong>'.$alertText.'</div></div>';

			ob_start();
			?>
				<script>
					$(document).ready(function() {
						$('#center').prepend('<?php echo $alertHTML; ?>');
					});
				</script>
			<?php
			$alert = ob_get_contents();
			ob_end_clean();
			echo $alert;
		}
	}

}
