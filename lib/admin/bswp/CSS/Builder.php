<?php

namespace bswp\css;
// use Leafo\ScssPhp;
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Exception;

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

class Builder {

    public $preview = false;
    public $section = array();
    public $values = array();

    public $bs_dir;
    public $bs_file;

    public $compiler = null;
    public $css = '';

    public $bootstrap_vars = '';

    public function __construct($section = null, $values = array()) {

        $this->initCompiler();

        $this->findBootstrapScssFile();
        // if a specific section and values were passed in, do the thing
        // this will only occure when generating a preview file
        if( !empty($section) && !empty($values) ){
            $this->section[] = $section;
            $this->values = $values;
            $this->preview = true;
        }else{
            $name = 'site_settings';
            $settings = get_option('bswp_'.$name);

            $this->section[] = $name;
            $this->values = $settings;
        }

        $this->setManifest();
        $this->initManifestFile();

        $this->setVariables();
        $this->initVarFile();

    }

    public function getSavedValues()
    {
        $name = 'site_settings';
        $settings = get_option('bswp_'.$name);

        return $settings;
    }


    public function setManifest() {

        $manifest_file = $this->bs_dir . 'manifest.php';
        require_once($manifest_file);

    }

    public function initManifestFile() {
        $file = $this->bs_dir . 'src/manifest.scss';
        file_put_contents($file, $this->bootstrap_manifest);

    }

    public function setVariables() {

        $var_file = $this->bs_dir . 'variables.php';
        require_once($var_file);

    }


    public function initVarFile() {
        $file = $this->bs_dir . 'src/settings/_variables.scss';

        file_put_contents($file, $this->bootstrap_vars);

    }

    public function getSectionName($section = null) {
        $section = $section ? $section : 'site_settings';
        switch($section):
            case 'site_settings';
                return '.page-wrapper';
                break;
            default:
                return '.page-wrapper';
                break;
        endswitch;
    }



    // create new compiler object
    public function initCompiler() {

        $this->admin_dir = dirname(dirname(dirname(__FILE__)));

        $root_dir = dirname($this->admin_dir);
        $uploads_dir = wp_upload_dir();
        $uploads_dir = $uploads_dir['basedir'];

        $this->preview_dir = $uploads_dir . '/bswp/preview-assets/css';
        $this->dist_dir = $uploads_dir . '/bswp/assets/css';

        $this->compiler = new compiler();

    }


    // finds the bootstrap scss file
    public function findBootstrapScssFile() {

        // set directory
        $bs_dir = dirname(dirname(__FILE__));
        $bs_dir .= '/CSS/bootstrap/';

        $this->bs_dir = is_dir($bs_dir) ? $bs_dir : null ;

        // set fbase bs ilename
        $filename = 'src/manifest.scss';
        $this->bs_file = is_readable($bs_dir . $filename) ? $filename : null;


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


        $this->compiler->setImportPaths($this->bs_dir.'src');


        $file = file_get_contents( $this->bs_dir . $this->bs_file );
        $this->css = $this->compiler->compile($file);

    }



    public function delete_preview_css_file($target = 'preview'){
        $target_dir = $target.'_styles';
        $filename = ($target == 'dist') ? 'site' : 'preview';
        $file = $this->$target_dir.'/'.$filename.'.css';

        if(is_readable($file))
            unlink($file);
    }





    /**
     * Saves the compiled CSS to a file in either the admin section or the public Section
     * the admin section file is used for the preview window
     *
     * The public section file is used to render the site and should be minimized
     */
    public function saveToFile($target) {
        $folder = $target.'_dir';
        $filename = ($target == 'dist') ? 'site' : 'preview';
        $filename.= '.css';

        $result = $this->saveFile($this->$folder, $filename, $this->css);
    }



    function saveFile($folderPath, $filename, $filecontent){

        if (strlen($filename)>0){

            if (!file_exists($folderPath)) {

                mkdir($folderPath, 0777, true);
            }

            $file = @fopen($folderPath . '/' . $filename,"w");
            if ($file != false){
                fwrite($file,$filecontent);
                fclose($file);
                $this->sideLoadAndClean($filename, $folderPath);
                return 1;
            }
            return -2;
        }
        return -1;
    }

    function sideLoadAndClean($filename, $folderPath)
    {
      $current_user = wp_get_current_user();
      $id = $current_user->ID;


      $path = wp_upload_dir()['baseurl'].'/bswp/assets/css/'. $filename;


      $status = $this->sideloadFile($path, $id);

      if(!is_wp_error($status)){
          unlink($folderPath . '/' . $filename);
          $oldfile = get_option('css-url', true);
          wp_delete_attachment($oldfile['id'], true);
          update_option('css-url', $status, 'true');

      }else{
          $this->status = $status;
          add_action( 'admin_notices', array($this,'error') );
      }

    }


    function sideloadFile( $file, $post_id) {
        if ( ! empty( $file ) ) {

            // Set variables for storage, fix file filename for query strings.
            preg_match( '/[^\?]+\.(css)\b/i', $file, $matches );
            if ( ! $matches ) {
                return new WP_Error( 'image_sideload_failed', __( 'Invalid URL' ) );
            }

            $file_array = array();
            $file_array['name'] = basename( $matches[0] );

            // Download file to temp location.
            $file_array['tmp_name'] = download_url( $file );

            // If error storing temporarily, return the error.
            if ( is_wp_error( $file_array['tmp_name'] ) ) {
                return $file_array['tmp_name'];
            }

            // Do the validation and storage stuff.
            $id = media_handle_sideload( $file_array, $post_id, $desc );

            // If error storing permanently, unlink.
            if ( is_wp_error( $id ) ) {
                @unlink( $file_array['tmp_name'] );
                return $id;
            }else{
                $old_css_file = get_option('css-url', true);
            }

            $src = wp_get_attachment_url( $id );
        }

        // Finally, check to make sure the file has been saved, then return the HTML.
        if ( ! empty( $src ) ) {
            return array(
                'src'=>$src,
                'id'=>$id
            );

        } else {
            return new WP_Error( 'image_sideload_failed' );
        }
    }


    public function error()
    {
        ?>
            <div class="update-nag notice">
                <p>
                    Something has gone wrong..please try again.
                </p>
            </div>
        <?php
    }
}
