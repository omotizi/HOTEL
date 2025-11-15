<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
    public function roomType() {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function scopeMyCart($q) {
        $sessionCarts = session('room_cart', []);
        $userId = auth()->id();

        if ($userId) {
            return $q->where('user_id', $userId);
        }

        if (!empty($sessionCarts)) {
            return $q->whereIn('session_uid', $sessionCarts);
        }

        // Force zero result when neither present
        return $q->whereRaw('0 = 1');
    }

    public function scopeHasRoomType($query) {
        return  $query->whereHas('roomType', function ($roomType) {
            $roomType->active();
        });
    }
}
