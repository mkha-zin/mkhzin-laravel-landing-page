@php
    use Illuminate\Support\Facades\App;
    use Carbon\Carbon;

    $dir = App::currentLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp

@extends('layouts.app')
@section('content')
    <!-- Bootstrap 5 JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            direction: {{ $dir }}    !important;
        }
    </style>


    <div class="container">
        <div class="card my-5 text-{{ $dir == 'ar'? 'right' : 'left' }}">
            @if(!empty($branch))
                <form id="reviewForm" method="POST" action="{{ route('evaluate.branch') }}"
                      class="card-content text-{{ $dir == 'ar'? 'right' : 'left' }}">
                    @csrf

                    <input type="hidden" name="platform" value="website">
                    <input type="hidden" name="branch_id" value="{{ $branch->id }}">

                    <div class="card-header">
                        <h5 class="card-title text-{{ $dir == 'rtl'? 'right' : 'left' }}" id="reviewCardLabel">
                            {{ __('dashboard.evaluate_the', ['attribute' => $dir == 'rtl' ? $branch->name_ar : $branch->name_en]) }}
                        </h5>
                    </div>

                    <div class="card-body text-{{ $dir == 'rtl' ? 'end' : 'start' }}" dir="{{ $dir }}">
                        <div id="reviewResponse" class="alert d-none text-{{ $dir == 'rtl' ? 'end' : 'start' }}"></div>

                        <div class="row mb-3">
                            <!-- Name input -->
                            <div class="col-md-6 mb-3">
                                <label for="name">{{ __('dashboard.name') }}</label>
                                <input type="text" name="name" id="name" required>
                            </div>

                            <!-- Rating input -->
                            <style>
                                .rating {
                                    direction: ltr; /* ensures slider thumb direction is consistent */
                                    --size: 40px;
                                    --val: 2.5;

                                    --mask: conic-gradient(from -18deg at 61% 34.5%, #0000 108deg, #000 0) 0 / var(--size),
                                    conic-gradient(from 270deg at 39% 34.5%, #0000 108deg, #000 0) 0 / var(--size),
                                    conic-gradient(from 54deg at 68% 56%, #0000 108deg, #000 0) 0 / var(--size),
                                    conic-gradient(from 198deg at 32% 56%, #0000 108deg, #000 0) 0 / var(--size),
                                    conic-gradient(from 126deg at 50% 69%, #0000 108deg, #000 0) 0 / var(--size);

                                    --bg: linear-gradient(
                                        to var(--dir, right),
                                        #ffdd00 calc(var(--size) * var(--val)),
                                        #ddd 0
                                    );

                                    height: var(--size);
                                    width: calc(var(--size) * 5);
                                    border: 0;
                                    -webkit-appearance: none;
                                    appearance: none;
                                }

                                /* For Chrome and Safari */
                                .rating::-webkit-slider-runnable-track {
                                    height: 100%;
                                    mask: var(--mask);
                                    mask-composite: intersect;
                                    background: var(--bg);
                                    -webkit-print-color-adjust: exact;
                                    print-color-adjust: exact;
                                }

                                .rating::-webkit-slider-thumb {
                                    opacity: 0;
                                }

                                /* For Firefox */
                                .rating::-moz-range-track {
                                    height: 100%;
                                    mask: var(--mask);
                                    mask-composite: intersect;
                                    background: var(--bg);
                                    print-color-adjust: exact;
                                }

                                .rating::-moz-range-thumb {
                                    opacity: 0;
                                }
                            </style>

                            <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center gap-2"
                                 dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                                <label for="rating" class="form-label">{{ __('dashboard.stars') }}</label>
                                <input
                                    name="stars"
                                    type="range"
                                    min="0.5"
                                    max="5"
                                    step="0.5"
                                    value="2.5"
                                    class="rating"
                                    style="--val:2.5"
                                    oninput="this.style.setProperty('--val', this.value)">
                            </div>

                        </div>

                        <!-- Review textarea -->
                        <div class="mb-3">
                            <label for="review" class="form-label">{{ __('dashboard.message') }}</label>
                            <textarea name="review" id="review" rows="4" required></textarea>
                        </div>
                    </div>


                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit"
                                class="btn btn-primary text-white">{{ __('dashboard.evaluate_branch') }}</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const reviewForm = document.getElementById('reviewForm');
            const responseDiv = document.getElementById('reviewResponse');

            reviewForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        responseDiv.classList.remove('d-none', 'alert-danger');
                        responseDiv.classList.add('alert-success');
                        responseDiv.innerText = "{{ __('dashboard.evaluation_submitted') }}";

                    })
                    .catch(async err => {
                        responseDiv.classList.remove('d-none', 'alert-success');
                        responseDiv.classList.add('alert-danger');

                        if (err?.response?.status === 422) {
                            const data = await err.response.json();
                            responseDiv.innerText = Object.values(data.errors).flat().join(' ');
                        } else {
                            responseDiv.innerText = err + 'حدث خطأ، حاول مرة أخرى.';
                        }
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                    });
            });
        });
    </script>

@endsection
