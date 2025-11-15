<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class RoomType extends Model
{
    use GlobalStatus;
    protected $casts = [
        'keywords' => 'array',
        'beds'     => 'array'
    ];

    protected $appends = ['image_path'];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_type_amenities', 'room_type_id', 'amenities_id')->withTimestamps();
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_type_facilities', 'room_type_id', 'facility_id')->withTimestamps();
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function suitesTypeRooms()
    {
        return $this->hasMany(SuitesTypeRoom::class, 'room_types_id');
    }

    public function activeRooms()
    {
        return $this->hasMany(Room::class)->active();
    }

    public function images()
    {
        return $this->hasMany(RoomTypeImage::class);
    }

    public function bookedRooms()
    {
        return $this->hasMany(BookedRoom::class)->active();
    }

    public function activeOffer()
    {
        return $this->offer()->running();
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function discountAmount()
    {
        if ($this->activeOffer) {
            return $this->activeOffer->discountAmount($this->fare);
        }

        return 0;
    }

    public function checkOffer()
    {

        if ($this->activeOffer) {
            return true;
        } elseif ($this->fare > $this->offer_fare && $this->offer_fare != 0) {
            return true;
        }
        return false;
    }

    public function roomFare()
    {
        $activeOffer = $this->activeOffer;
        if ($activeOffer) {
            $discount = $activeOffer->discountAmount($this->fare);
            return $this->fare - $discount;
        }
        if ($this->fare > $this->offer_fare && $this->offer_fare != 0) {
            return $this->offer_fare;
        }
        return $this->fare;
    }


    //scope
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', Status::ROOM_TYPE_FEATURED);
    }

    public function scopeRoom($query)
    {
        return $query->where('room_suite', Status::ROOM);
    }

    public function scopeSuite($query)
    {
        return $query->where('room_suite', Status::SUITE);
    }

    public function scopeWhereActiveRoom($query)
    {
        return $query->whereHas('rooms', function ($q) {
            $q->active();
        });
    }

    public function scopeWhereHasOffer($query)
    {
        return $query->whereHas('offer', function ($offer) {
            $offer->running();
        })->orWhere(function ($q) {
            $q->whereColumn('fare', '>', 'offer_fare')
                ->whereNotNull('offer_fare')
                ->where('offer_fare', '>', 0);
        });
    }



    public function featureBadge(): Attribute
    {
        return new Attribute(
            function () {
                $html = '';

                if ($this->is_featured == Status::ROOM_TYPE_FEATURED) {
                    $html = '<span class="badge badge--primary">' . trans('Featured') . '</span>';
                } else {
                    $html = '<span><span class="badge badge--dark">' . trans('Unfeatured') . '</span></span>';
                }

                return $html;
            }
        );
    }

    public function roomSuitesBadge(): Attribute
    {
        return new Attribute(
            function () {
                $html = '';
                if ($this->room_suite == Status::ROOM) {
                    $html = '<span class="badge badge--warning">' . trans('Room') . '</span>';
                } else {
                    $html = '<span><span class="badge  badge--info">' . trans('Suite') . '</span></span>';
                }

                return $html;
            }
        );
    }

    public function getRoomOrSuite($plural = false)
    {
        if ($this->room_suite == Status::ROOM) {
            return $plural ? trans('rooms') : trans('room');
        } else {
            return $plural ? trans('suites') : trans('suite');
        }
    }

    public function getImagePathAttribute()
    {
        return getImage(getFilePath('roomTypeImage') . '/thumb_' . $this->main_image);
    }
}
