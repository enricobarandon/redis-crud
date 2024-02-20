<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function setValue(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');
        
        Redis::set($key, $value);
        return response()->json(['message' => 'Value set successfully']);
    }

    public function getValue(Request $request)
    {
        $key = $request->input('key');
        
        $value = Redis::get($key);
        return response()->json(['value' => $value]);
    }

    public function updateValue(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');

        Redis::set($key, $value);

        return response()->json(['message' => 'Value updated successfully']);
    }

    public function deleteKey(Request $request)
    {
        $key = $request->input('key');

        $deletedKeysCount = Redis::del($key); // Delete the key

        if ($deletedKeysCount === 1) {
            return response()->json(['message' => 'Key deleted successfully']);
        } else {
            return response()->json(['message' => 'Key not found or already deleted'], 404);
        }
    }
    
}
