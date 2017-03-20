<?php

/**
 * This builds the entire page, including the header and footer
 */
class Scaffolding {
    public $output = '';
	public function __construct(){
        $layout = new Layout;
		ob_start();
			get_header();
				echo $layout->kjd_scaffolding_init();
			get_footer();

			$this->output = ob_get_contents();
		ob_end_clean();

		echo $this->output;
	}

}
