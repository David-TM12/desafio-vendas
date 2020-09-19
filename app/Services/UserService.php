<?php
namespace App\Services;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserService {

    public static function store($request){
       
        try {
            return User::create($request);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
        
    }

    public static function update($request, $usuario){
        
        try {
            return $usuario->update($request);     
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return null;
        }
    }
 }
 ?>