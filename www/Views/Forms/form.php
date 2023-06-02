<form method="<?= $config["config"]["method"]??"GET" ?>" action="<?= $config["config"]["action"] ?>">

    <?php 
foreach ($config["inputs"] as $name => $input):
    if($input["type"] == "select"):
?>
        <select name="<?= $name;?>">
            <?php 
            foreach ($input["options"] as $option):
                $selected = $option["selected"] ? "selected" : "";
                echo "<option value='{$option['value']}' $selected>{$option['value']}</option>";
            endforeach;
            ?>
        </select>
    <?php 
        else: 
    ?>
            <input name="<?= $name;?>" type="<?= $input["type"]?>" 
            placeholder=" <?= $input["placeholder"]?>" 
            <?php if($isModifyForm) echo "value=\"{$input['value']}\""; ?>>
    <?php 
        endif;
    endforeach; 
    ?>

    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
</form>
