<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 2:07 AM
 */

namespace App\Services\Forms;

use App\Announcement;
use App\Forms\AnnouncementForm;

class AnnouncementForms extends ServiceForm
{
    public function create(): \Kris\LaravelFormBuilder\Form
    {
        return $this->formBuilder->create(AnnouncementForm::class, [
            'method' => 'POST',
            'url'    => route('admins.announcements.store'),
        ]);
    }

    public function edit(Announcement $announcement): \Kris\LaravelFormBuilder\Form
    {
        return $this->formBuilder->create(AnnouncementForm::class, [
            'method' => 'PATCH',
            'url'    => route('admins.announcements.update', $announcement),
            'model'  => $announcement,
        ]);
    }
}
