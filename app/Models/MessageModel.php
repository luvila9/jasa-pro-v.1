<?php
namespace App\Models;
use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['order_id', 'sender_id', 'message'];
    protected $useTimestamps    = true;
    protected $updatedField     = ''; // Karena kita tidak butuh updated_at di chat
}