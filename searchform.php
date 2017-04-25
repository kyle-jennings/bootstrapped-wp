<?php
// searchform.php
?>
<form method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-append">
        <input id="s" class="span2" type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'the-bootstrap' ); ?>"><!--
     --><button class="btn btn-primary" name="submit" id="searchsubmit" type="submit"><?php _e( 'Go', 'the-bootstrap' ); ?></button>
    </div>

</form>
