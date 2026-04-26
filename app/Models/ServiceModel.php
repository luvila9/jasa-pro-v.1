<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'user_id', 
        'title', 
        'description', 
        'price', 
        'status',
        'image',
        'category',
        'delivery_time',
        'revisions'
    ];

    protected $useTimestamps = true;
}