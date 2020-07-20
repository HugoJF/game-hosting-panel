<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 2:07 AM
 */

namespace App\Services\Forms;

use App\Announcement;
use App\Forms\AnnoucementForm;

class AnnouncementForms extends ServiceForm
{
    public function create()
    {
        return $this->formBuilder->create(AnnoucementForm::class, [
            'method' => 'POST',
            'url'    => route('admins.announcements.store'),
        ]);
    }

    public function edit(Announcement $announcement)
    {
        return $this->formBuilder->create(AnnoucementForm::class, [
            'method' => 'PATCH',
            'url'    => route('admins.announcements.update', $announcement),
            'model'  => $announcement,
        ]);
    }
}
