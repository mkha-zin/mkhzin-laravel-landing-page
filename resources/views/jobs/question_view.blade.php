<ul class="list-disc pl-4 space-y-1 text-sm text-gray-700">
    @if(is_array($getState()) || is_object($getState()))
        @foreach ($getState() as $index => $question)
            <li>
                <strong>{{ __('dashboard.q') . $index + 1 }}:</strong> {{ $question['question'] ?? '' }}
                @if(isset($question['type']))
                    <em class="text-gray-500"> ({{ ucfirst(str_replace('_', ' ', $question['type'])) }})</em>
                @endif
            </li>
        @endforeach
    @else
        <li>{{ __('dashboard.No additional questions.') }}</li>
    @endif
</ul>
