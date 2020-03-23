<?php

namespace App\Http\Controllers\Pages\Admins;

use App\Http\Controllers\Controller;
use App\Model\Pembayaran;
use App\Model\Project;
use App\Model\Services;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function project()
    {
        $data = Pembayaran::all();
        return view('pages.admins.pembayaran.project', [
            'project' => $data
        ]);
    }

    public function service()
    {
        $data = Services::all();
        return view('pages.admins.pembayaran.service', [
            'service' => $data
        ]);
    }
}
