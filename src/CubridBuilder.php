<?php
/**
 * CubridBuilder.php
 *
 * PHP version 7
 *
 * @category    Database
 * @package     Xpressengine\Cubrid
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER Corp. <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Cubrid;

use Illuminate\Database\Schema\Builder;

class CubridBuilder extends Builder

{
    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function hasTable($table)
    {
        $sql = $this->grammar->compileTableExists();

        $table = $this->connection->getTablePrefix().$table;

        return count($this->connection->select($sql, [$table])) > 0;
    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumnListing($table)
    {
        $sql = $this->grammar->compileColumnExists();

        $table = $this->connection->getTablePrefix().$table;

        $results = $this->connection->select($sql, [$table]);

        $ret = $this->connection->getPostProcessor()->processColumnListing($results);
        $list = [];
        if ($ret == false) {
            return $list;
        }
        foreach ($ret as $val) {
            $list[] = $val->column_name;
        }

        return $list;
    }
}
