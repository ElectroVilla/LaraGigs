<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%'.request('tag').'%');
        }
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%'.request('search').'%')
            ->orWhere('description', 'like', '%'.request('search').'%')
            ->orWhere('tags', 'like', '%'.request('search').'%');
        }
    }

    // Relationship to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    // public static function all(){
    //     return [
    //         [
    //             'id' => 1,
    //             'title' => 'Job 1',
    //             'description' => 'Lorem ipsum dolor sit amet, consectetur adip incididunt ut labore et dolore magna aliquet el    elementum et dolore magna aliquet et dolore magna aliqu et dolore magna aliqu et dolore magna aliquet et dolore magna al commodo consequat vel fel magna aliquet et dolore magna aliquet et d Dolore magna aliquet et dolore magna aliquet et dolore magna al commod Doctrine',
    //         ],
    //         [
    //             'id' => 2,
    //             'title' => 'Job 2',
    //             'description' => 'Lorem ipsum dolor sit amet, consectetur adip incididunt ut labore et dolore magna aliquet el    elementum et dolore magna aliquet et dolore magna aliqu et dolore magna aliqu et dolore magna aliquet et dolore magna al commodo consequat vel fel magna aliquet et dolore magna aliquet et d Dolore magna aliquet et dolore magna aliquet et dolore magna al commod Doctrine',
    //         ],
    //         [
    //             'id' => 3,
    //             'title' => 'Job 3',
    //             'description' => 'Lorem ipsum dolor sit amet, consectetur adip incididunt ut labore et dolore magna aliquet el    elementum et dolore magna aliquet et dolore magna aliqu et dolore magna aliqu et dolore magna aliquet et dolore magna al commodo consequat vel fel magna aliquet et dolore magna aliquet et d Dolore magna aliquet et dolore magna aliquet et dolore magna al commod Doctrine',
    //         ],
    //     ];
    // }

    // public static function find($id){
    //     $jobs = self::all();
    //     foreach ($jobs as $job) {
    //         if ($job['id'] == $id) {
    //             return $job;
    //         }
    //     }
    // }
}
