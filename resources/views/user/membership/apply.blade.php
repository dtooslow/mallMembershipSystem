<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Apply for Membership') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Premium Mall Membership</h3>
                    <p class="text-gray-500">Unlock exclusive discounts, earn rewards, and get VIP access to mall events.</p>
                </div>

                <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-6 mb-8 flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-indigo-900 uppercase tracking-wider mb-1">Annual Fee</div>
                        <div class="text-3xl font-black text-indigo-600">₱500.00</div>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>

                <form action="{{ route('membership.apply.store') }}" method="POST">
                    @csrf
                    
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Select Payment Method</h4>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="gcash" class="peer sr-only" required>
                            <div class="border-2 border-gray-200 rounded-xl p-4 hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <div class="font-bold text-gray-700">GCash</div>
                                <div class="text-xs text-gray-500 mt-1">E-Wallet</div>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="maya" class="peer sr-only">
                            <div class="border-2 border-gray-200 rounded-xl p-4 hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <div class="font-bold text-gray-700">Maya</div>
                                <div class="text-xs text-gray-500 mt-1">E-Wallet</div>
                            </div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="bdo" class="peer sr-only">
                            <div class="border-2 border-gray-200 rounded-xl p-4 hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <div class="font-bold text-gray-700">BDO</div>
                                <div class="text-xs text-gray-500 mt-1">Bank Transfer</div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="payment_method" value="bpi" class="peer sr-only">
                            <div class="border-2 border-gray-200 rounded-xl p-4 hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                <div class="font-bold text-gray-700">BPI</div>
                                <div class="text-xs text-gray-500 mt-1">Bank Transfer</div>
                            </div>
                        </label>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Test Environment:</strong> This is a dummy transaction. No real funds will be deducted from your account. Clicking "Pay & Apply" will automatically submit your application for admin review.
                                </p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Pay ₱500.00 & Apply
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
