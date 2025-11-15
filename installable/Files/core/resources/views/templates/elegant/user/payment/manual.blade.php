@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom--card">
                    <div class="card-header card-header-bg">
                        <h5 class="card-title">{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="card-body  ">
                        <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data" class="disableSubmission">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p class="text-center mt-2">@lang('You have requested') <b class="text--success">{{ showAmount($data['amount']) }}</b> , @lang('Please pay')
                                        <b class="text--success">{{ showAmount($data['final_amount'], currencyFormat: false) . ' ' . $data['method_currency'] }} </b> @lang('for successful payment')
                                    </p>
                                    <h4 class="text-center mb-1">@lang('Please follow the instruction below')</h4>

                                    <div class="text-center mb-3">@php echo  $data->gateway->description @endphp</div>

                                </div>

                                <div class="col-12">
                                    <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn--base btn--lg w-100">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
