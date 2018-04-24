<?php

namespace App\Batch;

use Illuminate\Support\Facades\DB;
use App\Batch\Common\Helpers;

class Batch
{
    /**
     * Update Multi fields
     * $table String
     * $value Array
     * $index String
     */
    public function update($table, $values, $index)
    {
        $final  = array();
        $ids    = array();

        if(!count($values))
            return false;
        if(!isset($index) AND empty($index))
            return false;

        foreach ($values as $key => $val)
        {
            $ids[] = $val[$index];
            foreach (array_keys($val) as $field)
            {
                if ($field !== $index)
                {
                    $value              = (is_null($val[$field]) ? 'NULL' : '"' . $val[$field] . '"' );
                    $final[$field][]    = 'WHEN `'. $index .'` = "' . $val[$index] . '" THEN ' . $value . ' ';
                }
            }
        }

        $cases = '';
        foreach ($final as $k => $v)
        {
            $cases .=  '`'. $k.'` = (CASE '. implode("\n", $v) . "\n"
                            . 'ELSE `'.$k.'` END), ';
        }

        $query = "UPDATE `$table` SET " . substr($cases, 0, -2) . " WHERE `$index` IN(" . implode(',', $ids) . ");";

        return DB::statement($query);
    }

}
