<?php

namespace App\Models;



use App\Helpers\ParseFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affiliate extends Model
{
    use HasFactory;

    public function getAffiliates()
    {
        return ParseFile::parseJsonfile();
    }
}
