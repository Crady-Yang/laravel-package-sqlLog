<?php

namespace main;

class QueryLog
{
	public function sqlLog()
	{
		\DB::listen(function ($sql) {
			$singleSql = $sql->sql;
			$singleSql = str_replace(PHP_EOL, '', $singleSql);
            $singleSql = preg_replace('/\\s+/', ' ', $singleSql);
            if($sql->bindings) {
            	foreach ($sql->bindings as $replace) {
    				$value = is_numeric($replace) ? $replace : "'" . $replace . "'";
                    $singleSql = preg_replace('/\?/', $value, $singleSql, 1);
            	}
            	\Log::info('sql',[$singleSql]);
            }else{
            	 \Log::info('sql_nobindinbg',[$singleSql]);
            }
		});
	}
}