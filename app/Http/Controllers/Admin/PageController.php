<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function data()
    {
        $items = Page::when(isset($_GET['search']), function ($query) {
            $query->where(function (Builder $q) {
                $q->where('name', 'like', '%' . $_GET['search'] . '%');
            });
        })
            ->latest()
            ->paginate(25);

        $itemsArray = $items->toArray();
        $itemsArray['total_pages'] = $items->lastPage();

        return $itemsArray;
    }

    public function index()
    {
        return Inertia::render('Admin/Pages/Index');

    }

    public function edit($locale, Page $page)
    {
        return Inertia::render('Admin/Pages/Edit', [
            'page' => $page,
        ]);
    }

    public function update(Request $request, $locale, Page $page)
    {
        $fields = $request->fields;
        foreach ($fields as $key => $field) {
            if ($field['type'] == 'image' && !is_string($field['value'])) {
                $request->validate([
                    "fields.{$key}.value" => 'image'
                ]);
                if ($page->data[$key]['value']) {
                    \Storage::disk('public')->delete($page->data[$key]['value']);
                }
                $fields[$key]['value'] = $field['value']->store('/uploads', 'public');
            }
        }
        $page->update([
            'data' => $fields
        ]);
        return to_route('admin.pages.index');
    }
}
