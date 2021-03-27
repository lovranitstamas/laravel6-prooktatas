<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Socialite;

class SocialAuthController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {


        //$socialiteUserObject = Socialite::driver($provider)->stateless()->user();
        $socialiteUserObject = Socialite::driver($provider)->user();

        //keresés JSON mezőben
        //HA TALÁLUNK A FACEBOOK ID ALAPJÁN CUSTOMER
        $customer = Customer::where([
            'social->' . $provider . '->id' => $socialiteUserObject->getId(),
        ])->first();


        //Mivel a Modelben array-jé castoltuk a social atrributútumot, ezért ő tömbként visekedik.
        // dd($customer->social['facebook']['id']);
        if (!$customer) {
            //HA FACEBOOK ID ALAPJÁN NINCS, AKKOR EMAIL ALAPJÁN
            $customer = Customer::where('email', 'LIKE', $socialiteUserObject->getEmail())->first();
            if (!$customer) {
                //HA EMAIL ALAPJÁN SINCS, AKKOR LÉTREHOZZUK
                $customer = $this->createNewCustomer($socialiteUserObject);
            }
        }
        //$customer->social->facebook->token = $socialiteUserObject->token;
        $socialArray = [
            $provider => [
                'id' => $socialiteUserObject->getId(),
                'token' => $socialiteUserObject->token
            ]
        ];

        $customer->social = $socialArray;
        $customer->save();

        auth()->guard('customer')->loginUsingId($customer->id);

        return redirect()->route('customers.index');
    }

    protected function createNewCustomer($socialiteUserObject)
    {
        $customer = new Customer;
        $customer->name = $socialiteUserObject->getName();
        $customer->email = $socialiteUserObject->getEmail();
        $customer->description = 'teszt';

        return $customer;
    }


}
