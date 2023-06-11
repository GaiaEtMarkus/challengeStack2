<form method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?>" enctype="multipart/form-data">
    <?php foreach ($config["inputs"] as $name => $input): ?>
        <?php if ($input["type"] == "select"): ?>
            <select name="<?= $name; ?>">
                <?php foreach ($input["options"] as $option): ?>
                    <?php $selected = $option["selected"] ? "selected" : ""; ?>
                    <option value="<?= $option['value'] ?>" <?= $selected ?>><?= $option['value'] ?></option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <input name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder="<?= $input["placeholder"] ?>" <?= $input["required"] ? "required" : "" ?>>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
</form>
