<!-- This file is used to markup the administration form of the widget. -->
<div class="wrapper">
    <fieldset>
        <legend>
            PROFFIX E-Newsletter Widget
        </legend>

        <div class="option">
            <label for="px_title">
                Titel
            </label>
            <input type="text" id="<?php echo $this->get_field_id('px_title'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('px_title')); ?>"
                   value="<?php echo esc_attr( $px_title ); ?>" class=""/>
        </div>

        <div class="option">
            <label for="px_description">
               Beschreibung
            </label>
            <input type="text" id="<?php echo $this->get_field_id('px_description'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('px_description')); ?>"
                   value="<?php echo esc_attr( $px_description ); ?>" class=""/>
        </div>

        <div class="option">
            <label for="px_url">
                E-Newsletter URL
            </label>
            <input type="text" id="<?php echo $this->get_field_id('px_url'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('px_url')); ?>" value="<?php echo esc_attr( $px_url ); ?>"
                   class=""/>
        </div>

        <div class="option">
            <label for="px_db">
                PROFFIX Datenbank
            </label>
            <input type="text" id="<?php echo $this->get_field_id('px_db'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('px_db')); ?>" value="<?php echo esc_attr( $px_db ); ?>"
                   class=""/>
        </div>

        <div class="option">
            <label for="px_list">
                E-Newsletter Liste
            </label>
            <input type="text" id="<?php echo $this->get_field_id('px_list'); ?>"
                   name="<?php echo esc_attr($this->get_field_name('px_list')); ?>" value="<?php echo esc_attr( $px_list ); ?>"
                   class=""/>
        </div>


    </fieldset>
</div><!-- /wrapper -->