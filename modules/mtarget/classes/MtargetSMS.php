<?php
/**
 * 2007-2017 PrestaShop
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
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

/**
 * Class MtargetSMS
 */
class MtargetSMS extends ObjectModel
{
    /**
     * @var
     */
    public $id_mtarget_sms;
    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $active;
    /**
     * @var
     */
    public $time_limit;
    /**
     * @var
     */
    public $variable;
    /**
     * @var
     */
    public $event;
    /**
     * @var
     */
    public $content;
    /**
     * @var array
     */
    public static $definition = array(
        'table'     => 'mtarget_sms',
        'primary'   => 'id_mtarget_sms',
        'multilang' => true,
        'fields'    => array(
            'type'       => array(
                'type'     => self::TYPE_STRING,
                'required' => false,
                'size'     => 50,
            ),
            'active'     => array(
                'type'     => self::TYPE_BOOL,
                'validate' => 'isBool',
                'required' => true,
            ),
            'time_limit' => array(
                'type'     => self::TYPE_INT,
                'required' => false,
            ),
            'variable'   => array(
                'type'     => self::TYPE_STRING,
                'required' => true,
            ),
            'event'      => array(
                'type'     => self::TYPE_STRING,
                'validate' => 'isGenericName',
                'lang'     => true,
                'required' => true,
            ),
            'content'    => array(
                'type'     => self::TYPE_STRING,
                'validate' => 'isGenericName',
                'lang'     => true,
                'required' => true,
            ),
        ),
    );

    /**
     * @param string $user
     * @return array
     */
    public static function getByUser($user)
    {
        $dbQuery = new DbQueryCore();
        $dbQuery->select('sms.*');
        $dbQuery->from('mtarget_sms', 'sms');
        $dbQuery->where('sms.type= "'.pSQL($user).'"');
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)
                    ->executeS($dbQuery);

        $smsList = array();
        foreach ($result as $sms) {
            $tmp = new MtargetSMS((int) $sms['id_mtarget_sms']);
            $smsList[] = $tmp;
        }

        return $smsList;
    }

    /**
     * @param bool $active
     * @return int
     */
    public static function getByStatus($active)
    {
        $dbQuery = new DbQueryCore();
        $dbQuery->select('COUNT(*)');
        $dbQuery->from('mtarget_sms', 'sms');
        $dbQuery->where('sms.active= '.(int) $active.'');
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)
                    ->getValue($dbQuery);

        return (int) $result;
    }
}
