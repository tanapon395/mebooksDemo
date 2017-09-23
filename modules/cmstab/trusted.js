/**
 * @author MyPresta.eu | Milos "VEKIA" Myszczuk <support@mypresta.eu>
 * All rights reserved! Copying, duplication strictly prohibited
 * http://www.mypresta.eu - prestashop modules
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