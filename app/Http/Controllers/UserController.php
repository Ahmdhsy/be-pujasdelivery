<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\AuthException;

class UserController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $credentialsPath = config('firebase.projects.default.credentials.file');
        $absoluteCredentialsPath = str_contains($credentialsPath, '://') || str_starts_with($credentialsPath, DIRECTORY_SEPARATOR) || str_starts_with($credentialsPath, 'C:\\')
            ? $credentialsPath
            : base_path($credentialsPath);

        Log::info('Attempting to load Firebase credentials', [
            'path' => $credentialsPath,
            'absolute_path' => $absoluteCredentialsPath,
        ]);

        if (!file_exists($absoluteCredentialsPath) || !is_readable($absoluteCredentialsPath)) {
            Log::error('Firebase credentials file is missing or not readable', [
                'path' => $absoluteCredentialsPath,
                'exists' => file_exists($absoluteCredentialsPath),
                'readable' => is_readable($absoluteCredentialsPath),
            ]);
            throw new \Exception("Firebase credentials file at '{$absoluteCredentialsPath}' is missing or not readable");
        }

        try {
            $factory = (new Factory)->withServiceAccount($absoluteCredentialsPath);
            $this->firebaseAuth = $factory->createAuth();
            Log::info('FirebaseAuth initialized successfully', ['instance' => get_class($this->firebaseAuth)]);
        } catch (\Exception $e) {
            Log::error('Failed to initialize FirebaseAuth', ['error' => $e->getMessage()]);
            throw new \Exception('Firebase initialization failed: ' . $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        Log::info('Register request received', ['input' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'firebase_uid' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::info('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $idToken = $request->bearerToken();
            if (!$idToken) {
                Log::error('No Firebase ID token provided');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Firebase ID token is required',
                ], 401);
            }

            Log::info('Verifying Firebase ID token', ['token' => substr($idToken, 0, 20) . '...']);
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            if ($firebaseUid !== $request->input('firebase_uid')) {
                Log::error('Invalid Firebase UID', ['request_uid' => $request->input('firebase_uid'), 'token_uid' => $firebaseUid]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Firebase UID',
                ], 401);
            }

            $user = User::create([
                'firebase_uid' => $request->input('firebase_uid'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'role' => 'user',
                'password' => null,
            ]);

            Log::info('User registered successfully', ['user_id' => $user->id]);
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'data' => $user,
            ], 201);

        } catch (AuthException $e) {
            Log::error('Firebase AuthException', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to verify Firebase token',
                'error' => $e->getMessage(),
            ], 401);
        } catch (\Exception $e) {
            Log::error('General exception in register', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to register user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function me(Request $request)
    {
        Log::info('Me endpoint called');

        try {
            $idToken = $request->bearerToken();
            if (!$idToken) {
                Log::error('No Firebase ID token provided');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Firebase ID token is required',
                ], 401);
            }

            Log::info('Verifying Firebase ID token');
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            Log::info('Fetching user with firebase_uid', ['firebase_uid' => $firebaseUid]);
            $user = User::where('firebase_uid', $firebaseUid)->first();

            if (!$user) {
                Log::error('User not found', ['firebase_uid' => $firebaseUid]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            Log::info('User retrieved successfully', ['user_id' => $user->id]);
            return response()->json([
                'status' => 'success',
                'message' => 'User retrieved successfully',
                'data' => $user,
            ], 200);

        } catch (AuthException $e) {
            Log::error('Firebase AuthException', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to verify Firebase token',
                'error' => $e->getMessage(),
            ], 401);
        } catch (\Exception $e) {
            Log::error('General exception in me endpoint', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateName(Request $request)
    {
        Log::info('Update name request received', ['input' => $request->all()]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $idToken = $request->bearerToken();
            if (!$idToken) {
                Log::error('No Firebase ID token provided');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Firebase ID token is required',
                ], 401);
            }

            Log::info('Verifying Firebase ID token');
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            Log::info('Fetching user with firebase_uid', ['firebase_uid' => $firebaseUid]);
            $user = User::where('firebase_uid', $firebaseUid)->first();

            if (!$user) {
                Log::error('User not found', ['firebase_uid' => $firebaseUid]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            $user->name = $request->input('name');
            $user->save();

            Log::info('User name updated successfully', ['user_id' => $user->id, 'new_name' => $user->name]);
            return response()->json([
                'status' => 'success',
                'message' => 'User name updated successfully',
                'data' => $user,
            ], 200);

        } catch (AuthException $e) {
            Log::error('Firebase AuthException', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to verify Firebase token',
                'error' => $e->getMessage(),
            ], 401);
        } catch (\Exception $e) {
            Log::error('General exception in updateName', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user name',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateProfilePhoto(Request $request)
    {
        Log::info('Update profile photo request received');

        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimum 2MB
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $idToken = $request->bearerToken();
            if (!$idToken) {
                Log::error('No Firebase ID token provided');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Firebase ID token is required',
                ], 401);
            }

            Log::info('Verifying Firebase ID token');
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');

            Log::info('Fetching user with firebase_uid', ['firebase_uid' => $firebaseUid]);
            $user = User::where('firebase_uid', $firebaseUid)->first();

            if (!$user) {
                Log::error('User not found', ['firebase_uid' => $firebaseUid]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $path = $file->store('profile_photos', 'public'); // Simpan di storage/public/profile_photos
                $user->profile_photo = $path;
                $user->save();

                Log::info('Profile photo updated successfully', ['user_id' => $user->id, 'path' => $path]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile photo updated successfully',
                    'data' => $user,
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'No file uploaded',
            ], 400);

        } catch (AuthException $e) {
            Log::error('Firebase AuthException', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to verify Firebase token',
                'error' => $e->getMessage(),
            ], 401);
        } catch (\Exception $e) {
            Log::error('General exception in updateProfilePhoto', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update profile photo',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}