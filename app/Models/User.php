<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;//login islemleri ucun yazilir..
class User extends Authenticatable//model yerinde bunu yaziriq
{
    use HasFactory;
}
