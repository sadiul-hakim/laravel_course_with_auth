<?php

namespace App\Views\Composers;

use Illuminate\View\View;

// This is used to propagate data to multiple views at once
// Register it in Provider
class TestComposer
{
    public function compose(View $view): void
    {
        $view->with('test_key', 'test-value');
    }
}
