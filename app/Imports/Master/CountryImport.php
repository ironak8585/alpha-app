<?php

namespace App\Imports\Master;

use App\Models\Master\Country;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Validators\Failure;

class CountryImport implements ToCollection, WithHeadingRow, WithMultipleSheets, SkipsOnFailure
{

    /**
     * Cosntructor
     *
     */
    public function __construct()
    {
    }

    public function headingRow(): int
    {
        //heading row on 1st row in file
        return 1;
    }

    public function sheets(): array
    {
        //consider only first sheet
        return [
            // Select by sheet index
            0 => $this,
        ];
    }

    public function collection(Collection $rows)
    {
        //pre processing
        $rows = $rows->filter(function ($row) {
            return $row->filter()->isNotEmpty();
        });

        $rules = [
            '*.name' => 'required',
        ];

        $messages = [
            '*.name.required' => 'Required :attribute.',
        ];

        Validator::make($rows->toArray(), $rules, $messages)->validate();

        $records = [];
        $now = Carbon::now()->toDateTimeString();

        foreach ($rows as $i => $row) {
            $record = [
                'name' => Str::upper($row['name']),
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $records[] = $record;
        }

        try {
            //insert records
            Country::insert($records);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
        dd($failures);
    }
}
