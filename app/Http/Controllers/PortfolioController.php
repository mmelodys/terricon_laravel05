<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function renderPortfolioPage()
    {
        $portfolio = Portfolio::all();

        return view('createPortfolio', [
            'portfolio' => $portfolio
        ]);
    }

    public function createPortfolio(Request $request)
    {
        $data = $request->all();

        $portfolio = Portfolio::create($data);

        return back();
    }

    public function getApiPortfolio()
    {
        $portfolio = Portfolio::all();

        return response()->json([
            'data' => $portfolio,
            'count_data' => $portfolio->count()
        ]);
    }

    public function createApiPortfolio(Request $request)
    {
        $data = $request->all();
        $portfolio = null;

        if (isset($data['name'])) {
            $portfolio = Portfolio::create($data);
        }

        return back();
    }
    public function renderCreatePage()
{
    return view('createPortfolio'); // Убедитесь, что файл представления существует
}
}