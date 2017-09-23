/**
 * PrestaShop module created by VEKIA, a guy from official PrestaShop community ;-)
 *
 * @author    VEKIA https://www.prestashop.com/forums/user/132608-vekia/
 * @copyright 2010-2016 VEKIA
 * @license   This program is not free software and you can't resell and redistribute it
 *
 * CONTACT WITH DEVELOPER http://mypresta.eu
 * support@mypresta.eu
 */

$(document).ready(function () {
    $('a[data-link]').each(function () {
        if ($(this).attr('data-author-name')) {
            var author = $(this).attr('data-author-name').toLowerCase();
            if (author == 'mypresta.eu') {
                $(this).attr('href', $(this).attr('data-link'));
                $(this).attr('data-target', '');
                $(this).removeClass('untrustedaddon');
            }
        }
    });
});