<?php

namespace Webkul\GolobaTheme\Http\Controllers\Shop\Seller\Account;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Webkul\Core\Rules\Slug;
use Webkul\Marketplace\Http\Controllers\Shop\Controller;
use Webkul\Marketplace\Repositories\SellerRepository;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected SellerRepository $sellerRepository) {}

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return Response
     */
    public function store()
    {
        try {
        $this->validate(request(), [
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:marketplace_sellers,email'],
            'url'      => ['required', 'unique:marketplace_sellers,url', 'lowercase', new Slug],
            'password' => ['required', 'confirmed', 'min:6'],
            'phone'    => ['required', 'max:20'],
            'instagram' => ['required', 'url', 'max:255'],
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::info($e->getMessage());
        }

        Event::dispatch('marketplace.seller.account.create.before');

        $seller = $this->sellerRepository->create(array_merge(request()->only([
            'name',
            'email',
            'url',
            'password',
            'phone',
            'instagram',
        ]), [
            'is_approved'           => ! core()->getConfigData('marketplace.settings.general.seller_approval_required'),
            'allowed_product_types' => [
                'simple',
                'configurable',
                'virtual',
                'downloadable',
            ],
        ]));

        Event::dispatch('marketplace.seller.account.create.after', $seller);

        session()->flash('success', trans('marketplace::app.shop.sellers.account.signup.success'));

        return redirect()->route('marketplace.seller.session.index');
    }
}
