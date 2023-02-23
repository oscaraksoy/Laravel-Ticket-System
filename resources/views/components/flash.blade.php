@if(session()->has('dialogMessage'))
    <div
        x-data="{show: true}"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed bg-blue-500 text-white px-4 py-3 rounded-xl bottom-4 right-4"
    >
        {{ session('dialogMessage') }}
    </div>
@endif
