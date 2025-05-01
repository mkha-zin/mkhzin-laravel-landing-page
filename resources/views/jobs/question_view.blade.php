<ul class="list-disc pl-4 space-y-1 text-sm text-gray-700">
    @if(is_array($getState()) || is_object($getState()))
        @foreach ($getState() as $index => $question)
            <li>
                <strong>{{ __('dashboard.q') . $index + 1 }}:</strong> {{ \Illuminate\Support\Str::limit($question['question'], 20) ?? '' }}
                @if(isset($question['type']))
                    <em style="color:rgba(200,0,0,0.5);"> ({{ __('dashboard.' . $question['type']) }})</em>
                @endif
            </li>
        @endforeach
    @else
        <li>{{ __('dashboard.No additional questions.') }}</li>
    @endif
</ul>
