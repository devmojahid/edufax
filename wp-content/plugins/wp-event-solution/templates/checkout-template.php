<?php 

if( wp_is_block_theme() ){
    block_header_area();
    wp_head();
}else{
    get_header();
}
?>

<div id="eventin-checkout" style="width: 100%;"></div>

<?php 
    if( wp_is_block_theme() ){
        block_footer_area();
        wp_footer();
    }else{
        get_footer();
    }
?>
 