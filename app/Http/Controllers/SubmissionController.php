<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Permission;
use App\Models\Santri;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $santri = Santri::with([
            "pengurus",
        ]);

        $permissions = Permission::with([
            "santri" => [
                "pengurus",
            ],
        ]);

        if ($user->roleId == 3) {
            $santri = $santri->where("pengurusId", $user->pengurus->pengurusId);
            $permissions = $permissions->whereHas("santri", function ($query) use ($user) {
                $query->where("pengurusId", $user->pengurus->pengurusId);
            });
        }

        $santri = $santri->get();
        $permissions = $permissions->orderBy('permissionId', 'desc')->get();

        return view(
            'pages.perizinan.index',
            compact(
                "santri",
                "permissions"
            )
        );
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "description" => "required",
                "santriId" => "required",
                "tglKeluar" => "required",
                "tglKembali" => "required",
                "bukti" => "mimes:jpg,jpeg,png",
            ]);
            $user = Auth::user();
            $santri = Santri::find($request->santriId);
            $permission = Permission::where("santriId", $request->santriId)
                ->where("tglKeluar", $request->tglKeluar)
                ->first();

            if ($permission) {
                return back()->with("error", "Santri " . $santri->name . " sudah memiliki izin pada tanggal " . $request->tglKeluar);
            }

            if ($request->has("bukti")) {
                $file = $request->file("bukti");
                $fileName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
                $file->storeAs("public/bukti/", $fileName);

                Permission::create([
                    "santriId" => $santri->santriId,
                    "description" => $request->description,
                    "tglKeluar" => $request->tglKeluar,
                    "tglKembali" => $request->tglKembali,
                    "file" => $fileName,
                ]);
            } else {
                Permission::create([
                    "santriId" => $santri->santriId,
                    "description" => $request->description,
                    "tglKeluar" => $request->tglKeluar,
                    "tglKembali" => $request->tglKembali,
                ]);
            }

            return back()->with("success", "Data berhasil disimpan");
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                "description" => "required",
                "santriId" => "required",
                "tglKeluar" => "required",
                "tglKembali" => "required",
                "bukti" => "mimes:jpg,jpeg,png",
            ]);
            $user = Auth::user();
            $santri = Santri::find($request->santriId);
            $permission = Permission::with([
                "santri",
            ])->where("permissionId", $id);

            $check = Permission::where("santriId", $request->santriId)
                ->where("tglKeluar", $request->tglKeluar)
                ->where("permissionId", "!=", $id)
                ->first();

            if ($check) {
                return back()->with("error", "Santri " . $santri->name . " sudah memiliki izin pada tanggal " . $request->tglKeluar);
            }

            if ($request->has("bukti")) {
                $old = Permission::find($id);
                $path = "public/bukti/" . $old->file;

                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                $file = $request->file("bukti");
                $fileName = md5($file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
                $file->storeAs("public/bukti/", $fileName);

                $permission->update([
                    "santriId" => $santri->santriId,
                    "description" => $request->description,
                    "tglKeluar" => $request->tglKeluar,
                    "tglKembali" => $request->tglKembali,
                    "file" => $fileName,
                ]);

            } else {
                $permission->update([
                    "santriId" => $santri->santriId,
                    "description" => $request->description,
                    "tglKeluar" => $request->tglKeluar,
                    "tglKembali" => $request->tglKembali,
                ]);
            }

            return back()->with("success", "Data berhasil diubah");

        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $permission = Permission::find($id);
            $path = "public/bukti/" . $permission->file;

            if (Storage::exists($path)) {
                Storage::delete($path);
            }

            $permission->delete();

            return response()->json([
                "status" => true,
                "message" => "Data berhasil dihapus",
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function updateStatus($id)
    {
        try {
            $permission = Permission::find($id);
            $permission->update([
                "isComback" => true,
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data berhasil diubah",
            ])->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ])->setStatusCode(500);
        }
    }
}