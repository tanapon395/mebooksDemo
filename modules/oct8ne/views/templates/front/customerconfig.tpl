<br>
<form id="module_form_1" class="defaultForm form-horizontal" action="{$SUBMIT}" method="post" enctype="multipart/form-data" novalidate="">

    <input type="hidden" name="oct_options_changed" value="1">

    <div class="panel" style="border: none">

        <div class="panel-heading"> <i class="icon-cogs"></i> {l s='Configuracion básica -  Oct8ne' mod='oct8ne'} </div>
        <br>

        <div class="form-wrapper">

            <div class="form-group">

                <label class="control-label col-lg-3 required">
                    {l s='Position' mod='oct8ne'}
                </label>


                <div class="col-lg-9">

                    <select name="{$POSITION_LOAD_NAME}" class=" fixed-width-xl">
                        <option value="1" {if $POSITION_LOAD==1}selected{/if}>{l s='On Header' mod='oct8ne'}</option>
                        <option value="2" {if $POSITION_LOAD==2}selected{/if}>{l s='On Footer' mod='oct8ne'}</option>
                    </select>

                    <p class="help-block"> {l s='Puede elegir donde cargar los scripts de oct8ne: En el footer o en el header de su página' mod='oct8ne'} </p>
                </div>
            </div>


            <div class="form-group">

                <label class="control-label col-lg-3 required"> {l s='Tipo de de Imagenes' mod='oct8ne'} </label>


                <div class="col-lg-9">

                    <select name="{$URL_IMG_TYPE_NAME}" class="fixed-width-xl">
                        <option value="1" {if $URL_IMG_TYPE==1}selected{/if}>{l s='Standardar' mod='oct8ne'}</option>
                        <option value="2" {if $URL_IMG_TYPE==2}selected{/if}>{l s='Type 1' mod='oct8ne'}</option>
                    </select>

                    <p class="help-block"> {l s='Tipo 1 añade el id del producto por delante de la id de la imagen. Útil en casos específicos. Cuidado, modifica esta opción sólo si es necesario' mod='oct8ne'} </p>

                </div>

            </div>

        </div>

            <button type="submit" value="1" name="oct_options_changed" class="btn btn-default pull-right"> <i class="icon-save"></i> {l s='Guardar' mod='oct8ne'}</button>
    </div>

</form>


{if count($SEARCH_ENGINES) > 1}

<form class="defaultForm form-horizontal" action="{$SUBMIT}" enctype="multipart/form-data" style="margin-top: 70px" method="post">

    <input type="hidden" name="oct_search_engine_changed" value="1">

    <div class="panel" style="border: none">

        <div class="panel-heading">
            <i class="icon-cogs"></i>	{l s='Motor de búsqueda - Oct8ne' mod='oct8ne'}
        </div>

        <div class="form-wrapper">

            <div class="form-group">

                <label class="control-label col-lg-3 required">
                    {l s='Motor' mod='oct8ne'}
                </label>

                <div class="col-lg-9">

                    <select name="{$SEARCH_ENGINE_NAME}" class=" fixed-width-xl">

                        {foreach from=$SEARCH_ENGINES item=item key=key}
                            <option value="{$key}" {if $SEARCH_ENGINE==$key}selected{/if} >{l s=$item mod='oct8ne'}</option>
                        {/foreach}

                    </select>

                    <p class="help-block"> {l s='Motor de busqueda a usar' mod='oct8ne'} </p>

                </div>
            </div>
        </div>

        <br>
        <br>

            <button type="submit" value="1" id="module_form_submit_btn_1" name="oct_search_engine_changed" class="btn btn-default pull-right">
                <i class="icon-fire"></i> {l s='Guardar' mod='oct8ne'}
            </button>

    </div>

</form>

{/if}
