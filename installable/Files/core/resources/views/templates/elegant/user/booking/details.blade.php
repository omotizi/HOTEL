@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $totalFare = $booking->bookedRooms->sum('fare');
        $totalTaxCharge = $booking->tax_charge;
        $canceledFare = $booking->bookedRooms->where('status', Status::ROOM_CANCELED)->sum('fare');
        $canceledTaxCharge = $booking->bookedRooms->where('status', Status::ROOM_CANCELED)->sum('tax_charge');
        $couponAmount = $booking->coupon_amount;
    @endphp

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-8">
                <div class="style-left mb-3">
                    <h4 class="section-heading__title"> @lang('Booked Rooms') </h4>
                </div>
                <table class="table table--responsive--md">
                    <thead>
                        <tr>
                            <th>@lang('Booked For')</th>
                            <th>@lang('Room Type')</th>
                            <th>@lang('Room No.')</th>
                            <th>@lang('Fare') / @lang('Night')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($booking->bookedRooms->groupBy('booked_for') as $bookedRoom)
                            @foreach ($bookedRoom as $booked)
                                <tr>
                                    @if ($loop->first)
                                        <td class="bg--date text-center" data-label="@lang('Booked For')" rowspan="{{ count($bookedRoom) }}">
                                            {{ showDateTime($booked->booked_for, 'd M, Y') }}
                                        </td>
                                    @endif
                                    <td class="text-center" data-label="@lang('Room Type')">
                                        {{ __($booked->room->roomType->name) }}</td>
                                    <td data-label="@lang('Room No.')">{{ __($booked->room->room_number) }}
                                        @if ($booked->status == Status::ROOM_CANCELED)
                                            <span class="text--danger text-sm">(@lang('Canceled'))</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Fare') / @lang('Night')">{{ showAmount($booked->fare) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach

                        <tr>
                            <td class="text-end" colspan="3">
                                <span class="fw-bold">@lang('Total Fare')</span>
                            </td>
                            <td class="fw-bold">
                                {{ showAmount($totalFare) }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                @if ($booking->usedPremiumService->count())
                    <div class="mt-4">
                        <div class="style-left mb-3">
                            <h4 class="section-heading__title"> @lang('Services') </h4>
                        </div>
                        <table class="table table--responsive--md">
                            <thead>
                                <tr>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Room No.')</th>
                                    <th>@lang('Service')</th>
                                    <th>@lang('Total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->usedPremiumService->groupBy('service_date') as $services)
                                    @foreach ($services as $service)
                                        <tr>
                                            @if ($loop->first)
                                                <td class="bg--date text-center" data-label="@lang('Date')" rowspan="{{ count($services) }}">
                                                    {{ showDateTime($service->service_date, 'd M, Y') }}
                                                </td>
                                            @endif

                                            <td data-label="@lang('Room No.')">
                                                <span class="fw-bold">{{ __($service->room->room_number) }}</span>
                                            </td>
                                            <td data-label="@lang('Service')">
                                                <div>
                                                    <span class="fw-bold">
                                                        {{ __($service->premiumService->name) }}
                                                    </span>
                                                    <br>
                                                    {{ showAmount($service->unit_price) }} x {{ $service->qty }}
                                                </div>
                                            </td>
                                            <td data-label="@lang('Total')">
                                                <span class="fw-bold">
                                                    {{ showAmount($service->total_amount) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                <tr>
                                    <td class="text-end" colspan="3">
                                        <span class="fw-bold">@lang('Total')</span>
                                    </td>
                                    <td class="fw-bold">
                                        {{ showAmount($booking->service_cost) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @php
                    $receivedPyaments = $booking->payments->where('type', 'RECEIVED');
                    $returnedPyaments = $booking->payments->where('type', 'RETURNED');
                @endphp

                @if ($receivedPyaments->count())
                    <div class="mt-4">
                        <div class="style-left mb-3">
                            <h4 class="section-heading__title"> @lang('Payments Recevied') </h4>
                        </div>

                        <table class="table table--responsive--md">
                            <thead>
                                <tr>
                                    <th>@lang('Time')</th>
                                    <th>@lang('Payment Type')</th>
                                    <th>@lang('Amount')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($receivedPyaments as $payment)
                                    <tr>
                                        <td class="text-start">{{ __(showDateTime($payment->created_at, 'd M, Y')) }}</td>
                                        <td>
                                            @if ($payment->admin_id == 0)
                                                @lang('Online Payment')
                                            @else
                                                @lang('Cash Payment')
                                            @endif

                                        </td>
                                        <td>{{ showAmount($payment->amount) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="text-end fw-bold" colspan="2">@lang('Total')</td>
                                    <td class="fw-bold">{{ showAmount($receivedPyaments->sum('amount')) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($returnedPyaments->count())
                    <div class="style-left mb-3">
                        <h4 class="section-heading__title"> @lang('Payments Returned') </h4>
                    </div>

                    <table class="table table-responsive--md">
                        <thead>
                            <tr>
                                <th>@lang('Time')</th>
                                <th>@lang('Payment Type')</th>
                                <th>@lang('Amount')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($returnedPyaments as $payment)
                                <tr>
                                    <td class="text-start">{{ __(showDateTime($payment->created_at, 'd M, Y')) }}</td>
                                    <td>@lang('Cash Payment')</td>
                                    <td>{{ showAmount($payment->amount) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td class="text-end" colspan="2">
                                    <span class="fw-bold">@lang('Total')</span>
                                </td>
                                <td class="fw-bold">{{ showAmount($returnedPyaments->sum('amount')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="col-lg-4">
                @php
                    $due = $booking->total_amount - $booking->paid_amount;
                @endphp
                <div class="style-left mb-3">
                    <h4 class="section-heading__title"> @lang('Payment Information') </h4>
                </div>
                <div class="card custom--card box-shadow-none">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                        <path d="M13 3.5H14C14.93 3.5 15.395 3.5 15.7765 3.60222C16.8117 3.87962 17.6204 4.68827 17.8978 5.72354C18 6.10504 18 6.57003 18 7.5H5C3.89543 7.5 3 6.60457 3 5.5C3 4.39543 3.89543 3.5 5 3.5H8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3 5.5V15.5C3 18.3284 3 19.7426 3.87868 20.6213C4.75736 21.5 6.17157 21.5 9 21.5H15C17.8284 21.5 19.2426 21.5 20.1213 20.6213C21 19.7426 21 18.3284 21 15.5V13.5C21 10.6716 21 9.25736 20.1213 8.37868C19.2426 7.5 17.8284 7.5 15 7.5H7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M21 12.5H19C18.535 12.5 18.3025 12.5 18.1118 12.5511C17.5941 12.6898 17.1898 13.0941 17.0511 13.6118C17 13.8025 17 14.035 17 14.5C17 14.965 17 15.1975 17.0511 15.3882C17.1898 15.9059 17.5941 16.3102 18.1118 16.4489C18.3025 16.5 18.535 16.5 19 16.5H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.5 2.5C12.433 2.5 14 4.067 14 6C14 6.5368 13.8792 7.04537 13.6632 7.5H7.33682C7.12085 7.04537 7 6.5368 7 6C7 4.067 8.567 2.5 10.5 2.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    @lang('Total Fare')
                                </span>
                                <span> +{{ showAmount($totalFare) }}</span>
                            </li>
                            <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                        <path d="M12.25 15.5L14.5 14.2963L16.75 15.5L16.25 13.0926L18 11.4074L15.558 11.2088L14.5 9L13.442 11.2088L11 11.4074L12.75 13.0926L12.25 15.5Z" stroke="currentColor" stroke-width="1.55" stroke-linejoin="round" />
                                        <path d="M2 9.5V6C2 4.89543 2.89543 4 4 4H20C21.1046 4 22 4.89713 22 6.0017V17.9989C22 19.1034 21.1046 20 20 20H4C2.89543 20 2 19.1046 2 18V14.5C3.38071 14.5 4.5 13.3807 4.5 12C4.5 10.6193 3.38071 9.5 2 9.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    @lang('Coupon Offer')
                                </span>
                                <span> -{{ showAmount($couponAmount) }}</span>
                            </li>
                            <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                <span>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                        <path d="M3 21H21V3.00046L3 3V21Z" stroke="#141B34" stroke-width="1.5" stroke-linejoin="round" />
                                        <path d="M8 16L16 8M10 9C10 9.55228 9.55228 10 9 10C8.44772 10 8 9.55228 8 9C8 8.44772 8.44772 8 9 8C9.55228 8 10 8.44772 10 9ZM16 15C16 15.5523 15.5523 16 15 16C14.4477 16 14 15.5523 14 15C14 14.4477 14.4477 14 15 14C15.5523 14 16 14.4477 16 15Z" stroke="#141B34" stroke-width="1.5" />
                                    </svg>
                                    {{ __(gs()->tax_name) }}
                                    ({{ showAmount($booking->taxPercentage(), currencyFormat: false) }}%)
                                </span>
                                <span> +{{ showAmount($totalTaxCharge) }}</span>
                            </li>

                            @if ($canceledFare > 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                            <path d="M11 2C7.22876 2 5.34315 2 4.17157 3.12874C3 4.25748 3 6.07416 3 9.70753V17.9808C3 20.2867 3 21.4396 3.77285 21.8523C5.26947 22.6514 8.0768 19.9852 9.41 19.1824C10.1832 18.7168 10.5698 18.484 11 18.484C11.4302 18.484 11.8168 18.7168 12.59 19.1824C13.9232 19.9852 16.7305 22.6514 18.2272 21.8523C19 21.4396 19 20.2867 19 17.9808V11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M3.5 7H11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path opacity="0.4" d="M21 2L14 8.99954M21 9L14 2.00046" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Canceled Tax')
                                    </span>
                                    <span> -{{ showAmount($canceledFare) }}</span>
                                </li>
                            @endif

                            @if ($canceledTaxCharge > 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" class="injected-svg" data-src="https://cdn.hugeicons.com/icons/money-add-01-twotone-rounded.svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" color="#000000">
                                            <path opacity="0.4" d="M2.01733 14C4.2169 14 6.00001 15.7831 6.00001 17.9827" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path opacity="0.4" d="M6.00001 4.01733C6.00001 6.2169 4.2169 8.00001 2.01733 8.00001" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path opacity="0.4" d="M18 4.01733C18 6.19765 19.769 7.96876 21.9423 7.9996" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M22 13V10C22 7.17157 22 5.75736 21.1213 4.87868C20.2426 4 18.8284 4 16 4H8C5.17157 4 3.75736 4 2.87868 4.87868C2 5.75736 2 7.17157 2 10V12C2 14.8284 2 16.2426 2.87868 17.1213C3.75736 18 5.17157 18 8 18H13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M19 14V20M16 17H22" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Canceled') {{ __(gs()->tax_name) }} @lang('Charge')
                                    </span>
                                    <span> -{{ showAmount($canceledTaxCharge) }}</span>
                                </li>
                            @endif

                            @if ($booking->service_cost > 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                            <path d="M4 14H22" stroke="#000000" stroke-width="1.5" stroke-linecap="square">
                                            </path>
                                            <path d="M5 22L7 20L13.381 19.6012C14.4193 19.5363 15.3914 19.0694 16.0912 18.2997L20 14H16.5L14.5858 15.9142C14.2107 16.2893 13.702 16.5 13.1716 16.5H13M2 19L5.82843 15.1716C6.57857 14.4214 7.59599 14 8.65685 14H11C12.1046 14 13 14.8954 13 16V16.5M13 16.5H9.5" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                                            <path d="M5 11.5C5 7.08171 8.58171 3.5 13 3.5M13 3.5C17.4183 3.5 21 7.08171 21 11.5M13 3.5V2" stroke="#000000" stroke-width="1.5" stroke-linecap="square"></path>
                                        </svg>
                                        @lang('Extra Service Charge')
                                    </span>
                                    <span> +{{ showAmount($booking->service_cost) }}</span>
                                </li>
                            @endif

                            @if ($booking->extraCharge() > 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="none">
                                            <path opacity="0.4" d="M12.06 21.5124C11.5445 21.8375 11.2868 22 11 22C10.7132 22 10.4554 21.8374 9.94 21.5124L8.02913 20.3073C7.54415 20.0014 7.30166 19.8485 7.03253 19.8397C6.74172 19.8301 6.49493 19.9768 5.97087 20.3073C5.38395 20.6774 4.21687 21.6971 3.46195 21.2108C3 20.9133 3 20.1575 3 18.6458V8.00002C3 5.17158 3 3.75736 3.82699 2.87868C4.65399 2 5.98501 2 8.64706 2H13.3529C16.015 2 17.346 2 18.173 2.87868C19 3.75736 19 5.17158 19 8.00002V12" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11 11H7" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17 14V22M21 18L13 18" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 7L7 7" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>

                                        @lang('Other Charges')</span>
                                    <span> +{{ showAmount($booking->extraCharge()) }}</span>
                                </li>
                            @endif

                            @if ($booking->cancellation_fee > 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-0">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#000000" fill="none">
                                            <path d="M15 12C15 10.8954 15.8954 10 17 10C19.2091 10 21 11.7909 21 14C21 16.2091 19.2091 18 17 18C15.8954 18 15 17.1046 15 16V12Z" stroke="#141B34" stroke-width="1.5" />
                                            <path d="M9 12C9 10.8954 8.10457 10 7 10C4.79086 10 3 11.7909 3 14C3 16.2091 4.79086 18 7 18C8.10457 18 9 17.1046 9 16V12Z" stroke="#141B34" stroke-width="1.5" />
                                            <path d="M3 14V11C3 6.02944 7.02944 2 12 2C16.9706 2 21 6.02944 21 11V15.8462C21 17.8545 21 18.8586 20.6476 19.6417C20.2465 20.5329 19.5329 21.2465 18.6417 21.6476C17.8586 22 16.8545 22 14.8462 22H12" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        @lang('Cancellation Fee')
                                    </span>
                                    <span> +{{ showAmount($booking->cancellation_fee) }}</span>
                                </li>
                            @endif

                            <li class="d-flex justify-content-between list-group-item align-items-start px-0 border-top border-0">
                                <span class="fw-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#000000" fill="none">
                                        <path d="M13.0004 7.00002L17.5004 8.00002M12.0004 11L14.5004 11.5M9.9075 3.42761L7.06957 13.8414C6.79556 14.8469 7.35424 15.8921 8.33561 16.21L16.6612 18.9069C17.7066 19.2455 18.8193 18.6298 19.1022 17.5562L21.9347 6.80377C22.2056 5.77542 21.6093 4.71771 20.5969 4.43075L12.2767 2.0725C11.2525 1.78222 10.1903 2.38976 9.9075 3.42761Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M5.44717 7H4.0173C2.69927 7 1.73566 8.22458 2.06501 9.48101L4.95617 20.5106C5.22936 21.5528 6.29651 22.1908 7.36183 21.9488L12 20.895" stroke="#000000" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                    @lang('Total Payable')
                                </span>
                                <span class="fw-bold"> = {{ showAmount($booking->total_amount) }}</span>
                            </li>

                            <li class="d-flex justify-content-between list-group-item align-items-start px-0">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#000000" fill="none">
                                        <path d="M11 21.5H15C17.8284 21.5 19.2426 21.5 20.1213 20.6213C21 19.7426 21 18.3284 21 15.5V14.5C21 11.6716 21 10.2574 20.1213 9.37868C19.2426 8.5 17.8284 8.5 15 8.5H3V15.5" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15 8.49833V4.1103C15 3.22096 14.279 2.5 13.3897 2.5C13.1336 2.5 12.8812 2.56108 12.6534 2.67818L3.7623 7.24927C3.29424 7.48991 3 7.97203 3 8.49833" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.5 15.5C17.7761 15.5 18 15.2761 18 15C18 14.7239 17.7761 14.5 17.5 14.5M17.5 15.5C17.2239 15.5 17 15.2761 17 15C17 14.7239 17.2239 14.5 17.5 14.5M17.5 15.5V14.5" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 19.5C3 19.5 4 19.5 5 21.5C5 21.5 8.17647 16.5 11 15.5" stroke="#141B34" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    @lang('Total Paid')</span>
                                <span>{{ showAmount($receivedPyaments->sum('amount')) }}</span>
                            </li>

                            @php
                                $refundedAmount = $returnedPyaments->sum('amount');
                            @endphp

                            @if ($refundedAmount > 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0">
                                    <span class="fw-bold">@lang('Refunded')</span>
                                    <span class="fw-bold">{{ showAmount($refundedAmount) }}</span>
                                </li>
                            @endif

                            @if ($due >= 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0">
                                    <span class="fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#000000" fill="none">
                                            <path d="M16 15.4993C16 14.947 16.4477 14.4993 17 14.4993H22L20.5 12.4993M22 17.4993C22 18.0516 21.5523 18.4993 21 18.4993H16L17.5 20.4993" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M14.5005 10.5C14.5005 11.8807 13.3812 13 12.0005 13C10.6198 13 9.50049 11.8807 9.50049 10.5C9.50049 9.11929 10.6198 8 12.0005 8C13.3812 8 14.5005 9.11929 14.5005 10.5Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M22 9.99134V5.11803C22 4.73926 21.7844 4.39596 21.4264 4.2723C20.572 3.9772 18.7632 3.5 16 3.5C11.2733 3.5 10.1213 5.28736 3.25078 3.79306C2.61507 3.6548 2 4.1302 2 4.78078V15.8286C2 16.2875 2.31284 16.689 2.75993 16.7923C8.29725 18.0717 10.2673 17.3077 13 16.862" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M2 7.5C3.95133 7.5 5.70483 5.90507 5.92901 4.25417M18.5005 4C18.5005 6.03964 20.2655 7.96899 22 7.96899M6.00049 16.9961C6.00049 14.787 4.20963 12.9961 2.00049 12.9961" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Due')</span>
                                    <span class="fw-bold @if ($due > 0) text--danger @else text--success @endif">{{ showAmount($due) }}</span>
                                </li>
                            @endif

                            @if ($due < 0)
                                <li class="d-flex justify-content-between list-group-item align-items-start px-0">
                                    <span class="fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#000000" fill="none">
                                            <path d="M2 12C2 8.68286 4.68286 6 8 6L7 8" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20 12C20 15.3171 17.3171 18 14 18L15 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11 8V4C11 3.44772 11.4477 3 12 3H19C19.5523 3 20 3.44772 20 4V8C20 8.55228 19.5523 9 19 9H12C11.4477 9 11 8.55228 11 8Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M2 20V16C2 15.4477 2.44772 15 3 15H10C10.5523 15 11 15.4477 11 16V20C11 20.5523 10.5523 21 10 21H3C2.44772 21 2 20.5523 2 20Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.4998 6H15.5087" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.49976 18H6.50874" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        @lang('Refundable')</span>
                                    <span class="fw-bold text--danger">{{ showAmount(abs($due)) }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                @if ($due > 0 && $booking->status == Status::BOOKING_ACTIVE)
                    <div class="text-end mt-4">
                        <a class="btn btn-sm btn--base" href="{{ route('user.booking.payment', $booking->id) }}">
                            @lang('Pay Now')
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection

@push('style')
    <style>
        .bg--date {
            background-color: #f6f3ef33 !important;
            color: #656565 !important;
        }

        .custom--table thead th {
            background-color: hsl(var(--base)) !important;
            color: #fff !important;
        }

        .shadow {
            box-shadow: 0 1px 3px 0 #0000000f !important;
        }

        .custom--table tbody td:first-child {
            text-align: center;
        }

        .custom--table tbody td {
            padding: 0.3rem 0.5rem !important;
        }

        .table tbody:has([rowspan]) tr td:first-child {
            border-left-width: 0;
            text-align: center;
        }

        .table tbody tr:has([rowspan]) td:first-child {
            border-inline: 1px solid #f1f5f9;
        }

        .table tbody tr:last-child td:first-child {
            border-left-width: 1px !important;
        }
    </style>
@endpush
