{*
* PrestaShop module created by VEKIA, a guy from official PrestaShop community ;-)
*
* @author    VEKIA https://www.prestashop.com/forums/user/132608-vekia/
* @copyright 2010-2016 VEKIA
* @license   This program is not free software and you can't resell and redistribute it
*
* CONTACT WITH DEVELOPER
* support@mypresta.eu
*}

{if Configuration::get('cmsproducts_hide')!=1}
    {if $feedtype == 'noProducts'}
        <p class="alert alert-warning">{l s='No products available in this feed.' d='Modules.CmsProducts.Shop'}</p>
    {elseif $feedtype != 'error'}
        <section class="featured-products">
            <div class="products">
                {foreach from=$products item="product"}
                    {include file="catalog/_partials/miniatures/product.tpl" product=$product}
                {/foreach}
            </div>
        </section>
    {else}
        <p class="alert alert-warning">{l s='Feed of products is not available.' d='Modules.CmsProducts.Shop'} {l s='Module:' d='Modules.CmsProducts.Shop'} <a href="{if $module=="Related Products Pro"}https://mypresta.eu/modules/front-office-features/related-products-pro.html{elseif $module=="Homepage Products Pro"}https://mypresta.eu/modules/front-office-features/homepage-products-pro.html{/if}" target="_blank">{$module}</a> {l s='not found or version of this module is too old'  d='Modules.CmsProducts.Shop'}</p>
    {/if}
{/if}