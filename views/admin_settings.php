<div class="wrap">
    <form method="post">
        <div id="icon-options-general" class="icon32"></div>
        <h2>PROFFIX E-Newsletter</h2>
        <?php settings_errors(); ?>

        <div id="poststuff">

            <div id="post-body" class="metabox-holder columns-2">

                <!-- main content -->
                <div id="post-body-content">

                    <div class="meta-box-sortables ui-sortable">

                        <div class="postbox">
                            <h3><span>Shortcode</span></h3>
                            <div class="inside">
                                <p>Folgender Shortcode zeigt das PROFFIX E-Newsletter Formular an.</p>
                                <code>[proffixnewsletter]</code>
                                <p>Ohne weitere Angaben wird dabei wird die Standardkonfiguration verwendet.</p>
                                <p>Der Shortcode kann aber mittels folgender Tags individualisiert werden.</p>
                                <code>[proffixnewsletter url="https://..." db="DEMODB" list="STD"]</code>


                            </div> <!-- .inside -->

                        </div> <!-- .postbox -->

                        <div class="postbox">
                            <h3><span>Formulare</span></h3>
                            <div class="inside">
                                <p></p>
                                <table class="form-table" id="configure">
                                    <tbody>

                                    <tr valign="top">
                                        <th scope="row">Name erfassen</th>
                                        <td>
                                            <select name="proffix_newsletter_default_show_name" class="large-text">
                                                <option value='1' <?php selected(get_option("proffix_newsletter_default_show_name"), 1, true); ?>>
                                                    Ja
                                                </option>
                                                <option value='0' <?php selected(get_option("proffix_newsletter_default_show_name"), 0, true); ?>>
                                                    Nein
                                                </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Beschreibung</th>
                                        <td>
                                            <input name="proffix_newsletter_default_description" id="" type="text"
                                                   value="<?php echo (empty(!get_option("proffix_newsletter_default_description")) ? get_option("proffix_newsletter_default_description") : 'Melden Sie sich für unseren Newsletter an.' ) ?>"
                                                   class="large-text"/>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Erfolgreiche Anmeldung</th>
                                        <td>
                                            <input name="proffix_newsletter_settings_success" id="" type="text"
                                                   value="<?php echo (empty(!get_option("proffix_newsletter_settings_success")) ? get_option("proffix_newsletter_settings_success") : 'Sie haben sich erfolgreich für den Newsletter angemeldet.' ); ?>"
                                                   class="large-text"/>
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">Anmeldung mit Fehlern</th>
                                        <td>
                                            <input name="proffix_newsletter_settings_error" id="" type="text"
                                                   value="<?php echo (empty(!get_option("proffix_newsletter_settings_error")) ? get_option("proffix_newsletter_settings_error") : 'Zurzeit gibt es technische Probleme mit dem Newsletter. Kontaktieren Sie uns doch einfach.' ); ?>"
                                                   class="large-text"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> <!-- .inside -->
                        </div> <!-- .postbox -->
                        <div class="postbox">
                            <h3><span>Standardkonfiguration</span></h3>
                            <div class="inside">
                                <p></p>
                                <table class="form-table" id="configure">
                                    <tbody>
                                    <tr valign="top">
                                        <th scope="row">E-Newsletter Service</th>
                                        <td>
                                            <input name="proffix_newsletter_default_url" id="" type="text" placeholder="z.B. https://newsletter.pitw.ch:123/pxNewsletter.asmx"
                                                   value="<?php echo get_option("proffix_newsletter_default_url"); ?>"
                                                   class="large-text"/>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                        <th scope="row">PROFFIX Datenbank</th>
                                        <td>
                                            <input name="proffix_newsletter_default_db" id="" type="text" placeholder="z.B. DEMODB"
                                                   value="<?php echo get_option("proffix_newsletter_default_db"); ?>"
                                                   class="large-text"/>
                                        </td>
                                    </tr>

                                    <tr valign="top">
                                        <th scope="row">Newsletterlisten</th>
                                        <td>
                                            <input name="proffix_newsletter_default_list" id="" type="text" placeholder="z.B. STD"
                                                   value="<?php echo get_option("proffix_newsletter_default_list"); ?>"
                                                   class="large-text"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div> <!-- .inside -->

                        </div> <!-- .postbox -->


                    </div> <!-- .meta-box-sortables .ui-sortable -->

                </div> <!-- post-body-content -->

                <!-- sidebar -->
                <div id="postbox-container-1" class="postbox-container">

                    <div class="meta-box-sortables">

                        <div class="postbox">

                            <div class="inside">
                                <?php submit_button($text = null, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null) ?>
                            </div> <!-- .inside -->

                        </div> <!-- .postbox -->

                    </div> <!-- .meta-box-sortables -->

                </div> <!-- #postbox-container-1 .postbox-container -->

            </div> <!-- #post-body .metabox-holder .columns-2 -->

            <br class="clear">
        </div> <!-- #poststuff -->
    </form>
</div> <!-- .wrap -->