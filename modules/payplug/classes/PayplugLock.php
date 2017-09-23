<?php
/**
 * 2013 - 2017 PayPlug SAS
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
 *  @author    PayPlug SAS
 *  @copyright 2013 - 2017 PayPlug SAS
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PayPlug SAS
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class PayplugLock extends ObjectModel
{
    /** @var int */
    const MAX_CHECK_TIME = 5;

    /** @var int */
    const IPN_PRINT = 777;
    const VAL_PRINT = 888;

    /** @var int */
    public $id_payplug_lock;

    /** @var int */
    public $id_cart;

    /** @var datetime */
    public $date_add;

    /** @var datetime */
    public $date_upd;

    /** @var string */
    protected $table;

    /** @var string */
    protected $identifier;

    /** @var array */
    protected $fieldsRequired = array();

    /** @var array */
    protected $fieldsValidate = array();

    /** @var array */
    protected $fieldsValidateLang = array();

    /** @var array */
    public static $definition = array(
        'table'   => 'payplug_lock',
        'primary' => 'id_payplug_lock',
        'multishop' => true,
        'fields'  => array(
            'id_cart' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
        )
    );

    /**
     * @see ObjectModel::__construct()
     *
     * @param int $id
     * @param int $id_lang
     * @return PayplugLock
     */
    public function __construct($id = null, $id_lang = null)
    {
        parent::__construct($id, $id_lang);
    }

    /**
     * get fields
     *
     * @return array
     */
    public function getFields()
    {
        parent::validateFields();

        $fields = array();
        $fields['id_cart'] = (int)($this->id_cart);
        $fields['date_add'] = pSQL($this->date_add);
        $fields['date_upd'] = pSQL($this->date_upd);

        return $fields;
    }

    /**
     * Check
     *
     * @param  int $id_cart
     * @param  int $loop_time
     * @return void
     */
    public static function check($id_cart, $loop_time = 1)
    {
        //definir le delai
        $delay = new DateInterval('PT10S');

        //test s'il y a un lock
        $lock_exists = self::existsLockG2($id_cart);
        if ($lock_exists) {
            //definir la date de fin du lock
            $last_update = new DateTime($lock_exists['date_upd']);
            $last_check = $last_update->add($delay);
            $time = new DateTime('now');

            while ((self::existsLockG2($id_cart) !== false) && ($time < $last_check)) {
                if (function_exists('usleep')) {
                    usleep($loop_time * 1000000);
                } else {
                    self::usleep($loop_time * 1000);
                }

                $time = new DateTime('now');
            }
        }
    }

    /**
     * Check if exists
     *
     * @param  int $id_cart
     * @return bool
     */
    public static function exists($id_cart)
    {
        $lock = self::getInstanceByCart((int)$id_cart);

        if ($lock === false) {
            return false;
        } else {
            return Validate::isLoadedObject($lock);
        }
    }

    /**
     * Set instance of PayplugLock
     *
     * @param  int $id_cart
     * @return PayplugLock
     */
    public static function getInstanceByCart($id_cart)
    {
        $req_lock = new DbQuery();
        $req_lock->select('pl.id_payplug_lock');
        $req_lock->from('payplug_lock', 'pl');
        $req_lock->where('id_cart = '.(int)$id_cart);
        $id = (int)Db::getInstance()->getValue($req_lock);

        if ($id == 0) {
            return false;
        }

        return new PayplugLock($id);
    }

    /**
     * Create lock
     *
     * @param  int $id_cart
     * @return bool
     */
    public static function addLock($id_cart)
    {
        $lock = new PayplugLock();
        $lock->id_cart = (int)$id_cart;

        return $lock->save();
    }

    /**
     * Delete lock
     *
     * @param  int $id_cart
     * @return bool
     */
    public static function deleteLock($id_cart)
    {
        $lock = self::getInstanceByCart((int)$id_cart);

        if ($lock === false) {
            return false;
        } else {
            return $lock->delete();
        }
    }

    /**
     * Sleep time
     *
     * @param  int $seconds
     * @return void
     */
    private static function usleep($seconds)
    {
        $start = microtime();

        do {
            // Wait !
            $current = microtime();
        } while (($current - $start) < $seconds);
    }

    //TODO: check multishop si cart_id identiques ou uniques
    public static function createLockG2($id_cart, $process_print = 'none')
    {
        $req_lock = '
            INSERT INTO '._DB_PREFIX_.'payplug_lock (              
                id_cart,
                id_order,
                date_add,
                date_upd
            )
            VALUE (
                '.(int)$id_cart.',
                IFNULL(
                    (
                        SELECT o.id_order 
                        FROM '._DB_PREFIX_.'orders o 
                        WHERE o.id_cart = '.(int)$id_cart.' 
                    ), 
                    \''.pSQL($process_print).'\'
                ),
                \''.date('Y-m-d H:i:s').'\',
                \''.date('Y-m-d H:i:s').'\'
            )';
        $res_lock = Db::getInstance()->execute($req_lock);
        if (!$res_lock) {
            return false;
        } else {
            $lock = self::existsLockG2($id_cart);
            if (!$lock) {
                return false;
            } else {
                return $lock['id_order'];
            }
        }
    }

    public static function deleteLockG2($id_cart)
    {
        $req_lock = '
            DELETE 
            FROM '._DB_PREFIX_.'payplug_lock 
            WHERE id_cart = '.(int)$id_cart;
        $res_lock = Db::getInstance()->execute($req_lock);
        if (!$res_lock) {
            return false;
        } else {
            return true;
        }
    }

    public static function existsLockG2($id_cart)
    {
        $req_lock = '
            SELECT pl.*  
            FROM '._DB_PREFIX_.'payplug_lock pl 
            WHERE pl.id_cart = '.(int)$id_cart;
        $res_lock = Db::getInstance()->getRow($req_lock);
        if (!$res_lock) {
            return false;
        } else {
            return $res_lock;
        }
    }
}
