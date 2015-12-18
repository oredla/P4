<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function reservation(){
        # User has many Reservations
        # Define a one-to-many relationship.
        return $this->hasMany('\App\Reservation');
    }

    public static function adminsForDropdown() {
        $users = \App\User::where('user_role','=','admin')
                            ->orderBy('name','ASC')
                            ->get();
        $users_for_dropdown = [];
        foreach($users as $user) {
            $users_for_dropdown[$user->id] = $user->name;
        }

        return $users_for_dropdown;
    }
    public static function usersForDropdown() {
        $users = \App\User::orderBy('name','ASC')
                            ->get();
        $users_for_dropdown = [];
        foreach($users as $user) {
            $users_for_dropdown[$user->id] = $user->name;
        }

        return $users_for_dropdown;
    }
}
