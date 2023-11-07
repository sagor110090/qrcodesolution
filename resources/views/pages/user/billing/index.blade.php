<?php

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, usesPagination, with, on, placeholder};
use App\Models\Plan;

name('billing');

middleware(['auth', 'verified']);

with('invoices', function () {
    return auth()
        ->user()
        ->invoices();
});

$invoice = function ($invoiceId) {
    $invoice = auth()
        ->user()
        ->findInvoice($invoiceId);
    return $invoice->download();
};

?>


<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Billing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            @volt('billing')
                <div class="bg-white dark:bg-gray-900 dark:border-gray-800 dark:shadow-xl sm:rounded-lg">

                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Download
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $invoice->date()->toFormattedDateString() }}</td>
                                        <td class="px-6 py-4">{{ $invoice->total() }}</td>
                                        <td class="px-6 py-4"><a class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-600"
                                                href="{{ route('invoice.download', $invoice->id) }}">Download</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            @endvolt
        </div>
    </div>

</x-layouts.app>
