<?php

namespace Webkul\GolobaTheme\Http\Controllers\Shop\Seller\Account;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Webkul\GolobaTheme\Http\Requests\SellerFormRequest;
use Webkul\Marketplace\Http\Controllers\Shop\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected SellerRepository $sellerRepository) {}


    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(SellerFormRequest $request, int $id)
    {
        Log::info($request->all());
        Event::dispatch('marketplace.seller.update.before', $id);

        // $seller = $this->sellerRepository->update(array_merge($request->validated(), [
        //     'address' => implode(PHP_EOL, request('address')),
        // ]), $id);

        $seller = $this->sellerRepository->update(array_merge($request->validated(), [
            'address' => implode(PHP_EOL, request('address')),
        ], $this->handleDocumentUploads($request)), $id);

        Event::dispatch('marketplace.seller.update.after', $seller);

        session()->flash('success', trans('marketplace::app.shop.sellers.account.manage-profile.update-success'));

        return back();
    }

    /**
     * Handle document file uploads and return paths array
     *
     * @param SellerFormRequest $request
     * @return array
     */
    private function handleDocumentUploads(SellerFormRequest $request): array
    {
        $documents = ['citizenship_card', 'rut', 'bank_certification'];
        $uploadedPaths = [];

        foreach ($documents as $document) {
            if ($request->hasFile($document)) {
                $path = $request->file($document)->storeAs('documents/sellers', $request->file($document)->getClientOriginalName());
                $uploadedPaths[$document] = str_replace('public/', 'storage/', $path);
            }
        }

        return $uploadedPaths;
    }
}
