<?php
/**
 * 2007-2015 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2015 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

/**
 * create tables and content
 */
Db::getInstance()
  ->execute(
      '
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'mtarget_sms` (
                `id_mtarget_sms` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `type` VARCHAR(50) NULL DEFAULT \'0\',
                `active` TINYINT(4) NOT NULL DEFAULT \'0\',
                `time_limit` INT(11) NULL DEFAULT \'0\',
                `variable` VARCHAR(255) NULL DEFAULT NULL,
                PRIMARY KEY (`id_mtarget_sms`)
            )
'
  );
Db::getInstance()
  ->execute(
      '
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'mtarget_sms_lang` (
                `id_mtarget_sms` INT(11) UNSIGNED NOT NULL,
                `id_lang` INT(11) UNSIGNED NOT NULL,
                 `event` VARCHAR(80) NULL DEFAULT NULL,
                `content` VARCHAR(255) NULL DEFAULT NULL,
                PRIMARY KEY (`id_mtarget_sms`, `id_lang`)
            )
'
  );
Db::getInstance()
  ->execute(
      '
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'mtarget_cart` (
                `id_mtarget_cart` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_cart` INT(11) NOT NULL,
                `id_campaign` INT(11) NULL DEFAULT  \'0\',
                 PRIMARY KEY (`id_mtarget_cart`)
            )
'
  );
Db::getInstance()
  ->execute(
      '
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'mtarget_segment` (
                `id_mtarget_segment` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `reference`  VARCHAR(9) NOT NULL,
                `name`  VARCHAR(20) NULL DEFAULT NULL,
                `lang`  VARCHAR(80) NULL DEFAULT NULL,
                `group_ids`  VARCHAR(80) NULL DEFAULT NULL,
                `optin` TINYINT(4) NOT NULL DEFAULT \'0\',
                `has_order` TINYINT(4) NOT NULL DEFAULT \'0\',
                PRIMARY KEY (`id_mtarget_segment`)
            )
'
  );
Db::getInstance()
  ->execute(
      '
            CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'mtarget_segment_lang` (
                `id_mtarget_segment` INT(11) UNSIGNED NOT NULL,
                `id_lang` INT(11) UNSIGNED NOT NULL,
                `group` VARCHAR(80) NULL DEFAULT NULL,
                 PRIMARY KEY (`id_mtarget_segment`, `id_lang`)
            )
'
  );
/* get languages ids */

/*   FR   */
$dbQueryFr = new DbQuery();
$dbQueryFr->select('id_lang');
$dbQueryFr->from('lang');
$dbQueryFr->where('iso_code = "fr"');
$id_fr = Db::getInstance(_PS_USE_SQL_SLAVE_)
           ->getValue($dbQueryFr);
/*   EN   */
$dbQueryEn = new DbQuery();
$dbQueryEn->select('id_lang');
$dbQueryEn->from('lang');
$dbQueryEn->where('iso_code = "en"');
$id_en = Db::getInstance(_PS_USE_SQL_SLAVE_)
           ->getValue($dbQueryEn);
/*   ES   */
$dbQueryEs = new DbQuery();
$dbQueryEs->select('id_lang');
$dbQueryEs->from('lang');
$dbQueryEs->where('iso_code = "es"');
$id_es = Db::getInstance(_PS_USE_SQL_SLAVE_)
           ->getValue($dbQueryEs);
/*   IT   */
$dbQueryIt = new DbQuery();
$dbQueryIt->select('id_lang');
$dbQueryIt->from('lang');
$dbQueryIt->where('iso_code = "it"');
$id_it = Db::getInstance(_PS_USE_SQL_SLAVE_)
           ->getValue($dbQueryIt);

/* create SMS Template Admin */
Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'admin',
          'active'     => 0,
          'time_limit' => '',
          'variable'   => '(Variables : #email#, #url#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_ADMIN_ACCOUNT', (int) $id);

if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Nouveau compte'),
              'content'        => pSQL(
                  'Bonjour, un nouveau client : #email# vient de créer un compte sur votre boutique #url#'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('New account'),
              'content'        => pSQL('Hello, a new customer: #email# has created an account on your store #url#'),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Nueva Cuenta'),
              'content'        => pSQL('Hola, un nuevo cliente: #email# a creado una cuenta en tu tienda #url#'),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Nuovo account'),
              'content'        => pSQL('Buongiorno, un nuovo cliente:  #email# ha creato un account nel vostro negozio #url#'),
          )
      );
}
Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'admin',
          'active'     => 0,
          'time_limit' => '',
          'variable'   => '(Variables : #email#, #num_order#, #amount#, #url#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_ADMIN_ORDER', (int) $id);
if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Nouvelle commande'),
              'content'        => pSQL(
                  'Bonjour, le client : #email# vient de finaliser la commande No #num_order# du montant : #amount# sur votre boutique #url#'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('New order'),
              'content'        => pSQL(
                  'Hello, your client: #email# has just finalised order No #num_order# for the amount of: #amount# on your store #url#'
              ),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Nueva pedida'),
              'content'        => pSQL(
                  'Hola, el cliente #email# ha acabado su pedida de compra No #num_order#  de #amount# en tu tienda #url#'
              ),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Nuovo ordine'),
              'content'        => pSQL(
                  'Buongiorno, il cliente #email# ha appena finalizzato l\'ordine num #num_order# per un importo di: #amount# nel vostro negozio #url#'
              ),
          )
      );
}
Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'admin',
          'active'     => 0,
          'time_limit' => '',
          'variable'   => '(Variables : #email#, #code_prod#, #ur#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_ADMIN_ORDER_RETURN', (int) $id);
