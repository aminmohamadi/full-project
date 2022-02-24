<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Models\Option;

class OptionController extends Controller
{
    public function indexAction()
    {
        return view('options.index', [
            'action' => route('option.store'),
        ]);
    }

    public function storeAction(Request $request)
    {
        $set = Option::setMany($request->option);
        $lightLogo = Option::get('light-logo');
        $darkLogo = Option::get('dark-logo');
        if ($request->hasFile('light-logo')) {
            if (Option::get('light-logo') && \Storage::disk('public/options')->exists($lightLogo)) {
                \Storage::disk('public')->delete('options/' . $lightLogo);
            }
            $file = Helpers::upload('options/', \request()->file('light-logo'));
            Option::set('light-logo',$file);
        }
        if ($request->hasFile('dark-logo')) {
            if (Option::get('dark-logo') && \Storage::disk('public/options')->exists($darkLogo)) {
                \Storage::disk('public')->delete('options/' . $darkLogo);
            }
            $file = Helpers::upload('options/', \request()->file('dark-logo'));
            Option::set('dark-logo',$file);
        }
        toast(Constants::SUCCESS_OPERATION_MESSAGE, 'success');
        return back();
    }
}
