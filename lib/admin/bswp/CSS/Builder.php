<?php

namespace bswp\css;
// use Leafo\ScssPhp;
use Leafo\ScssPhp\Compiler;

class Builder {

    public $section = 'site';
    private $values = array();

    public $bs_dir;
    public $bs_file;
    public $bs_responsive_file;

    public $compiler = null;
    public $css = '';

    public $bootstrap_vars = '';

    public function __construct($section = 'site', $values = array() ) {

        $this->section = $section;
        $this->values = $values;

        $this->initCompiler();
        $this->findBootstrapScssFile();
        $this->set_variables();
        $this->init_bootstrap_var_file();
    }


    public function set_variables() {

        $var_file = dirname(__FILE__) . '/variables.php';

        require_once($var_file);

    }


    // create new compiler object
    public function initCompiler() {

        $this->admin_dir = dirname(dirname(dirname(__FILE__)));

        $root_dir = dirname($this->admin_dir);

        $this->preview_styles = $this->admin_dir . '/styles';
        $this->dist_styles = $root_dir . '/styles';

        $this->compiler = new compiler();

    }


    // finds the bootstrap scss file
    public function findBootstrapScssFile() {

        // set directory
        $bs_dir = dirname(dirname(__FILE__));
        $bs_dir .= '/CSS/bootstrap/assets/stylesheets/';

        $this->bs_dir = is_dir($bs_dir) ? $bs_dir : null ;

        // set fbase bs ilename
        $filename = 'bootstrap.scss';
        $this->bs_file = is_readable($bs_dir . $filename) ? $filename : null;


        // sets responive bs filename
        $filename = 'bootstrap-responsive.scss';
        $this->bs_responsive_file = is_readable($bs_dir . $filename) ? $filename : null;

    }


    // gets the compiled path for the bootstrap file
    public function path_to_bs_file($target = 'bs') {
        $file = $target.'_file';


        return $this->bs_dir . $this->$file;
    }


    /**
     * Builds the CSS
     * @return [type] [description]
     */
    public function build() {

        $this->compiler->setImportPaths($this->bs_dir);


        $file = file_get_contents( $this->path_to_bs_file() );
        $this->css = $this->compiler->compile($file);

        $file = file_get_contents( $this->path_to_bs_file('bs_responsive') );
        $this->css .= $this->compiler->compile($file);

    }


    public function init_bootstrap_var_file() {
        $file = $this->bs_dir . 'bootstrap/_variables.scss';
        // examine($file);
        file_put_contents($file, $this->bootstrap_vars);
        // examine(file_get_contents($file) );
    }


    /**
     * Saves the compiled CSS to a file in either the admin section or the public Section
     * the admin section file is used for the preview window
     *
     * The public section file is used to render the site and should be minimized
     */
    public function save_to_file($target) {
        $target_dir = $target.'_styles';
        $newfile = $this->$target_dir.'/site.css';

        $fh = fopen($newfile, 'w') or die("Can't create file");
        fwrite($fh, $this->css);
        // file_put_contents($this->preview_styles.'preview.css', $this->css);
    }
}
