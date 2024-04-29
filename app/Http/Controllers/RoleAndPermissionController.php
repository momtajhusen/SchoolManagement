<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RoleAndPermissionUsers;
use App\Models\RoleAndPermissionRoute;



class RoleAndPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function CheckUserRoutes(Request $request)
    {
         $role_type = $request->session()->get('role_type');
         $email = $request->session()->get('super_admin');

         if($role_type == 'sub_admin'){
            $User = RoleAndPermissionUsers::where('email', $email)->first();
            $userid = $User->id;

            $RoutesData = RoleAndPermissionRoute::where('user_id', $userid)->pluck('route')->unique();

            $route_categories = RoleAndPermissionRoute::where('user_id', $userid)->pluck('route_category')->unique();

            return response(['RoutesData' => $RoutesData, 'MenuCategory' => $route_categories], 200);
         }
         

    }

    /**
     * Show the form for creating a new resource.
     */
    public function SaveRoleAndPermission(Request $request)
    {
        // Decode the JSON data received from the request
        $requestData = $request->json()->all();

        // Accessing the user data
        $userData = $requestData['user'];
        $name = $userData['name'];
        $number = $userData['number'];
        $email = $userData['email'];
        $password = $userData['psd'];
        $role_type =  'sub_admin';


        // Find the user by email
        $user = RoleAndPermissionUsers::where('email', $email)->first();

        if (!$user) {
            // If user not found, create a new user
            $user = new RoleAndPermissionUsers();
            $user->name = $name;
            $user->number = $number;
            $user->email = $email;
            $user->password = $password;
            $user->role_type = $role_type;
            $user->save();
        } else {
            // If user found, update user's password
            $user->name = $name;
            $user->number = $number;
            $user->password = $password;
            $user->role_type = $role_type;
            $user->save();
        }

        // Delete all rows in RoleAndPermissionRoute table with the same user_id
        RoleAndPermissionRoute::where('user_id', $user->id)->delete();

        // Accessing the routes array
        $routes = $requestData['routes'];

        // Iterate over each route
        foreach ($routes as $routeData) {
            // Access individual route and category
            $route = $routeData['route'];
            $category = $routeData['category'];

            // Save the route data into the RoleAndPermissionRoute table
            $roleAndPermissionRoute = new RoleAndPermissionRoute();
            $roleAndPermissionRoute->user_id = $user->id;
            $roleAndPermissionRoute->route = $route;
            $roleAndPermissionRoute->route_category = $category;
            $roleAndPermissionRoute->save();
        }

        // Return a success message
        return response()->json(['message' => 'Update Successfully'], Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function SubAdminList(Request $request)
    {
        $SubAdminData = RoleAndPermissionUsers::where("role_type",  'sub_admin')->get();
        if ($SubAdminData) {
            return response(array("subAdminData" => $SubAdminData), 200);
        } else {
            return response()->json(['message' => 'data not found']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function SubAdminDataForUpdate(Request $request)
    {
        $admin_id = $request->admin_id;

        $User = [];
        $RoleAndPermissionUsers = RoleAndPermissionUsers::where('id', $admin_id)->first();
        if ($RoleAndPermissionUsers) {
            $User['name'] = $RoleAndPermissionUsers->name;
            $User['email'] = $RoleAndPermissionUsers->email;
            $User['number'] = $RoleAndPermissionUsers->number;
            $User['password'] = $RoleAndPermissionUsers->password;
        }



        $RoutesData = RoleAndPermissionRoute::where('user_id', $admin_id)->pluck('route')->unique();
        return response(['UserData'=>$User, 'RoutesData' => $RoutesData], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
