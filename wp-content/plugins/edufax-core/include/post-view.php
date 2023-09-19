<?php



function shofy_blog_single_social()
{
   $post_url = get_the_permalink();
?>
   <span><?php echo esc_html__('Share On:', 'mscore'); ?></span>
   <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>" target="_blank"><i class="fab fa-linkedin ms-linkedin"></i></a>
   <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url); ?>" target="_blank""><i class=" fab fa-facebook ms-facebook"></i></a>
   <a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank"><i class="fab fa-twitter ms-twitter"></i></a>
<?php return false;
}

// shofy_product_single_social
function shofy_product_single_social()
{
   $post_url = get_the_permalink();
?>
   <div class="ms-product-details-social">
      <span><?php echo esc_html__('Share:', 'mscore'); ?> </span>
      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>

   </div>

<?php return false;
}
