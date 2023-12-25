<?php

namespace App\Http\Controllers\Backend\Client;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FileEngineController extends Controller
{
    public function filesEngine()
    {
        $data = null;
        return view('backend.client.projects.filesEngine', compact('data'));
    }
    public function getDataFromFiles(Request $response)
    {
        // dd($response->all());
        $validation = Validator::make($response->all(), [
            "PACKING_SLIP" => "nullable|mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg",
            "BILL_OF_LADING" => "required|mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg",
            "COMMERCIAL_INVOICE" => "nullable|mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg",
            "CERTIFICATE_OF_ORIGIN" => "nullable|mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg",
            "CUSTOM_DECLARATION" => "nullable|mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg",
            'otherFiles'   => 'nullable',
            'otherFiles.*' => 'mimes:doc,pdf,docx,pptx,zip,png,jpg,jpeg'
        ]);
        // dd($req->plShsearch);
        if($validation->fails()){
            // dd($validation->errors());
            return redirect()->route('client.filesEngine')->withErrors($validation)->withInput();
        }

        $filename = 'BILL_OF_LADING' . now() . '.' . $response->BILL_OF_LADING->getClientOriginalExtension();
        $response->BILL_OF_LADING->move('assets/files/proiects/' , $filename);
        $path = public_path("/assets/files/proiects/");

        $client = new Client();
        $response = $client->post( 'https://mlapi.sanctumclear.ai/parse_keys', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($path . $filename, 'r'),
                ],
                [
                    'name'     => 'doc_type',
                    'contents' => '3',
                ],
                [
                    'name'     => 'keys',
                    'contents' => 'HS_CODE',
                ]
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return view('backend.client.projects.filesEngine', compact('data'));

    }
}
