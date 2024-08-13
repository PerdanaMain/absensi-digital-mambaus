<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Auth::user();
        $data = [];

        if ($profile->roleId == 2) {
            $data = [
                "name" => $profile->name,
                "phone" => $profile->guru->phone,
                "address" => $profile->guru->address,
            ];
        }

        switch ($profile->roleId) {
            case 2:
                $data = [
                    "name" => $profile->guru->name,
                    "phone" => $profile->guru->phone,
                    "address" => $profile->guru->address,
                ];
                break;
            case 3:
                $data = [
                    "name" => $profile->pengurus->name,
                    "phone" => $profile->pengurus->phone,
                    "address" => $profile->pengurus->address,
                ];
                break;
            case 4:
                $data = [
                    "name" => $profile->wali->name,
                    "phone" => $profile->wali->phone,
                    "address" => $profile->wali->address,
                ];
                break;
            default:
                break;
        }

        return view(
            'pages.profile',
            compact(
                "profile",
                "data"
            )
        );
    }

    public function resetIndex()
    {
        $users = User::with([
            "role",
            "guru",
            "pengurus",
            "wali",
        ])
            ->where("isForgetPassword", true)->get();

        return view(
            'pages.system.resetPassword',
            compact(
                "users"
            )
        );
    }

    public function resetPassword($id)
    {
        try {
            $user = User::where("userId", $id)
                ->update([
                    "isForgetPassword" => false,
                    "password" => Hash::make("12345"),
                ]);

            return response()->json([
                "status" => true,
                "message" => "Password Berhasil Direset",
                "data" => $user,
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                "name" => "required",
                "phoneNumber" => "numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
                "address" => "required",
                "image" => "image|mimes:jpeg,png,jpg|max:512",
            ]);

            if ($request->hasFile("image")) {
                $old = User::find($id);
                $path = "public/profile/" . $old->image;

                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                $image = $request->file("image");
                $imageName = md5($image->getClientOriginalName()) . "." . $image->getClientOriginalExtension();
                $image->storeAs("public/profile/", $imageName);
            }

            $user = User::with([
                "guru",
                "pengurus",
                "wali",
            ])->find($id);

            $user->update([
                "image" => $imageName,
            ]);

            switch ($user->roleId) {
                case 2:
                    $user->guru->update([
                        "name" => $request->name,
                        "phone" => $request->phoneNumber,
                        "address" => $request->address,
                    ]);
                    break;
                case 3:
                    $user->pengurus->update([
                        "name" => $request->name,
                        "phone" => $request->phoneNumber,
                        "address" => $request->address,
                    ]);
                    break;
                case 4:
                    $user->wali->update([
                        "name" => $request->name,
                        "phone" => $request->phoneNumber,
                        "address" => $request->address,
                    ]);
                    break;
                default:
                    return back()->with("error", "Role tidak ditemukan");
                    break;
            }

            return back()->with("success", "Data berhasil diupdate");
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $request->validate([
                "currentPassword" => "required",
                "newPassword" => "required|min:8",
                "confirmPassword" => "required|same:newPassword",
            ]);

            $user = User::find($id);
            $match = Hash::check($request->currentPassword, $user->password);

            if (!$match) {
                return back()->with("error", "Password lama tidak sesuai");
            }

            $user->update([
                "password" => Hash::make($request->newPassword),
            ]);

            return back()->with("success", "Password berhasil diubah");
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }
}