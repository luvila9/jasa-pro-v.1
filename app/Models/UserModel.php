<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    // INI KUNCI PENYELESAIAN ERRORNYA: 
    // Kita mendaftarkan kolom apa saja yang diizinkan untuk diisi dari form
    protected $allowedFields    = [
        'fullname', 
        'email', 
        'password_hash', 
        'role', 
        'whatsapp',
        'instagram',
        'portfolio',
        'phone_number', 
        'profile_pic', 
        'status'
    ];

    // Mengaktifkan pengisian otomatis kolom created_at dan updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Mengaktifkan Soft Deletes (data tidak hilang permanen saat dihapus)
    protected $useSoftDeletes   = true;
    protected $deletedField     = 'deleted_at';
}