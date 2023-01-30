<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function create_user()
    {
    	return view('admin.user.create');
    }


    public function manage_user()
    {
      $users = User::where('type','=','0')->get();
      // dd($users );
    	return view('admin.user.manageuser', compact('users'));
    }

    public function published_user($ID) {

      User::where('id', $ID)
      ->update(['status' => 1]);
  
      return ;
    }
  
  
    public function unpublished_user($ID) {
      User::where('id', $ID)
        ->update(['status' => 0]);
  
        return ;
    }


    public function save_user(Request $request)
    {
        $user_email = $request['email'];
        if(User::where('email',$user_email)->first())
        {
          return redirect()->back()->with('error', 'Duplicate'); 
        }else{

          $data = new User;
          $data->name = $request['name'];
          $data->email = $request['email'];
          $data->password = Hash::make($request['password']);
          $data->branch_id = $request['branch_id'];
          $data->role_id = $request['role_id'];
          $data->save();
           return redirect()->back()->with('success', 'User Create Successfully'); 
        }
  	}

    public function update_user(Request $request)
    {
      
        $user_email = $request['email'];
        $id = $request['userid'];
        
        if(User::where('email',$user_email)->where('id','!=',$id)->first())
        {
          return redirect()->back()->with('error', 'Duplicate'); 
        }else{

          $data = User::find($id);
          $data->name = $request['name'];
          $data->email = $request['email'];
          if ($request['password']) {
            $data->password = Hash::make($request['password']);
          }
          $data->branch_id = $request['branch_id'];
          $data->save();
           return redirect()->back()->with('success', 'User Updated Successfully'); 
        }
  	}

    public function create_admin()
    {
    	return view('admin.user.createadmin');
    }

    public function manage_admin()
    {
      $users = User::where('type','=','1')->get();
      // dd($users );
    	return view('admin.user.manageadmin', compact('users'));
    }

    public function save_admin(Request $request)
    {
      // dd($request->branch_id);
      $branchIDs = $request['branch_id'];
      $user_email = $request['email'];
        if(User::where('email',$user_email)->first())
        {
          return redirect()->back()->with('error', 'Duplicate'); 
        }else{

          $data = new User;
          $data->name = $request['name'];
          $data->email = $request['email'];
          if ($request['password']) {
            $data->password = Hash::make($request['password']);
          }
          $data->role_id = $request['role_id'];
          $data->branch_id = $branchIDs[0];
          $data->branchaccess = json_encode($branchIDs);
          $data->type = '1';
          $data->save();
          return redirect()->back()->with('success', 'Admin Create Successfully'); 
        }
  	}

    public function update_admin(Request $request)
    {
      
        $branchIDs = $request['branch_id'];
        $user_email = $request['email'];
        $id = $request['userid'];
        // dd($request['branch_id']);
        if(User::where('email',$user_email)->where('id','!=',$id)->first())
        {
          return redirect()->back()->with('error', 'Duplicate'); 
        }else{

          $data = User::find($id);
          $data->name = $request['name'];
          $data->email = $request['email'];
          if ($request['password']) {
            $data->password = Hash::make($request['password']);
          }
          $data->role_id = $request['role_id'];
          $data->branch_id = $branchIDs[0];
          $data->branchaccess = json_encode($branchIDs);
          $data->save();
           return redirect()->back()->with('success', 'User Updated Successfully'); 
        }
  	}

    public function switch_branch()
    {
    	return view('admin.user.switch');
    }

    public function switch_branch_store(Request $request)
    {
          $data = User::find(Auth::user()->id);
          $data->branch_id = $request['branch_id'];
          $data->save();
          return redirect()->back()->with('success', 'Branch Switch Successfully'); 
  	}

    public function super_admin()
    {
    	return view('admin.user.super_admin');
    }

    public function update_super_admin(Request $request)
    {
      
        $user_email = $request['email'];
        $id = $request['userid'];
        // dd($request['branch_id']);
        if(User::where('email',$user_email)->where('id','!=',$id)->first())
        {
          return redirect()->back()->with('error', 'Duplicate'); 
        }else{

          $data = User::find(Auth::user()->id);
          $data->name = $request['name'];
          $data->email = $request['email'];
          if ($request['password']) {
            $data->password = Hash::make($request['password']);
          }
          $data->save();
           return redirect()->back()->with('success', 'User Updated Successfully'); 
        }
  	}

    
}
