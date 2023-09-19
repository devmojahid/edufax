<?php
/**
 * Select
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php if(!isset($row_db_value)): ?>
<select 
    name="<?php echo esc_attr($id); ?>" 
    id="<?php echo esc_attr($id); ?>-select" 
    class="<?php echo esc_attr($id); ?> tm-select-field">
    <option value="<?php echo esc_html($default)?? '-1'; ?>"><?php echo esc_html($placeholder)?? 'Select...'; ?></option>
    <?php //var_dump(esc_attr($id)); ?>
    <?php foreach($options as $key => $val): ?>
        <option 
            value="<?php echo esc_html($key); ?>" 
            <?php selected(tpmeta_field($id), $key); ?>><?php echo esc_html($val); ?>
        </option>
    <?php endforeach; ?>
</select>
<?php else: 
$bind_keys = isset($bind)? $bind : '';    
?>
<select 
    name="<?php echo esc_attr($id); ?>[]"
    data-key="<?php echo esc_attr($bind_keys); ?>"
    class="<?php echo esc_attr($id); ?> tm-repeater-select-field tm-repeater-conditional">
    <option value="<?php echo esc_html($default)?? '-1'; ?>"><?php echo esc_html($placeholder)?? 'Select...'; ?></option>
    <?php foreach($options as $key => $val): ?>
        <option 
            value="<?php echo esc_html($key); ?>" 
            <?php selected(esc_html($row_db_value), $key); ?>><?php echo esc_html($val); ?>
        </option>
    <?php endforeach; ?>
</select>
<?php endif; ?>