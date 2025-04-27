@php
    $answers = json_decode($getState(), true);
@endphp

<ul class="space-y-1 my-2 text-sm">
    @if(is_array($answers) && count($answers))
        @foreach ($answers as $index => $item)
            <li class="border rounded p-3 pb-2 pt-2">
                <div>
                    <strong>{{ __('dashboard.q') . ($index + 1) }}:</strong>
                    {{ Str::limit($item['question'], 30) ?? '' }}
                </div>
                <div class="pl-4">
                    <span class="font-semibold ps-3">{{ __('dashboard.a') }}:</span>
                    @if(isset($item['type']) && $item['type'] == 'yes_no')
                        {{ __('dashboard.' . $item['answer']) ?? __('dashboard.No answer') }}
                    @else
                        {{ Str::limit($item['answer'], 30) ?? __('dashboard.No answer') }}
                    @endif
                </div>
            </li>
        @endforeach
    @else
        <li>{{ __('dashboard.No additional questions.') }}</li>
    @endif
</ul>
