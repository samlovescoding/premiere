@use(\App\Facades\TMDb)
<div class="flex flex-col gap-12">
  <div>
    <flux:textarea
      wire:model="queries"
      placeholder="Multi Search query, one query per line"
    />
    <div class="mt-4">
      <flux:button wire:click.prevent="lookupMovies">Lookup Movies</flux:button>
      <flux:button wire:click.prevent="lookupShows">Lookup TV Shows</flux:button>
    </div>
  </div>


  @if ($results !== null)
    <div class="flex flex-col gap-12">
      @foreach ($results as $result => $response)
        <div
          class="flex flex-col gap-2"
          wire:key="result-{{ $result }}"
        >
          <div>
            Results for: <span class="font-bold">{{ $result }}</span>
          </div>

          <div class="flex flex-row gap-2 overflow-x-auto p-2 -m-2">
            @foreach ($response['results'] as $item)
              @php
                $key = (string) $item['id'];
                $isSelected = isset($selected[$key]) && $selected[$key];
              @endphp
              <div
                class="flex flex-col gap-2 flex-shrink-0"
                wire:key="{{ $key }}"
              >
                <label class="relative cursor-pointer">
                  <img
                    class="w-40 aspect-[6/9] object-cover @if ($isSelected) ring-2 ring-blue-500 shadow-lg shadow-blue-500/50 @endif"
                    src="{{ !empty($item['poster_path']) ? TMDb::imageUrl($item['poster_path'], 'w300') : 'https://placehold.co/300x450' }}"
                    alt="{{ $item['title'] ?? $item['name'] }}"
                  />
                  <div class="absolute top-2 right-2">
                    <input
                      type="checkbox"
                      wire:model.live="selected.{{ $key }}"
                      class="size-5 rounded border-zinc-300 dark:border-white/10"
                    />
                  </div>
                </label>
                <div class="w-40 break-words text-sm">
                  {{ $item['title'] ?? $item['name'] }}
                </div>
              </div>
            @endforeach
          </div>
        </div>

        @if (!$loop->last)
          <flux:separator />
        @endif
      @endforeach
    </div>
  @endif

  @if (count($selected) > 0)
    <div>
      <flux:button
        variant="primary"
        wire:click.prevent="import"
      >Import to Database</flux:button>
    </div>
  @endif
</div>
