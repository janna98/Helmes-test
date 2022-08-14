<?php

namespace App\Http\Controllers;

use App\Services\SectorService;
use App\Services\UserSectorService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FormController extends BaseController
{
    public function index() {
        $service = new SectorService;
        $selections = $service->getFormattedSectors();
        return view('form', ["selections" => $selections]);
    }

    public function insert(Request $request): RedirectResponse
    {
        $this->validateInput($request);
        $userId = $request->input('userId');
        $userName = $request->input('name');
        $userService = new UserService();
        if (is_null($userId)) {
            $user = $userService->add($userName);
            $userId = $user->id;
        } else {
            $userService->update($userId, $userName);
        }
        $service = new UserSectorService();
        $service->add($userId, $request->input('sectors'));
        return redirect()->back()->withInput()
            ->with([
                "success" => "Sectors were successfully added for user $userName!",
                "userId" => $userId
                ]);
    }

    private function validateInput(Request $request): void
    {
        $rules = [
            'name' => ['required', 'string'],
            'sectors' => ['required', 'array'],
            'sectors.*' => ['required',' regex:/(industry|sector|product|productType)_\d+/'],
            'agreement' => ['accepted'],
            'userId' => ['nullable', 'integer']
        ];
       $request->validate($rules);
    }
}
