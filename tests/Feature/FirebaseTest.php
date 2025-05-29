public function testUserRegistration()
{
    try {
        // Mock Firebase ID token (atau gunakan token asli untuk pengujian lokal)
        $firebaseAuth = $this->app->make(\Kreait\Firebase\Auth::class);
        $user = $firebaseAuth->createUser([
            'email' => 'test3@example.com',
            'password' => 'password123',
        ]);

        $idToken = $firebaseAuth->createCustomToken($user->uid);

        $response = $this->postJson('/api/users/register', [
            'firebase_uid' => $user->uid,
            'email' => 'test3@example.com',
            'name' => 'Test User 3',
        ], [
            'Authorization' => 'Bearer ' . $idToken,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'User registered successfully',
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test3@example.com',
            'firebase_uid' => $user->uid,
            'role' => 'user',
        ]);

        // Bersihkan pengguna setelah tes
        $firebaseAuth->deleteUser($user->uid);
    } catch (\Exception $e) {
        Log::error('User registration test failed', ['error' => $e->getMessage()]);
        $this->fail('User registration test failed: ' . $e->getMessage());
    }
}