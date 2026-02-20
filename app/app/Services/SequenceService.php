<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SequenceService
{
    public static function next(string $name): int
    {
        return DB::transaction(function () use ($name) {
            $sequence = DB::table('sequences')
                ->where('name', $name)
                ->lockForUpdate()
                ->first();

            $next = $sequence->current_value + 1;

            DB::table('sequences')
                ->where('name', $name)
                ->update([
                    'current_value' => $next,
                ]);

            return $next;
        });
    }
}
