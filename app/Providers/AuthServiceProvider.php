<?php

namespace App\Providers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Retrieve the role from the database
        
        // Gate::define('Front', function (User $user, Role $role) {
            
        //     $role = Role::find($user->id); // Assuming $roleId is the ID of the role you want to retrieve

        //     // Decode the JSON array into a PHP array
        //     $permissions = json_decode($role->permission, true);

        //     // Access the first element of the array
        //     $firstPermission = $permissions[0];
        //     return $user->id == 1 || $role->$firstPermission;
        // });

        // Gate::define('Front', function (User $user) {
        //     // Get all users with their roles
        //     $users = User::with('Role')->get();
        
        //     // Check each user's permission
        //     foreach ($users as $currentUser) {
        //         // Decode the JSON array into a PHP array
        //         $array = json_decode($currentUser->premission, true);
        
        //         // Check if the user's permission array contains "1"
        //         if (array("4", $array)) {
        //             return true; // Allow access if permission is found
        //         }
        //     }
        
        //     return false; // Deny access if no user with permission is found
        // });

        Gate::define('Front.room.view', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("1", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('Front.stay.view', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("2", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('Front.reservation', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("3", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('Front.transaction', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("4", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('pos', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("5", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('accounting', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("6", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('report', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("7", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.breakfest', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("8", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.user.role', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("9", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.status.room', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("10", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.floor', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("11", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.type.room', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("12", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.price', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("13", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.travel.agent', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("14", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.additional.item', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("16", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.room', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("17", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });


        Gate::define('master.occupation', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("18", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.source.travel.agent', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("15", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.guest', function (User $user,) {
            $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("19", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });

        Gate::define('master.user', function (User $user,) {
          $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("20", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });  
        Gate::define('inventory', function (User $user,) {
          $users = $user->Role;
            if($users){
                $premission = json_decode($users->premission, true);
                // Check if the user's permissions contain "1"
                if (is_array($premission)) {
                    // Check if the user's permissions contain "1"
                    if (in_array("21", $premission)) {
                        return true; // Allow access if permission is found
                    }
                }
            }
            return false;
        });  
        
    }
}
