<div class="proffixnewsletter" data-showon="substitute">
    <?php $formID = uniqid('form_proffixnewsletter-'); ?>
    <form method='POST' id='submit_proffixnewsletter' class='<?php echo $formID ?>'>
    	<input name="proffixnewsletter[info]" type="hidden"
                   value="<?php echo base64_encode(($attr['url'] . "," . $attr['db'] . "," . $attr['list'])) ?>"
                   class="pxnewsletter-field-info">
        <?php
        if (get_option('proffix_newsletter_default_show_name') == 1) {
            ?>
            <fieldset class='pxnewsletter-field pxnewsletter-field-name'>
                <input name='proffixnewsletter[name]' type='text' placeholder='Name'/>
            </fieldset>
            <?php
        } ?>
        <fieldset class='pxnewsletter-field pxnewsletter-field-email'>
            <input name='proffixnewsletter[email]' type='email' placeholder='Email'/>
        </fieldset>
        <br>
        <input type="submit" value="Anmelden" class='pxnewsletter-field-submit'/>
    </form>
    <div class="proffixnewsletter_spinner" style="display:none;">
        <img src="<?php echo esc_url(plugins_url('../images/loading_spinner.gif', __FILE__)) ?>" style="margin-left:45%;">
    </div>
</div>
<script>
    initProffixNewsletter('.<?php echo $formID; ?>');
</script>