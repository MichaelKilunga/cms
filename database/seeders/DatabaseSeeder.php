<?php

namespace Database\Seeders;

use App\Models\Church;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Branch;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Finance;

class DatabaseSeeder extends Seeder
{
    private $branchHof;
    private $branch;
    private $church;
    private $churchHof;
    private $serviceCategory;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //run the RoleAndPermissionSeeder here
        $this->call(RoleAndPermissionSeeder::class);

        //create 8 default users 1. super admin, 2. church admin, 3. church bishop, 4. church hof, 5. branch admin 6. branch pastor, 7. branch hof, and 8. branch member
        $user = [
            [
                'name' => 'Super Admin',
                'email' => 'super@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Church Admin',
                'email' => 'churchadmin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Church Bishop',
                'email' => 'bishop@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Church Head of Finance',
                'email' => 'churchhof@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Branch Admin',
                'email' => 'branchadmin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Branch Pastor',
                'email' => 'pastor@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Branch Head of Finance',
                'email' => 'branchhof@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ],
            [
                'name' => 'Branch Member',
                'email' => 'member@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'profile_photo_path' => null,
                'current_team_id' => null,
            ]
        ];

        foreach ($user as $u) {
            $currentUser = User::create($u);
            switch ($currentUser->name) {
                case 'Super Admin':
                    $currentUser->assignRole('super admin');
                    break;
                case 'Church Admin':
                    $currentUser->assignRole('church admin');

                    //create 1 default church
                    $currentChurch = Church::factory()->create(['administrator_id' => $currentUser->id]);
                    $this->church = $currentChurch;

                    //create 1 default branch
                    $currentBranch = Branch::factory()->create(['church_id' => $currentChurch->id]);
                    $this->branch = $currentBranch;

                    //create 1 default service category
                    $currentServiceCategory = ServiceCategory::factory()->create(['church_id' => $currentChurch->id, 'branch_id' => $currentBranch->id, 'user_id' => $currentUser->id]);
                    $this->serviceCategory = $currentServiceCategory;

                    Member::factory()->create(['user_id' => $currentUser->id]);

                    break;
                case 'Church Bishop':
                    $currentUser->assignRole('church bishop');
                    Member::factory()->create(['user_id' => $currentUser->id]);

                    break;
                case 'Church Head of Finance':
                    $currentUser->assignRole('church hof');

                    //create 1 default service
                    $currentService = Service::factory()->create(['church_id' => $this->church->id, 'branch_id' => $this->branch->id, 'service_category_id' => $this->serviceCategory->id, 'user_id' => $currentUser->id]);

                    //create 1 default finance
                    Finance::factory()->create(['church_id' => $this->church->id, 'branch_id' => $this->branch->id, 'service_id' => $currentService->id, 'user_id' => $currentUser->id]);

                    Member::factory()->create(['user_id' => $currentUser->id]);
                    break;
                case 'Branch Admin':
                    $currentUser->assignRole('branch admin');
                    Member::factory()->create(['user_id' => $currentUser->id]);
                    break;
                case 'Branch Pastor':
                    $currentUser->assignRole('branch pastor');
                    Member::factory()->create(['user_id' => $currentUser->id]);
                    break;
                case 'Branch Head of Finance':
                    $currentUser->assignRole('branch hof');
                    Member::factory()->create(['user_id' => $currentUser->id]);
                    break;
                case 'Branch Member':
                    $currentUser->assignRole('member');
                    Member::factory()->create(['user_id' => $currentUser->id]);
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
}