if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Retour produit'),
              'content'        => pSQL(
                  'Bonjour, le client : #email# vient de demander le retour de(s) produit(s) : #code_prod# sur votre boutique #url#'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('Product return'),
              'content'        => pSQL(
                  'Hello, your client: #email# has requested the return of the(se) product(s): #code_prod# on your store #url#'
              ),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Reclamo'),
              'content'        => pSQL(
                  'Hola, el cliente #email# acaba de pedir un reclamo del (los) producto(s) #code_prod# en tu tienda #url#'
              ),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Restituzione prodotto'),
              'content'        => pSQL(
                  'Buongiorno, il cliente #email# ha domandato la restituzione del prodotto #code_prod# nel vostro negozio #url#'
              ),
          )
      );
}
/* create SMS Template Customer */

Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'customer',
          'active'     => 0,
          'time_limit' => '',
          'variable'   => '(Variables : #firstname#, #lastname#, #num_order#, #ur#, #status#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_CUSTOMER_ORDER', (int) $id);
if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Nouvelle commande'),
              'content'        => pSQL(
                  'Bonjour, #firstname# #lastname# : Votre commande No #num_order# sur notre boutique #url# vient d\'être validée !'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('New order'),
              'content'        => pSQL(
                  'Hello, #firstname# #lastname#: Your order No #num_order# on our store #url# has been validated !'
              ),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Nueva Compra'),
              'content'        => pSQL(
                  'Hola, #firstname# #lastname#: Su pedida No #num_order# en nuestra tienda #url# ha sida validada !'
              ),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Nuovo ordine'),
              'content'        => pSQL(
                  'Buongiorno, #firstname# #lastname#: Il suo ordine num #num_order# nel nostro negozio #url# è stato confermato'
              ),
          )
      );
}
Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'customer',
          'active'     => 0,
          'time_limit' => '',
          'variable'   => '(Variables : #firstname#, #lastname#, #num_order#, #url#, #status#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_CUSTOMER_ORDER_STATUS', (int) $id);
if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Statut commande'),
              'content'        => pSQL(
                  'Bonjour, #firstname# #lastname# : Votre commande No #num_order# sur notre boutique #url# vient d\'être mise à jour. Son nouveau statut est : #status#'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('Order statut'),
              'content'        => pSQL(
                  'Hello, #firstname# #lastname#: Your order No #num_order# on our store #url# has been updated. The new status is: #status#'
              ),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Estado del pedido'),
              'content'        => pSQL(
                  'Hola, #firstname# #lastname#: Tu pedido No #num_order# en nuestra tienda #url# ha sido actualizado. El nuevo estatus es: #status#'
              ),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Stato dell\'ordine'),
              'content'        => pSQL(
                  'Buongiorno, #firstname# #lastname#: il suo ordine N #num_order# nel nostro negozio #url# è stato aggiornato. Il nuovo stato è: #status#'
              ),
          )
      );
}

Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'customer',
          'active'     => 0,
          'time_limit' => 1,
          'variable'   => '(Variables : #firstname#, #lastname#, #ur#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_CUSTOMER_CART', (int) $id);
if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Relance panier '),
              'content'        => pSQL(
                  'Bonjour, #firstname# #lastname# : Votre panier est toujours disponible sur notre boutique #url# . Il vous reste quelques heures pour finaliser votre commande et bénéficiez de'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('Abandoned Carts'),
              'content'        => pSQL(
                  'Hello, #firstname# #lastname#: Your basket is still available on our store #url#. You still have a few hours left to finalise your  order and benefit from'
              ),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Cesta abandonada'),
              'content'        => pSQL(
                  'Hola, #firstname# #lastname#: Tu cesta sigue siendo disponible de nuestra tienda #url#. Remanen algunas horas para finalizar tu pedido.'
              ),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Carrello abbandonato'),
              'content'        => pSQL(
                  'Buongiorno, #firstname# #lastname#: il suo carrello è sempre disponibile nel nostro negozio #url#. Le restano poche ore per finalizzare l\'ordine e beneficiare di'
              ),
          )
      );
}
Db::getInstance()
  ->insert(
      'mtarget_sms',
      array(
          'type'       => 'customer',
          'active'     => 0,
          'time_limit' => 3,
          'variable'   => '(Variables : #firstname#, #lastname#, #ur#)',
      )
  );
$id = Db::getInstance()
        ->Insert_ID();
Configuration::updateValue('MTARGET_CUSTOMER_BIRTHDAY', (int) $id);
if ($id_fr != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_fr,
              'event'          => pSQL('Anniversaire'),
              'content'        => pSQL(
                  'Bonjour, #firstname# #lastname# : c\'est votre anniversaire, la boutique #url#  pense à vous. Bénéficier de'
              ),
          )
      );
}
if ($id_en != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_en,
              'event'          => pSQL('Birthday'),
              'content'        => pSQL(
                  'Hello, #firstname# #lastname#: It\'s your birthday, here at our store #url# we like to offer you'
              ),
          )
      );
}
if ($id_es != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_es,
              'event'          => pSQL('Cumpleaño'),
              'content'        => pSQL(
                  'Hola, #firstname# #lastname#: Feliz cumpleaño, tu tienda #url# piensa en ti y te propone un descuento'
              ),
          )
      );
}
if ($id_it != false) {
    Db::getInstance()
      ->insert(
          'mtarget_sms_lang',
          array(
              'id_mtarget_sms' => (int) $id,
              'id_lang'        => (int) $id_it,
              'event'          => pSQL('Compleanno'),
              'content'        => pSQL(
                  'Buongiorno, #firstname# #lastname#: è il suo compleanno, presso il nostro negozio #url# ci piacerebbe offrirle'
              ),
          )
      );
}
