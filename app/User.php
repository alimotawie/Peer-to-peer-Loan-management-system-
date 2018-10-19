<?php

namespace App;
use App\rate;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Flight extends Model
{

    protected $table ='users';
}


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','picture','idScan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function user_rates()
    {
        return $this->hasMany('App\rate');
    }

    public function user_loans()
    {
        return $this->hasMany('App\loanRequests');
    }

    public function user_average_rate()
    {
        $rates=0;
        $rates_count= $this->user_rates()->count();
        if ($rates_count==0)
        {
            $average_rate=0;
        }
        else {
            foreach ($this->user_rates as $rate) {
                $rates += $rate->rate;
            }
            $average_rate = $rates / $rates_count;
        }
        $rate_container=[
            'average_rate'=>$average_rate,
            'rates_count'=>$rates_count

        ];
        return $rate_container;

    }



}