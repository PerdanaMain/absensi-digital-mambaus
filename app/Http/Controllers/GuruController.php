<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with([
            'user',
        ])->get();

        return view(
            'pages.system.guru',
            compact(
                "guru",
            )
        );
    }

    public function template()
    {
        return response()->download(Storage::path('public/Guru-Template.xlsx'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|unique:users,username',
                "phone" => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                "address" => 'string',
            ]);

            $user = User::create([
                'username' => $request->username,
                "image" => null,
                'password' => Hash::make('12345'),
                'roleId' => 2,
            ]);

            Guru::create([
                'name' => $request->name,
                'phone' => "+62" . $request->phone,
                'address' => $request->address,
                'userId' => $user->userId,
            ]);

            return back()->with('success', 'Berhasil menambahkan data guru');
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

            $data = Excel::toCollection(new Guru, $file);

            foreach ($data as $key => $value) {
                foreach ($value as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }

                    Validator::make([
                        'name' => $value[0],
                        'username' => $value[3],
                    ], [
                        'name' => 'unique:gurus,name',
                        'username' => 'unique:users,username',
                    ])->validate();

                    $user = User::create([
                        'username' => $value[3],
                        "image" => null,
                        'password' => Hash::make('12345'),
                        'roleId' => 2,
                    ]);

                    Guru::create([
                        'name' => $value[0],
                        'phone' => "+62" . (string) $value[1],
                        'address' => $value[2],
                        'userId' => $user->userId,
                    ]);
                }
            }

            return back()->with('success', 'Berhasil menambahkan data guru');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'address' => 'string',
            ]);

            $guru = Guru::find($id);

            $guru->update([
                'name' => $request->name,
                'phone' => "+62" . (string) $request->phone,
                'address' => $request->address,
            ]);

            return back()->with('success', 'Berhasil mengubah data guru');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $guru = Guru::with("user")->find($id);
            $guru->user->delete();
            $guru->delete();

            return response()->json([
                "status" => true,
                'message' => 'Berhasil menghapus data guru',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}