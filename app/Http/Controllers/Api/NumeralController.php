<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NumeralResource;
use App\Models\Numeral;
use App\Services\IntegerConverterInterface;

class NumeralController extends Controller
{
    private $converter;

    /**
     * Constructor
     */
    public function __construct(IntegerConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new NumeralResource(Numeral::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request
    ){
        $request->validate([
            'number' => 'bail|required|integer|max:3999',
        ]);

        $number = $request->input('number');

        $numeral = Numeral::create([
            'number' => $number,
            'roman_numeral' => $this->converter->convertInteger($number),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return new NumeralResource($numeral);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topTen()
    {
        return new NumeralResource(Numeral::topTen());
    }
}
