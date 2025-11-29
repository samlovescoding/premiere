<?php

namespace App\Livewire;

use App\Facades\TMDbMovie;
use App\Facades\TMDbShow;
use Livewire\Component;

class Metadata extends Component
{
    public $queries = "pulp fiction\nbullet train";

    public $queryType = 'movies'; // || 'shows'

    public $results = null;

    public $selected = [];

    public function lookupMovies()
    {
        $this->lookup('movies');
    }

    public function lookupShows()
    {
        $this->lookup('shows');
    }

    public function lookup($type)
    {
        $this->result = null;
        $this->queryType = $type;
        $this->selected = [];
        $queries = explode("\n", $this->queries);
        $searchFn = match ($type) {
            'movies' => fn (string $query) => TMDbMovie::searchMovies($query),
            'shows' => fn (string $query) => TMDbShow::searchShows($query),
        };
        foreach ($queries as $query) {
            // Validate the query beforehand
            $this->results[$query] = $searchFn($query);
        }
    }

    public function import(): void
    {
        $selectedItems = [];
        foreach ($this->results as $query => $response) {
            foreach ($response['results'] as $item) {
                $key = $this->getItemKey($query, $item);
                if (! empty($this->selected[$key])) {
                    $selectedItems[] = [
                        'query' => $query,
                        'type' => $this->queryType,
                        'item' => $item,
                    ];
                }
            }
        }
        dd($selectedItems);
    }

    private function getItemKey(string $query, array $item): string
    {
        return (string) $item['id'];
    }

    public function render()
    {
        return view('metadata');
    }
}
