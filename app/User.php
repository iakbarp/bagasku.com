<?php

namespace App;

use App\Model\Bio;
use App\Model\Pengerjaan;
use App\Model\Portofolio;
use App\Model\Review;
use App\Model\ReviewWorker;
use App\Model\Tawaran;
use App\Model\Testimoni;
use App\Model\Undangan;
use App\Support\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check whether this user is seeker or not
     * @return bool
     */
    public function isOther()
    {
        return ($this->role == Role::OTHER);
    }

    /**
     * Check whether this user is admin or not
     * @return bool
     */
    public function isAdmin()
    {
        return ($this->role == Role::ADMIN);
    }

    /**
     * Check whether this user is root or not
     * @return bool
     */
    public function isRoot()
    {
        return ($this->role == Role::ROOT);
    }


    public function get_bio()
    {
        return $this->hasOne(Bio::class, 'user_id');
    }

    public function get_portofolio()
    {
        return $this->hasOne(Portofolio::class, 'user_id');
    }

    public function get_pengerjaan()
    {
        return $this->hasMany(Pengerjaan::class, 'user_id');
    }

    public function get_ulasan()
    {
        return $this->hasOne(Review::class, 'user_id');
    }

    public function get_ulasan_pekerja()
    {
        return $this->hasOne(ReviewWorker::class, 'user_id');
    }

    public function get_testimoni()
    {
        return $this->hasOne(Testimoni::class, 'user_id');
    }

    public function get_tawaran()
    {
        return $this->hasMany(Tawaran::class, 'user_id');
    }

    public function get_undangan()
    {
        return $this->hasMany(Undangan::class, 'user_id');
    }
}
