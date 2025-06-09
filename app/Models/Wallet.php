<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  protected $table    = "wallet_credit";
  protected $guarded  =  [];



  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function game()
  {
    return $this->belongsTo(Game::class);
  }

  public static function get_wallet_amt($user_id)
  {
    $totalCredit = self::where('user_id', $user_id)->where('type', 'credit')->sum('amount');
    $totalDebit = self::where('user_id', $user_id)->where('type', 'debit')->sum('amount');

    return $totalCredit - $totalDebit;
  }
}
