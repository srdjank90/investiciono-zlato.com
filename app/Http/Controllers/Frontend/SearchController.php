<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    protected $theme = 'gold';

    public function __construct()
    {
        $this->theme = getOption('setting_theme_active_opt', 'gold');
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $options = [
            'Investiciono zlato',
            'Zlatne pločice',
            'Zlatne poluge',
            'Zlatni dukati',
            'Zlatne pločice 1g',
            'Zlatne pločice 2g',
            'Zlatne pločice 5g',
            'Zlatne pločice 10g',
            'Zlatne pločice 20g',
            'Zlatne poluge 1unca',
            'Zlatne poluge 50g',
            'Zlatne poluge 100g',
            'Zlatne poluge 250g',
            'Zlatne poluge 500g',
            'Zlatne poluge 1000g',
        ];
        $results = [];

        foreach ($options as $option) {
            if (strpos(strtolower($option), strtolower($query)) !== false) {
                $results[] = $option;
            }
        }

        return response()->json($results);
    }

    public function search(Request $request)
    {
        $qty = '';
        if ($request->qty !== '') {
            $qty = $request->qty;
        }

        $frontend = new FrontendController();


        if ($qty == 'Investiciono zlato') {
            return view('frontend.themes.' . $this->theme . '.gold');
        }
        if ($qty == 'Zlatne pločice') {
            return $frontend->goldenPlates();
        }
        if ($qty == 'Zlatne poluge') {
            return $frontend->goldenBars();
        }
        if ($qty == 'Zlatni dukati') {
            return $frontend->goldenCoins();
        }

        if ($qty == 'Zlatne pločice 1g') {
            return $frontend->category('zlatne-plocice-1g');
        }
        if ($qty == 'Zlatne pločice 2g') {
            return $frontend->category('zlatne-plocice-2g');
        }
        if ($qty == 'Zlatne pločice 5g') {
            return $frontend->category('zlatne-plocice-5g');
        }
        if ($qty == 'Zlatne pločice 10g') {
            return $frontend->category('zlatne-plocice-10g');
        }
        if ($qty == 'Zlatne pločice 20g') {
            return $frontend->category('zlatne-plocice-20g');
        }

        if ($qty == 'Zlatne poluge 1unca') {
            return $frontend->category('zlatne-poluge-1unca');
        }
        if ($qty == 'Zlatne poluge 50g') {
            return $frontend->category('zlatne-poluge-50g');
        }
        if ($qty == 'Zlatne poluge 100g') {
            return $frontend->category('zlatne-poluge-100g');
        }
        if ($qty == 'Zlatne poluge 250g') {
            return $frontend->category('zlatne-poluge-250g');
        }
        if ($qty == 'Zlatne poluge 500g') {
            return $frontend->category('zlatne-poluge-500g');
        }
        if ($qty == 'Zlatne poluge 1000g') {
            return $frontend->category('zlatne-poluge-1000g');
        }
    }
}
