<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RoomBookingRequest extends Model
{
    public function roomType() {
        return $this->belongsTo(RoomType::class);
    }

    function bookFor() {
        return Carbon::parse($this->check_in)->diffInDays(Carbon::parse($this->check_out));
    }
}
