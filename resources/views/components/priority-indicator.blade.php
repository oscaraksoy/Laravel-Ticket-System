<div class="flex flex-row justify-start w-20 items-center">
    <div class="w-4 h-4 rounded-full mr-2 {{
    $priority->id == 1 ? "bg-red-500" : (
    ($priority->id == 2 ? "bg-red-400" :
    ($priority->id == 3 ? "bg-yellow-500" :
    ($priority->id == 4 ? "bg-green-500" : ''))))

 }}"></div>
    {{ ucfirst($priority->name) }}
</div>
