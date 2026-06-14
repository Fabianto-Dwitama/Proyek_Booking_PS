use App\Models\User;

public function run(): void
{
    $admin = User::firstOrCreate(
        ['email' => 'admin@gmail.com'],
        [
            'name' => 'Admin',
            'password' => bcrypt('password')
        ]
    );

    $admin->syncRoles(['admin']);

    $owner = User::firstOrCreate(
        ['email' => 'owner@gmail.com'],
        [
            'name' => 'Owner',
            'password' => bcrypt('password')
        ]
    );

    $owner->syncRoles(['owner']);
}