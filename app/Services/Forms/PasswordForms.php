<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:44 AM
 */

namespace App\Services\Forms;

use App\Forms\PasswordForm;
use App\User;
use Illuminate\Support\Facades\URL;
use Kris\LaravelFormBuilder\Form;

class PasswordForms extends ServiceForm
{
    public function set(User $user): Form
    {
        return $this->formBuilder->create(PasswordForm::class, [
            'method' => 'PATCH',
            'url'    => URL::signedRoute('password.set', $user),
        ]);
    }
}
