<?php

namespace App\Http\Controllers;

use App\Models\Buisness;
use Illuminate\Http\Request;

class BuisnessController extends Controller
{

    public function index()
    {
        $path = public_path("json/tableSearch.json");
        $jsonData = json_decode(file_get_contents($path), true);
        $data = $jsonData['listed'];
        return view('buisness.index',compact('data'));
    }

    public function create($dataset)
    {
        $dataset = unserialize($dataset);
        $buisnes = Buisness::where('unique_id', $dataset['unique_id'])->first();
        if($buisnes) {
            return $this->index()->with(['error' => "Data already exist"]);
            dd("data exist");
        }

        $createdBuisnes = Buisness::create($dataset);

        return $this->index()->with(['success' => "Data submitted successfully."]);;
    }

}
