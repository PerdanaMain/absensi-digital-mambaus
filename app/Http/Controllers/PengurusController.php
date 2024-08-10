<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $penguruses = Pengurus::with([
            'user',
            "santris",
        ])->get();

        return view(
            'pages.system.pengurus',
            compact("penguruses")
        );
    }

    public function template()
    {
        return response()->download(Storage::path('public/Pengurus-Template.xlsx'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:penguruses,name',
                'username' => 'required|unique:users,username',
                "phone" => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                "address" => 'string',
            ]);

            $user = User::create([
                'username' => $request->username,
                "image" => null,
                'password' => Hash::make('12345'),
                'roleId' => 3,
            ]);

            Pengurus::create([
                'name' => $request->name,
                'phone' => "+62" . $request->phone,
                'address' => $request->address,
                'userId' => $user->userId,
            ]);

            return back()->with('success', 'Berhasil menambahkan data pengurus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('excelFile');

            $data = Excel::toCollection(new Pengurus, $file);
            foreach ($data as $key => $value) {
                foreach ($value as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }

                    Validator::make([
                        'name' => $value[0],
                        'username' => $value[3],
                    ], [
                        'name' => 'unique:penguruses,name',
                        'username' => 'unique:users,username',
                    ])->validate();

                    $user = User::create([
                        'username' => $value[3],
                        "image" => null,
                        'password' => Hash::make('12345'),
                        'roleId' => 3,
                    ]);

                    Pengurus::create([
                        'name' => $value[0],
                        'phone' => "+62" . (string) $value[1],
                        'address' => $value[2],
                        'userId' => $user->userId,
                    ]);
                }
            }

            return back()->with('success', 'Berhasil mengimport data pengurus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                "phone" => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                "address" => 'string',
            ]);

            $pengurus = Pengurus::find($id);
            $pengurus->update([
                'name' => $request->name,
                'phone' => "+62" . $request->phone,
                'address' => $request->address,
            ]);

            return back()->with('success', 'Berhasil mengubah data pengurus');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pengurus = Pengurus::with("user")->find($id);
            $pengurus->user->delete();
            $pengurus->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data pengurus',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
