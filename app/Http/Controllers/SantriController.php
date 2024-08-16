<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\Santri;
use App\Models\User;
use App\Models\Wali;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class SantriController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::all();
        $santris = Santri::with([
            'wali',
            'pengurus',
        ])->get();

        return view(
            'pages.system.santri',
            compact(
                'pengurus',
                'santris'
            )
        );
    }

    public function template()
    {
        return response()->download(Storage::path('public/Santri-Template.xlsx'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('excelFile');
            $data = Excel::toCollection(new Santri, $file);

            foreach ($data as $key => $value) {
                foreach ($value as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }

                    Validator::make([
                        'name' => $value[0],
                        'pengurusName' => $value[5],
                        'waliName' => $value[6],
                        "waliPhone" => $value[8],
                        'username' => $value[9],
                    ], [
                        'name' => 'unique:penguruses,name',
                        'pengurusName' => 'required',
                        'waliName' => 'unique:walis,name',
                        "waliPhone" => 'numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                        'username' => 'unique:users,username',
                    ])->validate();

                    $pengurus = Pengurus::where('name', 'like', '%' . $value[5] . '%')->first();

                    $user = User::create([
                        'username' => $value[9],
                        "image" => null,
                        'password' => Hash::make('12345'),
                        'roleId' => 4,
                    ]);

                    $wali = Wali::create([
                        'name' => $value[6],
                        "userId" => $user->userId,
                        'address' => $value[7],
                        "phone" => "+62" . $value[8],
                    ]);

                    Santri::create([
                        'name' => $value[0],
                        "age" => $value[1],
                        "birthPlace" => $value[2],
                        "birthDate" => $value[3],
                        'address' => $value[4],
                        "waliId" => $wali->waliId,
                        "pengurusId" => $pengurus->pengurusId,
                    ]);
                }
            }

            return back()->with('success', 'Berhasil mengimport data santri');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:santris,name',
                'waliName' => 'required|string|max:255|unique:walis,name',
                'username' => 'required|unique:users,username',
                "age" => 'required|numeric',
                "pengurusId" => 'required',
                "waliTelpon" => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            ]);

            $user = User::create([
                'username' => $request->username,
                "image" => null,
                'password' => Hash::make('12345'),
                'roleId' => 4,
            ]);

            $wali = Wali::create([
                'name' => $request->waliName,
                "userId" => $user->userId,
                'address' => $request->waliAddress,
                "phone" => "+62" . $request->waliTelpon,
            ]);

            Santri::create([
                "waliId" => (int) $wali->waliId,
                "pengurusId" => (int) $request->pengurusId,
                'name' => $request->name,
                "age" => $request->age,
                'address' => $request->address,
                "birthPlace" => $request->birthPlace,
                "birthDate" => $request->birthDate,
            ]);

            return back()->with('success', 'Berhasil menambahkan data santri');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'waliName' => 'required',
                "age" => 'required|numeric',
                "pengurusId" => 'required',
                "waliTelpon" => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            ]);

            $wali = Wali::find($request->waliId);
            $wali->update([
                'name' => $request->waliName,
                'address' => $request->waliAddress,
                'phone' => "+62" . $request->waliTelpon,
            ]);

            Santri::find($id)->update([
                "waliId" => (int) $request->waliId,
                "pengurusId" => (int) $request->pengurusId,
                'name' => $request->name,
                "age" => $request->age,
                'address' => $request->address,
                "birthPlace" => $request->birthPlace,
                "birthDate" => $request->birthDate,
            ]);

            return back()->with('success', 'Berhasil mengubah data santri');

        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $santri = Santri::with(["wali", "pengurus"])->find($id);
            $user = User::find($santri->wali->userId);
            $user->delete();
            $santri->wali->delete();
            $santri->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data santri',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
