<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    protected $table = 'uploaded_csv';

    protected $fillable = [
        'file_name',
        'file_path',
        'status',
    ];
}

