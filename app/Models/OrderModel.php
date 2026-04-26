<?php
namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['client_id', 'freelancer_id', 'service_id', 'status'];
    
    // Mengaktifkan pengisian waktu otomatis
    protected $useTimestamps    = true;
    
    // Memberitahu CodeIgniter untuk mengabaikan kolom updated_at
    protected $updatedField     = ''; 
}