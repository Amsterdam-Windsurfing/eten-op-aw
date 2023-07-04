<div class="flex items-center justify-between px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
        Aanmelden
    </button>

    <button type="button" @click="plusOneItems.push({
            name: {
                value: '',
                error: ''
            },
            dinner_option: {
                value: '',
                error: ''
            },
            allergies: {
                value: '',
                error: ''
            }

            })"
            class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        <span x-show="plusOneItems.length == 0">Ik neem een gast mee</span>
        <span x-show="plusOneItems.length != 0">Ik neem nog een gast mee</span>

    </button>
</div>
