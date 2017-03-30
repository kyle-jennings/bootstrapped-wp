<?php


/**
* This is the layout class. It builds the main content shit
*/
class Layout {

    public $output = '';
    private $template;
    public $site_settings;
    public $sidebar;

    public function __construct(){
        $this->site_settings = get_option('bswp_site_settings');
        $this->getTemplateType();
        $this->sidebarPosition();


    }

    public function __toString(){
        $this->output = $this->scaffolding_init();
        return $this->output;
    }

    public function is_body_contained() {
        $layout = $this->site_settings['misc']['layout'];
        $full_width = ($layout['full_width'] == 'no') ? true : false;

        return $full_width;
    }


    public function contain_section() {
        $contained = $this->is_body_contained();
        return $contained ? '' : 'container';
    }

    public function scaffolding_init(){

        $content = new Content();
        $content::set_template($this->template);

        $template = $this->template;

        $output = '';


        $width = in_array($this->sidebar->position, array('left', 'right')) ? 'span9' : 'span12';

        // get the title
        // $output .= $this->get_the_title();

        //start scaffolding
        $output .= '<div id="body" class="section section--body '.$confineClass.'">';
        $output .= '<div class="'.$this->contain_section().'">';
        $output .= '<div class="row">';

        /* ----------------- top or left sidebar ------------------- */
        if($this->sidebar->position =='top' || $this->sidebar->position =='left')
            $output .= new Sidebar($this->template, $this->sidebar->position, $this->sidebar->visibility);


        //content div
        $output .= '<div id="main-content" class="'.$width.'">';

        /* ---------------------- The Loop ----------------------- */
        if (have_posts()){

            if($pagination_top == 'true'){
                $output .= new Pagination();
            }

            //open content-list/single wrapper
            if( !is_single() && !is_page() && !is_attachment() ){
                $output .= '<div class="content-list">';
            }else{
                $output .= '<div class="content-single">';
            }
            while (have_posts()){

                the_post();
                $output .= $content;

            }

            //close content-list/single wrapper
            $output .= '</div>';

            // pagination
            $output .= new Pagination();

        }else{
            $output .= '<div class="content-wrapper">';
                $output .= kjd_the_404();
            $output .= '</div>';
        }
        /* ---------------------- End Loop ----------------------- */

        //end main content
        $output .= '</div>'; // end maincontent span

        /* ----------------- right or bottom sidebar ------------------- */
        if($this->sidebar->position =='bottom' || $this->sidebar->position =='right')
            $output .= new Sidebar($this->template, $this->sidebar->position, $this->sidebar->visibility);



        // close scaffolding

        $output .= '</div>';//	<!-- end row -->
        $output .= '</div>';// <!-- end container -->
        $output .= '</div>'; //<!-- end body -->


        return $output;

    }


    public function sidebarPosition()
    {
        $layouts = $this->site_settings['layouts'];
        $sidebars = $layouts['sidebars'];

        // examine($sidebars);

        foreach($sidebars as $name=>$sidebar){

            if(strpos($name, $this->template) !== false) {
                $this->sidebar = json_decode($sidebar);
            }

        }
    }

    /**
    * This detects the current page's/post's /feed's template and gets teh layout settings appropriately
    * Layout settings for now, are nothing more than the position of the sidebar, as well as sidebar visibility.
    *
    * @param  [type] $template [description]
    * @return [type]           [description]
    */
    public function getTemplateType() {

        //	if the page is a post type

        if( is_single() ){

            $template = 'single';

        }elseif( is_attachment() ){

            // $template = 'attachment';
            $template = 'single';

        }elseif( is_404() ){

            // $template = '404';
            $template = 'single';

        }elseif( is_feed() ){
            $template = is_feed();

        }elseif( is_front_page() ){

            $template = 'front_page';

        }elseif( is_page() ){

            $template = 'single';
            // if current page is page template
            if( is_page_template() )
            $template = $this->isPageTemplate();

            //fallback - if not a post template OR a page
        }else{

            $template = 'feed';
        }

        $this->template = $template;

    }


    public function isFeed()
    {
        if( is_category() ){
            // $template = 'category';
            $template = 'feed';
        }elseif( is_archive() ){
            // $template = 'archive';
            $template = 'feed';
        }elseif( is_tag() ){
            // $template = 'tag';
            $template = 'feed';
        }elseif( is_author() ){
            // $template = 'author';
            $template = 'feed';
        }elseif( is_date() ){
            // $template = 'date';
            $template = 'feed';
        }elseif( is_search() ){
            // $template = 'search';
            $template = 'feed';
        }

        return $template;
    }

    public function isPageTemplate()
    {

        $is_page_template = true;

        if ( is_page_template('pageTemplate1.php') ){

            $template = 'template_1';

        }elseif( is_page_template('pageTemplate2.php') ){

            $template = 'template_2';

        }elseif( is_page_template('pageTemplate3.php') ){

            $template = 'template_3';

        }elseif( is_page_template('pageTemplate4.php') ){

            $template = 'template_4';

        }elseif( is_page_template('pageTemplate5.php') ){

            $template = 'template_5';

        }elseif( is_page_template('pageTemplate6.php') ){

            $template = 'template_6';

        }else{

            $template = 'page';
        }

    }

}
