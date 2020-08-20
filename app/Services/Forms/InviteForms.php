<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/23/2019
 * Time: 2:44 AM
 */

namespace App\Services\Forms;

use App\Forms\InviteForm;
use Kris\LaravelFormBuilder\Form;

class InviteForms extends ServiceForm
{
    public function create(): Form
    {
        return $this->formBuilder->create(InviteForm::class, [
            'method' => 'POST',
            'url'    => route('invites.store'),
        ]);
    }
}
