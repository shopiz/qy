<?php
/**
 *
 * @author Jacky Zhang <myself.fervor@gmail.com>
 * @copyright 2014-2016 深圳市喂车科技有限公司 <http://www.weicheche.cn/>
 * Date: 2/19/16
 * Time: 11:53 AM
 */

namespace Mongo;

use WPLib\Mvc\Collection;

class Counters extends Collection
{
    public function getSource()
    {
        return "wei_counters";
    }

    public static function getLastInsertId(Collection $collection)
    {
        $name = $collection->getSource();

        $res = self::findAndModify([
                '_id' => $name,
            ],
            [
                '$inc' => ['last_insert_id' => 1],
            ],
            null,
            [
                'upsert' => true,
                'new'    => true,
            ]);

        return $res['last_insert_id'];
    }
}