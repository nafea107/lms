<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function show($locale, $search = '')
    {
        return Inertia::render('Landing/Search', [
            'search' => $search ?? __('كورسات'),
        ]);
    }

    public function data()
    {
        $searchTerm = $this->getRequest('s');
        $per_page = $this->getRequest('per_page') ?? 18;
        $category = $this->getRequest('category');

        $results = Course::with('lessons')
            ->when($searchTerm,  function (Builder $query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('lessons', function (Builder $query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%{$searchTerm}%");
                    });
            })->when($category, function (Builder $builder) use ($category) {
                $builder->where('category_id', $category);
            })
            ->paginate($per_page);

        // Modify the paginated items
        $results->getCollection()->transform(function ($item) {

            // Remove lessons after setting image
            $item->setRelation('lessons', []);

            return $item;
        });

        $itemsArray = $results->toArray();

        $itemsArray['total_pages'] = $results->lastPage();

        return $itemsArray;
    }

    public function getRequest($key, $explode = false)
    {
        $data = request($key);
        if ($data && is_string($data)) {
            if ($explode) {
                $data = explode(',', $data);
            }
            return $data;
        }
        return null;
    }
}
