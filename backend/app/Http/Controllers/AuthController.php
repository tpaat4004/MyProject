<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Lấy danh sách tất cả người dùng
    public function index(Request $request)
    {
        $user = $request->user(); // Lấy người dùng hiện tại từ request
        return response()->json($user);
    }


    // Gửi email đặt lại mật khẩu
    public function sendResetPasswordToken(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email không tồn tại'], 404);
        }

        // Tạo token và lưu vào bảng users
        $token = Str::random(60);
        $user->reset_token = $token;
        $user->reset_token_expires_at = now()->addMinutes(30);

        if (!$user->save()) {
            Log::error('Không thể lưu token vào cơ sở dữ liệu', [
                'email' => $user->email,
                'token' => $token,
            ]);
            return response()->json(['message' => 'Không thể lưu token vào cơ sở dữ liệu'], 500);
        }

        // Gửi email với token mới
        try {
            Mail::send('emails.reset_password', ['token' => $token], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Reset Password Notification');
            });
        } catch (\Exception $e) {
            Log::error('Gửi email không thành công', [
                'error_message' => $e->getMessage(),
                'user_email' => $user->email,
            ]);
            return response()->json(['message' => 'Gửi email không thành công: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Email đặt lại mật khẩu đã được gửi'], 200);
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('reset_token', $request->token)
            ->where('reset_token_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã hết hạn'], 400);
        }

        // Cập nhật mật khẩu và xóa token
        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'reset_token_expires_at' => null,
        ]);

        return response()->json(['message' => 'Mật khẩu đã được đặt lại thành công'], 200);
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Email không tồn tại'], 404);
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Mật khẩu không chính xác'], 401);
        }

        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'message' => 'Đăng nhập thành công',
            'user' => $user->only(['id', 'name', 'email', 'role']),
            'token' => $token,
        ], 200);
    }
    // Xử lý đăng ký
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    // Lấy thông tin chi tiết người dùng
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        // Chỉ cho phép người dùng đã đăng nhập và người dùng đó mới có quyền cập nhật thông tin
        $user = $request->user();

        if ($user->id !== (int)$id) {
            return response()->json(['message' => 'Bạn không có quyền cập nhật thông tin của người khác'], 403);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update(array_filter($validated));

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }


    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }


    public function showLoginForm()
    {
        return view('auth.login'); // Trả về view login
    }
}
