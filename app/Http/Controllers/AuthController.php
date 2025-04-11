<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

public function register(Request $request)
{

    $messages = [
        'name.required' => 'Vui lòng nhập họ tên.',
        'email.required' => 'Bạn chưa nhập email.',
        'email.email' => 'Email không đúng định dạng.',
        'email.unique' => 'Email này đã tồn tại.',
        'password.required' => 'Mật khẩu là bắt buộc.',
        'password.min' => 'Mật khẩu ít nhất phải 6 ký tự.',
        'phone.required' => 'Số điện thoại là bắt buộc.',
        'phone.min' => 'Số điện thoại ít nhất phải 10 ký tự.',
        'phone.max' => 'Số điện thoại không được quá 11 ký tự.',
        'birth_day.required' => 'Ngày sinh là bắt buộc.',
        'birth_day.date_format' => 'Ngày sinh phải theo định dạng YYYY/MM/DD.',
        'phone.unique' => 'Số điện thoại đã được sử dụng.',
        'gender.in' => 'Giới tính phải là MALE, FEMALE hoặc OTHER.',
    ];

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:nguoi_dung',
        'password' => 'required|string|min:6',
        'phone' => 'required|string|min:10|max:11|unique:nguoi_dung',
        'birth_day' => ['required', 'date_format:Y/m/d'],
        'gender' => 'required|in:MALE,FEMALE,OTHER'
    ], $messages);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = NguoiDung::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'birth_day' => $request->birth_day,
        'gender' => $request->gender,
        'role' => 'USER',
        'refresh_token' => '', // tạo sau nếu dùng
    ]);

    // Tự động đăng nhập luôn sau khi đăng ký
    $token = auth()->login($user);

    return response()->json([
        'message' => 'User registered successfully',
        'access_token' => $token,
        'token_type' => 'bearer',
        'user' => $user
    ]);
}

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}
