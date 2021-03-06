<?php
/**
 * Functions to display settings fields inside of admin
 */

 /**
  * Display url field
  *
  * @return HTML
  */
function jamstackPreviewAndDeploymentsFieldUrl($args = [])
{
    ?>
    <div>
        <input type="url" class="regular-text" name="<?php echo esc_attr($args['name']);?>" value="<?php echo esc_url($args['value']);?>">
        <?php echo !empty($args['description']) ? "<p class=\"description\">{$args['description']}</p>" : '';?>
    </div>
    <?php
}

/**
 * Display text field
 *
 * @return HTML
 */
function jamstackPreviewAndDeploymentsFieldText($args = [])
{
    ?>
    <div>
        <input type="text" class="regular-text" name="<?php echo esc_attr($args['name']);?>" value="<?php echo esc_attr($args['value']); ?>">
        <?php echo !empty($args['description']) ? "<p class=\"description\">{$args['description']}</p>" : '';?>
    </div>
    <?php
}

/**
 * Display select boxes
 *
 * @return HTML
 */
function jamstackPreviewAndDeploymentsFieldSelect($args = [])
{   
    ?><div>
        <select name="<?php echo esc_attr($args['name']);?>">
            <?php foreach ($args['choices'] as $k => $v): ?>
                <option value="<?php echo esc_attr($k);?>" <?php echo selected($k, $args['value']);?>><?php echo $v; ?></option>
            <?php endforeach;?>
        </select>
        <?php echo !empty($args['description']) ? "<p class=\"description\">{$args['description']}</p>" : '';?>
    </div><?php
}

/**
 * Display checkboxes
 *
 * @return HTML
 */
function jamstackPreviewAndDeploymentsFieldCheckboxes($args = [])
{
    $args['value'] = is_array($args['value']) ? $args['value'] : [$args['value']];?>
    <fieldset>
        <legend class="screen-reader-text"><?php echo $args['legend']; ?></legend>
        <?php foreach ($args['choices'] as $k => $v): ?>
            <label>
                <input type="checkbox"
                    name="<?php echo esc_attr("{$args['name']}[]");?>"
                    value="<?php echo esc_attr($k);?>"
                    <?php echo checked(true, in_array($k, $args['value'], true));?>
                />
                <?php echo "$v<span class='screen-reader-text'>, the key/name is </span> <code>{$k}</code>"; ?>
            </label><br />
        <?php endforeach;?>
        <?php echo !empty($args['description']) ? "<p class=\"description\">{$args['description']}</p>" : '';?>
    </fieldset>
    <?php
}

/**
 * Display divider
 *
 * @return HTML
 */
function jamstackPreviewAndDeploymentsLineDivider()
{
    ?>
    <hr>
    <?php
}