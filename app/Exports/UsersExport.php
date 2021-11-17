<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{
    use Exportable;
//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()
//    {
//        return User::with('roles')->where('is_deleted',0)->get();
//    }
    public function query()
    {
        return User::query()->where('is_deleted',0);
    }

}
