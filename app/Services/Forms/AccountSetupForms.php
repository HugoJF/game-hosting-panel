<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:44 AM
 */

namespace App\Services\Forms;

use App\Forms\AccountSetupForm;
use App\User;
use Illuminate\Support\Facades\URL;
use Kris\LaravelFormBuilder\Form;

class AccountSetupForms extends ServiceForm
{
    public function set(User $user): Form
    {
        return $this->formBuilder->create(AccountSetupForm::class, [
            'method' => 'PATCH',
            'url'    => URL::signedRoute('panel-accounts.setup', $user),
        ]);
    }
}
