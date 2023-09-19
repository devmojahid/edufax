<?php
/**
 * Repeater Group
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( !empty($field['conditional']) ){
    if(isset($row)){
        $compare_results = tpmeta_is_row_matched($field['conditional'], $row);
    }else{
        $compare_results = tpmeta_is_condition_matched($field['conditional'], $fields);
    }
}else{
    $compare_results = true;
}

$format = get_post_format() ? : 'standard';
$field['row_db_value']  = isset($row_db_value)? esc_html($row_db_value) : '';
$field['field_type']    = isset($field_type)? esc_html($field_type) : '';
?>

<?php if(isset($post_format) && $post_format != ""): ?>
<div data-operand="<?php echo !empty($field['conditional'])? esc_attr($field['conditional'][1]) : ''; ?>" data-value="<?php echo !empty($field['conditional'])? esc_attr($field['conditional'][2]) : ''; ?>" class="tm-field-row <?php echo esc_attr(esc_html($field['id'])); ?>" style="display:<?php echo !$compare_results || ($format != $post_format)? 'none' : 'block'; ?>">
    <label><?php echo esc_html($field['label']); ?></label>
    <?php tpmeta_load_template('metaboxes/fields/'.$field['type'].'.php', $field); ?>
</div>
<?php else: ?>
<div data-operand="<?php echo !empty($field['conditional'])? esc_attr($field['conditional'][1]) : ''; ?>" data-value="<?php echo !empty($field['conditional'])? esc_attr($field['conditional'][2]) : ''; ?>" class="tm-field-row <?php echo esc_attr(esc_html($field['id'])); ?>" style="display:<?php echo !esc_html($compare_results)? 'none' : 'block'; ?>">
    <label><?php echo esc_html($field['label']); ?></label>
    <?php tpmeta_load_template('metaboxes/fields/'.$field['type'].'.php', $field); ?>
</div>
<?php endif; ?>