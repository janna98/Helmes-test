<?php

namespace App\Http\Controllers;

use App\Services\SectorService;
use App\Services\UserSectorService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class FormController extends BaseController
{
    public function index() {
        $service = new SectorService;
        $selections = $service->getFormattedSectors();
        return view('form', ["selections" => $selections]);
    }

    public function insert(Request $request): RedirectResponse
    {
        $validator = $this->validateInput($request);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userName = $request->input('name');
        $userService = new UserService();
        if ($userService->exists($userName)) {
            $validator->getMessageBag()->add('name', 'This name is already taken. Please choose another one.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = $userService->add($userName);
        $service = new UserSectorService();
        $service->add($user->id, $request->input('sectors'));
        return redirect()->back()->withInput()->with('success', "Sectors were successfully added for user $userName!");
    }

    private function validateInput(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $rules = [
            'name' => ['required', 'string'],
            'sectors' => ['required', 'array'],
            'sectors.*' => ['required',' regex:/(industry|sector|product|productType)_\d+/'],
            'agreement' => ['accepted'],
        ];
       return Validator::make($request->all(), $rules);
    }
}
