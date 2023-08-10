1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
<?php if (isset($data)) : ?>
    <?php
    //setup some variables for readability
    $_include_margin = (bool)se($data, "include_margin", true, false);
    $_label = se($data, "label", "", false);
    $_id = se($data, "id", uniqid(), false);
    $_type = se($data, "type", "text", false);
    $_placeholder = se($data, "placeholder", "", false);
    $_value = se($data, "value", "", false);
    $_name = se($data, "name", "", false);
    $_non_stanard_types = ["select", "radio", "checkbox", "toggle", "switch", "range", "textarea"]; //add more as necessary
    $_rules = isset($data["rules"])?$data["rules"]:[];// Can't use se() here since se() doesn't support returning complex data types (i.e., arrays);
    //map rules to key="value"
    $_rules = array_map(function($key, $value) {
        //used to convert html attributes that don't require a value like required, disabled, readonly, etc
        if($value === true){
            return $key;
        }
        return $key . '="' . $value . '"';
    }, array_keys($_rules), $_rules);
    //convert array to a space separate string
    $_rules = implode(" ", $_rules);
    ?>
    <?php /* Include margin open tag */ ?>
    <?php if ($_include_margin) : ?>
        <div class="mb-3">
        <?php endif; ?>
        <?php if ($_label) : ?>
            <?php /* label field */ ?>
            <label class="form-label" for="<?php se($_id); ?>"><?php se($_label); ?></label>
        <?php endif; ?>

        <?php if (!in_array($_type, $_non_stanard_types)) : ?>
            <?php /* input field */ ?>
            <input type="<?php se($_type); ?>" name="<?php se($_name); ?>" class="form-control" id="<?php se($_id); ?>" value="<?php se($_value); ?>" placeholder="<?php se($_placeholder); ?>" 
            <?php echo $_rules;?> />
        <?php elseif($_type === "textarea"):?>
            <textarea class="form-control" name="<?php se($_name); ?>" id="<?php se($_id); ?>" placeholder="<?php se($_placeholder); ?>" <?php echo $_rules;?>><?php se($_value);?></textarea>
        <?php elseif ($_type === "TBD type") : ?>
            <?php /* TODO other non-form-control elements */ ?>
        <?php endif; ?>
        <?php /* Include margin close tag */ ?>
        <?php if ($_include_margin) : ?>
        </div>
    <?php endif; ?>
    <?php
    //cleanup just in case this is used directly instead of via render_button()
    // if it's used from the function, the variables will be out of scope when the function is done so there'd be no need to unset them
    unset($_include_margin);
    unset($_label);
    unset($_id);
    unset($_type);
    unset($_placeholder);
    unset($_value);
    unset($_name);
    ?>
<?php endif; ?> ```

