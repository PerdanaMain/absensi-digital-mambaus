<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Matpel;
use App\Models\Type;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

class MatpelController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $types = Type::where("typeId", "!=", 3)->get();
        $guru = Guru::all();

        $matpels = Matpel::with([
            'kelas',
            'type',
            'guru',
        ])->get();

        return view(
            'pages.system.matpel',
            compact(
                'kelas',
                'types',
                'guru',
                'matpels'
            )
        );
    }

    public function template()
    {
        return response()->download(Storage::path('public/Matpel-Template.xlsx'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'excelFile' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('excelFile');
            $data = Excel::toCollection(new Matpel, $file);

            foreach ($data as $key => $value) {
                foreach ($value as $key => $value) {
                    if ($key == 0) {
                        continue;
                    }

                    Validator::make([
                        'name' => $value[0],
                        'kelas' => $value[3],
                        "semester" => $value[4],
                        'type' => $value[5],
                        'guru' => $value[7],
                    ], [
                        'name' => 'required',
                        'type' => 'required',
                        'guru' => 'required',
                        'kelas' => 'required',
                    ])->validate();

                    $type = Type::where('name', 'like', '%' . $value[5] . '%')->first();
                    $guru = Guru::where('name', 'like', '%' . $value[7] . '%')->first();

                    $searchValue = strtolower(preg_replace('/\s+/', '', $value[3]));
                    $kelas = Kelas::where(DB::raw('LOWER(REPLACE(name, " ", ""))'), 'like', '%' . $searchValue . '%')->first();

                    Matpel::create([
                        'name' => $value[0],
                        'typeId' => $type->typeId,
                        'guruId' => $guru->guruId,
                        'kelasId' => $kelas->kelasId,
                        "semester" => $value[4],
                        "day" => $value[1],
                        "time" => $value[2],
                        "description" => $value[6],
                    ]);
                }
            }
            return back()->with('success', 'Data berhasil diimport');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'typeId' => 'required',
                'guruId' => 'required',
                'kelasId' => 'required',
                "semester" => 'required',
            ]);

            $matpel = Matpel::create([
                'name' => $request->name,
                'typeId' => (int) $request->typeId,
                'guruId' => (int) $request->guruId,
                'kelasId' => (int) $request->kelasId,
                "semester" => $request->semester,
                "day" => $request->day,
                "time" => $request->time,
                "description" => $request->description,
            ]);

            return back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'typeId' => 'required',
                'guruId' => 'required',
                'kelasId' => 'required',
            ]);

            Matpel::where('matpelId', $id)->update([
                'name' => $request->name,
                'typeId' => (int) $request->typeId,
                'guruId' => (int) $request->guruId,
                'kelasId' => (int) $request->kelasId,
                "semester" => $request->semester,
                "day" => $request->day,
                "time" => $request->time,
                "description" => $request->description,
            ]);

            return back()->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Matpel::find($id)->forceDeleteQuietly();

            return response()->json([
                "status" => true,
                'message' => 'Data berhasil dihapus',
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                'message' => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }

}
