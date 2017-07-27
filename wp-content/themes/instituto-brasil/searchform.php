<form role="search" class="sideform" method="get" action="<?php echo esc_url(home_url()); ?>">
    <fieldset>
        <input type="text" name="s" placeholder="Pesquisar..." class="sidetext" size="15"
               title="<?php esc_attr_e('Search', 'adelle-theme'); ?>"/>
        <button type="submit"><span class="fontawesome-search"></span></button>
    </fieldset>
</form>